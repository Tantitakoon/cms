<?php
  $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
  if( strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0 && strcasecmp($contentType, 'application/json') == 0){
      $content = trim(file_get_contents("php://input"));
      $decoded = json_decode($content, true);
      if(!is_array($decoded)) throw new Exception('Received content contained invalid JSON!');
      else  $_POST = $decoded;
  }
?>