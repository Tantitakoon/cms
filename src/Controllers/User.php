<?php
namespace App\Controllers;
    class User extends Controller{

        public static function login(){
            require "src/Api/User/login.php";  
        }

        public static function logout(){
            require "src/Api/User/logout.php";  
        }
    }
?>
