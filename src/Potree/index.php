<?php
    $request = $_SERVER['REQUEST_URI'];
    switch (explode("/",$request)[3]) {
        case 'getView' :
            require  __DIR__ .'./getview.php';
        break;
        case 'setView' :
            require __DIR__ . './setView.php';
        break;
        case 'search' :
            require __DIR__ . './search.php';
        break;
        default:
           echo "Not Found";
        break;
    }
?>