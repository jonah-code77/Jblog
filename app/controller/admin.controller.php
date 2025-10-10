<?php

class Admin {
    protected $model;

    public function __construct()
    {
        $this->model = new AppModel;
        Session::start();
    }

    //check for admin
    private function checkAdmin($adminId){
        $user = $this->model->get_user($adminId);
        if (!$user || $user['role'] !== 'admin') {
            die("Unauthorized user:We Go Find You👀👀");
        }
        return true;
    }

    //Display admin Dashboard
    public function dashboard($adminId){
        Session::adminExist();
        if(!$this->checkAdmin($adminId)) return false;
        $posts = $this->model->get_posts();
        $users = $this->model->get_users();
        View::views('admin/dashboard',[
            'posts' => $posts,
            'users' => $users
        ]);
    }


    //View a single post
    public function viewPost($userId,$id){
        if(!$this->checkAdmin($userId)) return false;
        $post = $this->model->get_post($id);
        View::views('admin/viewpost',[
            'post' => $post
        ]);
    }


    //load the create page
    public function loadCreate($userId){
        if(!$this->checkAdmin($userId)) return false;
        View::views('admin/createPost');
    }


    //handles create post
    public function createPost($userId,$title,$content){
        if(!empty($title) && !empty($content)){
            $post = $this->model->createPost($userId,$title,$content);
            if ($post == true) {
                header("location:index.php?action=dashboard");
                exit;
            }else{
                echo "failed to create post";
            }
        }else{
            echo "post dats cannot be empty";
        }
        
    }



    //load the edit page
    public function loadEditPost($id,$userId) {
        if(!$this->checkAdmin($userId)) return false;
        $post = $this->model->get_post($id);  
        if (!$post) {
            die("Error: Post not found.");
        }
        View::views('admin/editPost', [
            'post' => $post,
            'page_title' => 'Edit Post'
        ]);
    }


    //Handles the Edit Post
    public function editPost($id,$title,$content,$userId){
        if(!$this->checkAdmin($userId)) return false;
        if ($_SERVER['REQUEST_METHOD'] ==='POST') {
            if (!empty($title) && !empty($content)) {
               $post =  $this->model->editPost($title, $content, $id, $userId);
               if($post === true){
                header("location:index.php?action=dashboard");
                exit;
               }else{
                echo "Database update failed.";
               }
            }else{
                echo "failed: input must not be empty";
            }
        }else{
            die("Invalid method.");
        }
    }



    //Handles the Delete
    public function deletePost($userId,$id){
        if(!$this->checkAdmin($userId)) return false;
        $post = $this->model->deletePost($id,$userId);
        if ($post) {
            header("location:index.php?action=dashboard");
        }else{
            echo "failed to delete";
        }
        
    }


     
}