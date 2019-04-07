<?php
    error_reporting(1);
    
    include_once('config/config.php');
    // $host = $config['DB_HOST'];
    // $db = $config['DB_USERNAME'];
    $server_ip=$_SERVER[SERVER_ADDR];
    
    if ($server_ip == "127.0.0.1" || $server_ip == "::1"){
        $host = $config['DB_HOST'];
        $db = $config['DB_DATABASE'];
        $username = $config['DB_USERNAME'];
        $password =  $config['DB_PASSWORD'];
    }else{
        $host = $config['DB_HOST'];
        $db = $config['DB_DATABASE'];
        $username = $config['DB_USERNAME'];
        $password =  $config['DB_PASSWORD'];
        
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