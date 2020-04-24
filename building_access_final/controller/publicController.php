<?php

session_start();

require_once "../model/user.php";

class publicController{

    public static function index(){
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if(isset($_SESSION["stored_user"])){
            $user=$_SESSION["stored_user"];
            if(!empty($user->getUsername()) && !empty($user->getRole())){
                switch($user->getRole()){
                    case 'user':
                        header("location: ../view/template/template.php");
                        break;
                    case 'admin':
                        //to be completed
                        break;
                    default:
                        $user->logout();
                        header("location: ../view/login.php");
                }   
            }
        } else {
            header("location: ../view/login.php");
        }
    }

    public static function authentication(){
        $username=$_POST['username'];
        $pass=$_POST['password'];
        $user=new user($username, $pass);
        $user->login();
        publicController::index();   
    }

}