<?php 
    namespace App\Route;
    require 'vendor/autoload.php';
    use App\Classes\Route;
    use App\Controllers\ContactUs;
    class Routes {
        function router(){
            Route::set('/cms/',function(){
                ContactUs::CreateView("index.php");
            });
        }
   }
 
   
?>