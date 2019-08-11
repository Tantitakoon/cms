<?php
namespace App\Controllers;

    class Controller{
        public static function CreateView($fileName){
           require "views/$fileName";
        }
        public static function CheckLogin($fileName){
            if(isset($_SESSION['login'])) require "views/$fileName";
            else{
                header("Location: /cms/");
                die();
            }  //echo "<script> window.location.href = '/cms/?login=true'; </script>";
        }
        public function getDomain(){
            $configs = include('config/config.php');
            $domainName = $configs["HOSTNAME"];
            echo "<script>let domainName  = '$domainName';</script>";
        }
    }
?>
