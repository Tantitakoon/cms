<?php 
    namespace App\Route;
    use App\Classes\Route;
    use App\Controllers\IndexController;
    use App\Controllers\PotreeController;
    use App\Controllers\UserController;
    use App\Controllers\Controller;
    class Routes {
     
        function routerView(){
            
            Route::set('/cms/',function(){
                IndexController::CreateView("index.php");
                IndexController::isLogin();
            });
            Route::set('/cms/map',function(){
                PotreeController::CheckLogin("main.html");
            });
            Route::set('/cms/viewPotree',function(){
                PotreeController::CheckLogin("viewPotree.html");
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
                UserController::checkResetPassword();  
            });

            
        }

        function routerApi(){
            Route::set('/cms/Potree/setView',function(){
                PotreeController::setView();
            });
            Route::set('/cms/Potree/getView',function(){
                PotreeController::getView();
            });
            Route::set('/cms/Potree/search',function(){
                PotreeController::search();
            });
            Route::set('/cms/User/login',function(){
                UserController::login();
            });
            Route::set('/cms/User/logout',function(){
                UserController::logout();
            });
            Route::set('/cms/User/resetPassword',function(){
                UserController::resetPassword();
            });
            Route::set('/cms/User/updatePassword',function(){
                UserController::updatePassword();
            });
            if(Route::isNotFound()) Controller::CreateView("notFound.html");
        }

   
   }
 
   
?>