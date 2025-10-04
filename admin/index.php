<?php
require("../app/app.php");


$controller = new Admin();

$action = $_GET['action'] ?? 'dashboard';
$id = $_GET['id'] ?? '';
$userId = Session::getSession('user_id'); 
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if ($action === 'editPost' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->editPost($id, $title, $content, $userId);

} elseif ($action === 'editPost' && $id) {
    $controller->loadEditPost($id,$userId);

} elseif ($action === 'createPost' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createPost($id, $title, $content, $userId);
    
}elseif($action === 'createPost' && $id){

    $controller->loadCreate($userId);

}elseif (method_exists($controller, $action)) {
    $controller->$action($userId,$id); 
}
 else {
    $controller->dashboard($userId);
}

