<?php
namespace App\Controllers;
 class IndexController extends Controller{
    public static function isLogin(){
       if( isset($_GET['login']) && !isset($_SESSION['login']) ) echo "<script> $('#loginModal').modal('show');</script>";
     }
 }
?>
