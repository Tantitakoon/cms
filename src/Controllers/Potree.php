<?php
namespace App\Controllers;
    class Potree extends Controller{
        public static function setView(){
            require "src/Api/Potree/setview.php";  
        }
        public static function getView(){
            require "src/Api/Potree/getview.php";  
        }
        public static function search(){
            require "src/Api/Potree/search.php";  
        }
    }
?>
