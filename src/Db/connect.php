<?php
    error_reporting(1);
    
    
    $server_ip=$_SERVER[SERVER_ADDR];
    
    if ($server_ip == "127.0.0.1" || $server_ip == "::1"){
        $host = "localhost";
        $db = "nextcloudwatertool";
        $username = "root";
        $password = "";
    }else{
        $host = "localhost";
        $db = "nextcloudwatertool";
        $username = "root";
        $password = "";
        
    }
    
    
    $connect = mysqli_connect($host,$username,$password,$db) ;
    
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    //mysqli_select_db($db) ; // or die(mysqli_error()) 
    //mysqli_query("SET NAMES 'utf8'");
    mysqli_set_charset($connect, "utf8")    
?>