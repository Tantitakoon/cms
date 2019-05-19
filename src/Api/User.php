<?php
 namespace App\Api;
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
 use App\Api\Aes256;
 header('Content-Type: application/json');
class User {
    function checkEmail(){
            require_once "src/Db/connect.php";
            $email =$_POST['email'];
            $sql = "SELECT * FROM cms_users WHERE user_email = '$email' LIMIT 1;";
            $rows = mysqli_query($connect, $sql)  or die (mysqli_error($connect));

            if (mysqli_num_rows($rows) > 0) {
                $data = mysqli_fetch_assoc($rows);
                $result =  ["data" => $data , "status" => true];
            } else {
                $result = ["errorMessage" => "Invalid Email", "status" => false];
            }
            mysqli_close($connect);
            return $result;
     }

     function login(){

            //  header('Content-type:application/json');
             // header('Content-type:application/x-www-form-urlencoded');
              require_once "src/Db/connect.php";
              // if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
              //     throw new Exception('Request method must be POST!');
              // }

              // $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
              // $decoded;
              // if(strcasecmp($contentType, 'application/json') != 0){

              // }else{
              //     $content = trim(file_get_contents("php://input"));
              //     $decoded = json_decode($content);
              // }


              $username =$_POST['username'];
              $password = md5($_POST['password']);

              $sql = "SELECT * FROM cms_users WHERE user_name = '$username' LIMIT 1;";
              $results = array();
              $result = mysqli_query($connect, $sql)  or die (mysqli_error($connect));
              if (mysqli_num_rows($result) > 0) {
                  $data = mysqli_fetch_assoc($result);
                  if($password == $data['user_password']){
                     unset($data["user_password"]);
                     $_SESSION['login'] = $data;//["user_name" => $data['user_name'],"user_role "=> $data['user_role']];
                     $infoUser = $_SESSION['login'];
                     echo json_encode([
                         "message" => "Login Success",
                         "status" => true
                      ]);
                  }else{
                      echo json_encode(["errorMessage" => "Invalid Password","status" => false]);
                  }
              } else {
                  echo json_encode(["errorMessage" => "Invalid Username", "status" => false]);
              }
              mysqli_close($connect);
    }



    function logout(){
        if(isset($_SESSION['login'])){
            unset($_SESSION['login']);
            echo json_encode(["status"=>true,"message"=>"Logout Success"]);
        }else{
            echo json_encode(["status"=>false,"message"=>"User hasn't yet login"]);
        }
    }


 


