<?php

class Session {

    //check if sessin is started already, if not it start a new session;
    public static function start(){
        if (session_status() === PHP_SESSION_NONE) {
            session_name('blog');
            session_start();
        }
    } 

    //Gets the key of a session after which it set it equal to the value
    public static function setSession($key,$value){
        $_SESSION[$key] = $value;
    }

    public static function getSession($key){
        return $_SESSION[$key] ?? null;
    }

        public static function getAll(){
        return $_SESSION;
    }

    public static function exist(){
        self::start();
        if(!isset($_SESSION['user_id'])){
            header('location: ../login.php');
            exit;
        };
    }

    public static function adminExist(){
        self::exist();
        if($_SESSION['role'] !== 'admin'){
            die('Access denied');
        }
    }

    public static function destroy(){
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

}