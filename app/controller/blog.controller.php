<?php

class Blog {
    private $model;

    public function __construct()
    {
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

    // public function addPost($userId,$title,$content,$created_at){
    //     if ($this->model->createPost($userId,$title,$content,$created_at)) {
    //         echo "Post Has Been Created";
    //     }else{
    //         echo "failed to create Post";
    //     }
    // }

}