    function sendEmail($data){
            try {
                require_once "src/utils/functions/joinPath.php";
                $mail = new PHPMailer(true);
                $configs = include("config/config.php");
                $hostname = $configs['HOSTNAME'];
                $timestamp = time();
                $info_email = json_encode([
                                "email"=>$data['user_email'],
                                "dataEncrypt"=>Aes256::getDataEncrypt(),
                                "timestamp"=> $timestamp
                            ]);
                
                $encode_email = urlencode(Aes256::encode($info_email));
                $url_resetPassword = joinPath($hostname,"/cms/resetPassword?info=$encode_email");
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'cms.usermanager@gmail.com';
                $mail->Password   = 'xeswtylbpeahcueh';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->SMTPDebug = 0;
                $mail->setFrom('cms.usermanager@gmail.com', 'Admin');
                $mail->addAddress($data['user_email']);
                $mail->addReplyTo('cms.usermanager@gmail.com', 'Information');
                $mail->isHTML(true);
                $mail->Subject = 'Reset password';
                $mail->Body    = "<b>Reset your password </b> <a href='$url_resetPassword'>Click !!!</a>";

                if($mail->send()){
                    echo json_encode(['status'=>true]);
                }else{
                    echo json_encode(['status'=>false,"errorMessage"=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
                }

            } catch (phpmailerException $e) {
                echo json_encode(['status'=>false,"errorMessage"=>"Message could not be sent. Mailer Error: {$e->getMessage()}"]);
            } catch (Exception $e) {
                echo json_encode(['status'=>false,"errorMessage"=>"Message could not be sent. Mailer Error: {$e->getMessage()}"]);
            }

    }

    function updatePassword($user_email,$user_password){
        require_once "src/Db/connect.php";
        $password = md5($user_password);
        $sql = "UPDATE cms_users SET user_password='$password' WHERE user_email='$user_email'";
        $result = ["status"=>true,"message"=>"User Email : $user_email  =>  Update Success"];
        if (!mysqli_query($connect, $sql)) {
            $result =  ["status"=>false,"errorMessage"=>"Error updating record: " . mysqli_error($connect),"sql"=> $sql];
        }
        mysqli_close($connect);
        return  $result;
    }

    function getUser($data){
        require_once "src/Db/connect.php";
        $sql = "SELECT * FROM cms_users";
        if(isset($data['userName'])){
            $userName = $data['userName'];
            $sql = "SELECT * FROM cms_users WHERE user_name = '$userName';";
        }else if(isset($data['role'])){
            $role =$data['role'];
            $sql = "SELECT * FROM cms_users WHERE user_role = '$role';";
        }
        $results = array("data"=>[],"count"=>0);
        $result = mysqli_query($connect, $sql);   
        if(!mysqli_error($connect)) {
            if (mysqli_num_rows($result) > 0) {
                while($row  = mysqli_fetch_assoc($result)){
                    array_push($results['data'] ,[
                                                    "user_id"=>$row['user_id'],
                                                    "user_name"=>$row['user_name'],
                                                    "user_firstname"=>$row['user_firstname'],
                                                    "user_lastname"=>$row['user_lastname'],
                                                    "user_email"=>$row['user_email'],
                                                    "user_image"=>$row['user_image'],
                                                    "user_role"=>$row['user_role']
                                                  ]);
                    $results['count']++;
                }
            }
        }else{
            $results  = ["status"=>false,"errorMessage"=>"Error query : " . mysqli_error($connect)];
        }
        mysqli_close($connect);
        return $results;
    }  

    function insertUser($data){
        require_once "src/Db/connect.php";
        $fields = [
            "user_name","user_password","user_firstname","user_lastname","user_email","user_image","user_role"
        ];
        $vals  = [];
        $results = ["status"=>true,"message"=>"insert success"];
        $data["user_password"] = (isset($data["user_password"]))?md5($data["user_password"]):md5("");
        foreach($fields as $field) {
            $val = (isset($data[$field]))?"'$data[$field]'":"''";
            array_push($vals,$val);
        }
        $fields = "(".join(",",$fields).")";
        $vals = "(".join(",",$vals).")";
        $sql = "INSERT INTO cms_users $fields VALUES $vals";

        if (!mysqli_query($connect, $sql)) {
            $results  = ["status"=>false,"errorMessage"=>"Error query : " . mysqli_error($connect)];
        }  
        mysqli_close($connect);
        return $results;
    }

    function getCurrentUser(){
        $results = ["status"=>false,"errorMessage"=>"User hasn't yet login"];
        if(isset($_SESSION['login'])){
            $results = ["status"=>true,"message"=>"success" ,"data"=>$_SESSION['login']];;
        } 
        return $results;
    }
    
    function deleteUser($data){
        require_once "src/Db/connect.php";
        $sql = "";
        $results = ["status"=>true,"message"=>"success"];
        if(isset($data['user_name'])){
            $userName = $data['user_name'];
            $sql = "DELETE FROM cms_users WHERE user_name = '$userName';";
        }else if(isset($data['user_email'])){
            $userEmail =$data['user_email'];
            $sql = "DELETE FROM cms_users WHERE user_email = '$userEmail';";
        }
        if (!mysqli_query($connect, $sql)) {
            $results = ["status"=>false,"errorMessage"=>mysqli_error($connect)];;
        }
        mysqli_close($connect);
        return $results;
    }

    function updateUser($data){
        require_once "src/Db/connect.php";
        $fields = [
            "user_password","user_firstname","user_lastname","user_email","user_image","user_role"
        ];
        $vals  = [];
        $results = ["status"=>true,"message"=>"update success"];
        $data["user_password"] = (isset($data["user_password"]))?md5($data["user_password"]):null;
        $userName = $data['user_name'];
        foreach($fields as $field) {
            if(isset($data[$field])){
                $val = "$field ='$data[$field]'";
                array_push($vals,$val);
            }
        }
        if(count($vals) > 0){
            $vals = join(",",$vals);
            $sql = "UPDATE cms_users SET $vals WHERE user_name = '$userName'";
            if (!mysqli_query($connect, $sql)) {
                $results = ["status"=>false,"errorMessage"=>mysqli_error($connect)];
            }
        }else{
            $results = ["status"=>false,"errorMessage"=>"No field to update ?"];
        }
        mysqli_close($connect);
        return $results;
    }

}


?>