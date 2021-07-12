<?php

class UserSession{
    public function __construct(){

        session_start();
        //echo ("sesion iniciada");
    }

    public function setCurrentUser($user){
       // echo($user);
        $_SESSION['user'] = $user;

    }

    public function getCurrentUser(){
     //  echo('user');
        return $_SESSION['user'];
    }

    public function closesession(){
        session_unset();
        session_destroy();
    }
}