<?php
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    require_once( './src/_Globals.php' );
    require_once('config/config.php');
    use App\Route\Routes;
    Routes::routerView();
    Routes::routerApi();
?>