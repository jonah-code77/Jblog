<?php

class Blog {
    private $model;

    public function __construct()
    {
        Session::start();
        $this->model = new AppModel();
        
    }

    //Method to get all post
    public function getAllPost(){  
        $posts = $this->model->get_posts();
        
       $posts = $this->likes_comment($posts);

        View::views('home', ['posts'=>$posts]);   
    }

    private function likes_comment($posts){
        foreach ($posts as $key => $post) {

            //likes
            $post['like_count'] = $this->model->countLikes($post['id']);
            $post['dislike_count'] = $this->model->countDisLikes($post['id']);

            if(Session::getSession('user_id')){
                $post['like'] = $this->model->userlikes(Session::getSession('user_id'), $post['id']);
            }else{
                $post['like'] = null;
            }
            //comments
            $comments = $this->model->getcommentByPost($post['id']);
            $total_comments = count($comments);
            $preview_comments = array_slice($comments, 0, 5);
            $post['comments'] = $preview_comments;
            $post['total_comments'] = $total_comments;
            
            $posts[$key] = $post;
        }
        return $posts;
    }

    public function get_post($id){
        $post = $this->model->get_post($id);
        //likes
        $post['like_count'] = $this->model->countLikes($post['id']);
        $post['dislike_count'] = $this->model->countDisLikes($post['id']);
        if(Session::getSession('user_id')){
            $post['like'] = $this->model->userlikes(Session::getSession('user_id'), $post['id']);
        }else{
            $post['like'] = null;
         }
        //To fetch comment on single post
        $comments = $this->model->getCommentById($post['id']);
        $post['comments'] = $comments;
        View::views('blogPost', ['post' => $post]);
    }

    //search
    public function searchPost($search){
        $posts = $this->model->searchPost($search);
        $posts = $this->likes_comment($posts);
        $search = $search;
        View::views('home', ['posts'=> $posts, 'search'=>$search]);
    }


    //login users/admin
    public function logIn(){
        $msg = [];
        if (isset($_POST['btn'])) {
            $usernameOrEmail = ucfirst(trim($_POST['usernameorEmail']));
            $password = trim($_POST['password']); 

            if (!empty($usernameOrEmail && $password)) {
                $result = $this->model->logIn($usernameOrEmail,$password);
                if($result){
                    Session::setSession('username',$result['username']);
                    Session::setSession('user_id',$result['id']);
                    Session::setSession('role',$result['role']);
                    Session::setSession('email',$result['email']);
                    //print_r(Session::getAll());

                    if($result['role'] === 'admin'){
                        header("location:admin/index.php?action=dashboard");
                    }else{
                        header("location:index.php");
                    }
                }else{
                    $msg[] =  "invalid details";
                }

                
            }else{
                $msg[] = "please fill in details";
            }

        }
        View::views('login',['msg'=>$msg]);
    }

    public function reg(){
     $msg = [];
        if (isset($_POST['btn'])) {
            $username = ucfirst(trim($_POST['username']));
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);

            if (!empty($username) && !empty($password) && !empty($email)) {

                $checkEmailAvaliability = $this->model->user_exist($email);
                if(!$checkEmailAvaliability){

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $user = $this->model->reg_user($username, $email, $hashedPassword);
                $newUser = $this->model->get_user($user);

                if($newUser){
                    Session::setSession('username',$newUser['username']);
                    Session::setSession('user_id',$newUser['id']);
                    header("location:index.php");
                    exit;
                }else{
                    $msg[] = "<p style = 'color:red'>{$newUser}</p>";
                }
            }else{
                $msg[] = "<p style = 'color:red'>Email Taken</p>";
            }
        }else{
            $msg[] = "<p style = 'color:red'>Input must not be empty</p>";
        }
    }else{
        $msg[] = "<p style = 'color:blue'>Sign Up</p>";
    }
       View::views('register',['msg'=>$msg]);
    
    }


    //comments controller
    //add comments
    public function addComment($userId,$postId,$comments){
        $msg = [];
        if(!$userId){header("login.php");exit;};
        if($_SERVER['REQUEST_METHOD'] ===  'POST'){
           //print_r($_POST);
            if(!empty($comments)){
                $result = $this->model->createComments($postId,$userId,$comments);
                if ($result) {
                   if (isset($_POST['redirect_id']) && !empty($_POST['redirect_id'])) {
                        header("Location: index.php?id=" . $_POST['redirect_id']);
                        exit;
                    } else {
                        header("Location: index.php");
                        exit;
                    }
                }else{
                    $msg[] = "failed to post comments";
                }
            
            }else{
                $msg[] = "comments can not be empty";
            }
        }
        View::views('home',['msg'=>$msg]);
    
    }


    //likes controller

    public function likes($userId,$postId,$type){
        if(!$userId){header("login.php");exit;};

        $currentLike = $this->model->userlikes($userId,$postId);

        if($currentLike === $type){
            $this->model->removeLike($userId,$postId);
        }else{
            $this->model->likes_btn($userId,$postId,$type);
        }
        if (isset($_POST['redirect_id']) && !empty($_POST['redirect_id'])) {
            header("Location: index.php?id=" . $_POST['redirect_id']);
            exit;
        } else {
            header("Location: index.php");
            exit;
        }

    }


}