<?php
 
if( isset($_POST['username']) && isset($_POST['password'])){
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
           $_SESSION['login'] = ["user_name" => $data['user_name'],"user_role "=> $data['user_role']];
           echo json_encode([
               "message" => "Login Success",
               "status" => true,
               "data" => $_SESSION['login']
            ]);
        }else{
            echo json_encode(["errorMessage" => "Invalid Password","status" => false]);
        }
    } else {
        echo json_encode(["errorMessage" => "Invalid Username", "status" => false]);
    }
    mysqli_close($connect);
}else{
   echo json_encode(["errorMessage" => "Bad request","status"=>false]);
    http_response_code(400);    
}

   
?>