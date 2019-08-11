<?php
namespace App\Controllers;
 class IndexController extends Controller{
   
    public static function isLogin(){
        if(isset($_SESSION['login'])){
          header("Location: /cms/allPage");
          die();
          //require "views/allpage.html";
        }else{
          require "views/indexV2.php";
        }  
      // if( isset($_GET['login']) && !isset($_SESSION['login']) ) echo "<script> $('#loginModal').modal('show');</script>";
     }
      
 }
?>
