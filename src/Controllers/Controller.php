<?php
namespace App\Controllers;
    class Controller{
        public static function CreateView($fileName){
           require "views/$fileName";
        }
        public static function CheckLogin($fileName){
            if(isset($_SESSION['login'])) require "views/$fileName";
            else  echo "<script> window.location.href = '/cms/?login=true'; </script>";
         }
    }
?>