<?php
namespace App\Controllers;
    use App\Api\User;
    use App\Classes\Http;
    use App\Api\Aes256;
    class UserController extends Controller{
        public static  function login(){
            if( isset($_POST['username']) && isset($_POST['password'])){
                 User::login();
            }else{
                 Http::badRequest();
            }
        }

        public static function logout(){
            User::logout();
        }
        public static function resetPassword(){
            
             if( isset($_POST['email'])){
                 $isEmailValid = User::checkEmail();
                if($isEmailValid['status']){
                  //  echo json_encode($isEmailValid['data']);
                  //echo $isEmailValid['data']['user_email']; 
                  $respEmail = User::sendEmail($isEmailValid['data']);
                }else{
                    echo json_encode($isEmailValid);
                }
            }else{
                Http::badRequest();
            }
        }

        public function checkResetPassword(){
            if(isset($_GET['info'])){
                $decodeData = self::decodeParams($_GET['info']);
                if(self::verify($decodeData)){
                    parent::CreateView("resetPassword.html");
                }else{
                    Http::badRequest();
                }
            }else{
                Http::badRequest();
            }
        }

        public function updatePassword(){
            if( isset($_POST['info']) && isset($_POST['password'])){
                $decodeData = self::decodeParams($_POST['info']);
                if(self::verify($decodeData)){
                   $results =  User::updatePassword($decodeData->email,$_POST['password']);
                   echo json_encode($results);
                }else{
                    Http::badRequest();
                }
            }else{
                Http::badRequest();
            }
        }

        public function decodeParams($encodeData){
            return json_decode(Aes256::decode(($encodeData)));
        }

        public function verify($decodeData){
            return ( isset($decodeData->email) && isset($decodeData->timestamp) && isset($decodeData->dataEncrypt)
            && $decodeData->dataEncrypt == Aes256::getDataEncrypt() && ( time()- $decodeData->timestamp) < 300 );
        }

        public function getUser(){
            $results =  User::getUser($_GET);
            echo json_encode($results);
        }

        public function insertUser(){
            if(isset($_POST['user_name']) && isset($_POST['user_email'])){
                $results =  User::insertUser($_POST);
                echo json_encode($results);
            }else{
                Http::badRequest();
            }
        }

        public function getCurrentUser(){
            header('Content-Type: application/json');
            $results = ["status"=>false,"errorMessage"=>"User hasn't yet login"];
            if(isset($_SESSION['login'])){
                $results = User::getCurrentUser();
            } 
            echo json_encode($results);
        }

        public function deleteUser(){
            if( isset($_POST['user_name']) || isset($_POST['user_email'])){
                $results =  User::deleteUser($_POST);
                echo json_encode($results);
            }else{
                Http::badRequest();
            }
        }

        public function updateUser(){
            if( isset($_POST['user_name'])){
                $results =  User::updateUser($_POST);
                echo json_encode($results);
            }else{
                Http::badRequest();
            }
        }
    
    }
?>
