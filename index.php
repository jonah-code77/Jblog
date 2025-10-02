<?php
require "app/app.php";

//create the Blog Controller
$controller = new Blog();

//Search 
$search = trim($_GET['search'] ?? '');
$id = $_GET['id'] ?? null;

//split between which view to go to
if ($search !="") {

    $controller->searchPost($search);
}elseif($id){

    $controller->get_post($id);
}else{

    $controller->getAllPost();
}


