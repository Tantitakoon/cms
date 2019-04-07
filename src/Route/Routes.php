<?php 
    namespace App\Route;
    require 'vendor/autoload.php';
    use App\Classes\Route;
    use App\Controllers\Index;
    use App\Controllers\Potree;
    use App\Controllers\User;
    use App\Controllers\Controller;
    class Routes {
     
        function routerView(){
            Route::set('/cms/',function(){
                Index::CreateView("index.php");
                Index::isLogin();
            });
            Route::set('/cms/map',function(){
                Potree::CheckLogin("main.html");
            });
            Route::set('/cms/viewPotree',function(){
                Potree::CheckLogin("viewPotree.html");
            });
            Route::set('/cms/downLoadWork',function(){
                Controller::CreateView("downLoadWork.html");
            });
            Route::set('/cms/handleBatchSystem',function(){
                Controller::CheckLogin("handleBatchSystem.html");
            });
            Route::set('/cms/listProcessBatch',function(){
                Controller::CheckLogin("listProcessBatch.html");
            });
            Route::set('/cms/contact',function(){
                Controller::CreateView("contact.html");
            });
            Route::set('/cms/admin',function(){
                require 'resource/templates/adminManage/HTML/index.html';
            });
            Route::set('/cms/resetPassword',function(){
                Controller::CheckLogin("resetPassword.html");
            });

            
        }

        function routerApi(){
            Route::set('/cms/Potree/setView',function(){
                Potree::setView();
            });
            Route::set('/cms/Potree/getView',function(){
                Potree::getView();
            });
            Route::set('/cms/Potree/search',function(){
                Potree::search();
            });
            Route::set('/cms/User/login',function(){
                User::login();
            });
            Route::set('/cms/User/logout',function(){
                User::logout();
            });
            if(Route::isNotFound()) Controller::CreateView("notFound.html");
        }

   
   }
 
   
?>