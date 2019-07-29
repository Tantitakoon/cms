<?php
namespace App\Controllers;
    class FileController extends Controller{
        public function getKML(){
            if(isset($_GET['name'])){
                require_once "src/utils/functions/joinPath.php";
                $configs = include('config/config.php');
                $file = joinPath($configs['PATH_DOWNLOAD'],$_GET['name']);
                if (file_exists($file)) {
                  /*   header('Content-Description: File Transfer');
                     header('Content-Type: application/octet-stream');
                     header('Content-Disposition: attachment; filename="'.basename($file).'"');
                     header('Expires: 0');
                     header('Cache-Control: must-revalidate');
                     header('Pragma: public');
                     header('Content-Length: ' . filesize($file));*/
                     header('Content-Type: text/xml');
                     readfile($file);
                    exit;
                }else{
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode(array("errorMessage"=>"file doesn't exist.","status"=>false)); 
                }
            }else{
                http_response_code(400);
            }
       
        }
    }
?>
