<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "app/app.php";

//create the Blog Controller
$controller = new Blog();

$action = $_GET['action'] ?? 'home';
$search = trim($_GET['search'] ?? '');
$id = $_GET['id'] ?? null;
$postId = $_POST['post_id'] ?? '';
$userId = Session::getSession('user_id');
$type = $_POST['type'] ?? null;

//split between which view to go to
if ($search !="") {

    $controller->searchPost($search);
}elseif($id){

    $controller->get_post($id);
}elseif($action === 'addComment' && $_SERVER['REQUEST_METHOD'] ===  'POST'){
    $controller->addComment($userId,$postId,$_POST['comment']);
    
}elseif($action === 'likes' && $_SERVER['REQUEST_METHOD'] ===  'POST'){
    $controller->likes($userId, $postId, $type);
    
}else{
    $controller->getAllPost();
}





