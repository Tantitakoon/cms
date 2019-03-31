<?php
session_start();
if(isset($_SESSION['login'])){
    unset($_SESSION['login']);   
    echo json_encode(["status"=>true,"message"=>"Logout Success"]);
}else{
    echo json_encode(["status"=>false,"message"=>"Username hasn't yet login"]);
}
   
?>