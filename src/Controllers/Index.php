<?php
namespace App\Controllers;
 class Index extends Controller{
    public static function isLogin(){
       if(isset($_GET['login'])) echo "<script> $('#loginModal').modal('show');</script>";
     }
 }
?>
