<?php
namespace App\Controllers;
    use App\Api\User;
    use App\Api\Aes256;
    class UserController extends Controller{
        public static  function login(){
            if( isset($_POST['username']) && isset($_POST['password'])){
                 User::login();
            }else{
                User::badRequest();
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
                User::badRequest();
            }
        }

        public function checkResetPassword(){
            if(isset($_GET['info'])){
                $decodeData = self::decodeParams($_GET['info']);
                if(self::verify($decodeData)){
                    parent::CreateView("resetPassword.html");
                }else{
                    User::badRequest();
                }
            }else{
                User::badRequest();
            }
        }

        public function updatePassword(){
            if( isset($_POST['info']) && isset($_POST['password'])){
                $decodeData = self::decodeParams($_POST['info']);
                if(self::verify($decodeData)){
                   $result =  User::updatePassword($decodeData->email,$_POST['password']);
                   echo json_encode($result);
                }else{
                    User::badRequest();
                }
            }else{
                User::badRequest();
            }
        }

        public function decodeParams($encodeData){
            return json_decode(Aes256::decode(($encodeData)));
        }

        public function verify($decodeData){
            return ( isset($decodeData->email) && isset($decodeData->timestamp) && isset($decodeData->dataEncrypt)
            && $decodeData->dataEncrypt == Aes256::getDataEncrypt() && ( time()- $decodeData->timestamp) < 300 );
        }
    }
?>
