<?php 
    namespace App\Route;
    use App\Classes\Route;
    use App\Classes\Http;
    use App\Controllers\IndexController;
    use App\Controllers\PotreeController;
    use App\Controllers\UserController;
    use App\Controllers\FileController;
    use App\Controllers\Controller;
    use App\Controllers\MapController;
    class Routes {
     
        function routerView(){  
            if(!Http::isGet()) return; 
            Route::set('/cms/',function(){
                IndexController::CreateView("index.php");
                IndexController::isLogin();
            });
            Route::set('/cms/map',function(){
                  Controller::getDomain();
                  Controller::CheckLogin("obgit.php");
            });
            Route::set('/cms/viewPotree',function(){
                PotreeController::renderProtree();
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
            Route::set('/cms/mapObgit',function(){
                Controller::getDomain();
                Controller::CreateView("obgit.php");
            });
            Route::set('/cms/admin',function(){
                Controller::CheckLogin("adminV2.html");
            });
            Route::set('/cms/resetPassword',function(){
                UserController::checkResetPassword();  
            });
            Route::set('/cms/panoView',function(){
                if(isset($_GET['lat']) && isset($_GET['lng'])){
                    $lat =$_GET['lat'];
                    $lng = $_GET['lng'];
                    echo "<script>let lat=$lat; let lng =$lng;</script>";
                    Controller::CreateView("panoview.html");  
                }else{
                    Http::notFoundRequest();
                }
            });

        

            
        }

        function routerApi(){
            if(Http::isGet()){
                self::getApi();
            }else if(Http::isPost()){
                self::postApi();
            }
            if(Route::isNotFound()){
                Http::notFoundRequest();
            } //Controller::CreateView("notFound.html");
        }

        function postApi(){
            Route::set('/cms/user/login',function(){
                UserController::login();
            });
            Route::set('/cms/user/logout',function(){
                UserController::logout();
            });
            Route::set('/cms/user/resetPassword',function(){
                UserController::resetPassword();
            });
            Route::set('/cms/user/updatePassword',function(){
                UserController::updatePassword();
            });
            Route::set('/cms/user/insertUser',function(){
                UserController::insertUser();
            });
            Route::set('/cms/user/deleteUser',function(){
                UserController::deleteUser();
            });
            Route::set('/cms/user/updateUser',function(){
                UserController::updateUser();
            });
        }

        function getApi(){
            Route::set('/cms/potree/search',function(){
                PotreeController::search();
            });
            Route::set('/cms/user/getUser',function(){
                UserController::getUser();
            });
            Route::set('/cms/user/getCurrentUser',function(){
                UserController::getCurrentUser();
            });
            Route::set('/cms/file/download',function(){
                 FileController::getKML();
            });
            Route::set('/cms/map/getByProvince',function(){
                MapController::getByProvince();
            });
        }

   
   }
 
   
?>