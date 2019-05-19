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
                   $result =  User::updatePassword($decodeData->email,$_POST['password']);
                   echo json_encode($result);
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
           // if(isset($_GET['role'])){
            $sql = "SELECT * FROM cms_users";
            if(isset($_GET['userName'])){
                $userName = $_GET['userName'];
                $sql = "SELECT * FROM cms_users WHERE user_name = '$userName';";
            }else if(isset($_GET['role'])){
                $role =$_GET['role'];
                $sql = "SELECT * FROM cms_users WHERE user_role = '$role';";
            }
            $result =  User::getUser($sql);
            echo json_encode($result);
        }
        public function insertUser(){
            if(isset($_POST['user_name']) && isset($_POST['user_email'])){
                $result =  User::insertUser($_POST);
                echo json_encode($result);
            }else{
                Http::badRequest();
            }
        }
        public function test(){
            require_once "src/Db/connect.php";
            $fields = [
                "user_name","user_password","user_firstname","user_lastname","user_email","user_role"
            ];
            $vals  = [];
            foreach($fields as $field) {
                $val = (isset($_POST[$field]))?"'$_POST[$field]'":"''";
                array_push($vals,$val);
            }
            $fields = "(".join(",",$fields).")";
            $vals = "(".join(",",$vals).")";
            $sql = "INSERT INTO cms_users $fields VALUES $vals";
           /* echo $_POST['data']['name'];*/
            /*$sql = "INSERT INTO cms_users 
                   (user_name, user_password,user_firstname,user_lastname, user_email,user_role)
             VALUES ('auttapon12', 'sdfsdf', 'sdfsdf','sdfsdf','auttapon.siriwaramas@gmail.com','admin')";
            
            if (mysqli_query($connect, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }
            
            mysqli_close($connect);
            */
        }

    }
?>
