<?php
 namespace App\Classes;
class Http {
    public function badRequest(){
        echo json_encode(["errorMessage" => "Bad request","status"=>false]);
        http_response_code(400);
    }

    public function unauthorizedRequest(){
        echo json_encode(["errorMessage" => "unauthorized","status"=>false]);
        http_response_code(401);
    }

    public function notFoundRequest(){
         if(self::isGet()) require "views/notFound.html";
         else echo json_encode(["errorMessage" => "notFound","status"=>false]);
         http_response_code(404);
    }

    public  function isGet(){
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }

    public  function isPost(){
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
}
?>
