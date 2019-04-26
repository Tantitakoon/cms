<?php
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    require_once( './src/_Globals.php' );
    require_once('config/config.php');
    use App\Route\Routes;
    Routes::routerView();
    Routes::routerApi();
  
    // $request = $_SERVER['REQUEST_URI'];
    // switch (explode("/",$request)[2]) {
    //     case '' :
    //         require __DIR__ . './views/index.php';
    //     break;
    //     case 'contact' :
    //         require __DIR__ . './views/contact.html';
    //     break;
    //     case 'downLoadWork' :
    //         require __DIR__ . './views/downLoadWork.html';
    //     break;
    //     case 'handleBatchSystem' :
    //         require __DIR__ . './views/handleBatchSystem.html';
    //     break;
    //     case 'listProcessBatch':
    //         require __DIR__ . './views/listProcessBatch.html';
    //     break;
    //     case 'admin':
    //         require __DIR__ . './resource/templates/adminManage/HTML/index.html';
    //     break;
    //     case 'map':
    //         require __DIR__ . './views/main.html';
    //     break;
    //     case 'Potree':
    //         require __DIR__ . './src/Potree/index.php';
    //     break;
    //     case 'resetPassword':
    //         require __DIR__ . './views/resetPassword.html';
    //     break;
    //     default:
    //         require __DIR__ . './views/notFound.html';
    //     break;
    // }
?>