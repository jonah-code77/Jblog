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
        View::views('home', ['posts'=>$posts]);   
    }

    public function get_post($id){
        $post = $this->model->get_post($id);
        View::views('blogPost', ['post' => $post]);
    }

    public function searchPost($search){
        $posts = $this->model->searchPost($search);
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

                
            }

        }
        View::views('login',['msg'=>$msg]);
    }

}