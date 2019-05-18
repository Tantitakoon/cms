<?php  
$domainName = $_SERVER['SERVER_NAME'] ;
if($domainName== "localhost"){
    return array(
      'DB_HOST'=>'localhost',
      'DB_USERNAME'=>'root',
      'DB_PASSWORD'=>'',
      'DB_DATABASE'=>'nextcloudwatertool',
      'DATA_ENCRYPT'=>'testData',
      'PASSWORD_AES'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NTQ2MzM0ODR9.wYAti7R1JuzgOgoIgWaLisrYfYaROL5cBIQiByhEpQM',
      'HOSTNAME'=>'http://localhost'
    );   
}else if($domainName== "chaibwoot.no-ip.org"){
  return array(
    'DB_HOST'=>'localhost',
    'DB_USERNAME'=>'nextclouduser',
    'DB_PASSWORD'=>'ratana4',
    'DB_DATABASE'=>'nextcloud',
    'DATA_ENCRYPT'=>'testData',
    'PASSWORD_AES'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NTQ2MzM0ODR9.wYAti7R1JuzgOgoIgWaLisrYfYaROL5cBIQiByhEpQM',
    'HOSTNAME'=>'https://chaibwoot.no-ip.org:4448'
  );   
} else if($domainName== "demo-thaiwatertool.online"){
  return array(
    'DB_HOST'=>'localhost',
    'DB_USERNAME'=>'moomin',
    'DB_PASSWORD'=>']y[l6fpvf',
    'DB_DATABASE'=>'nextcloudwatertool',
    'DATA_ENCRYPT'=>'testData',
    'PASSWORD_AES'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NTQ2MzM0ODR9.wYAti7R1JuzgOgoIgWaLisrYfYaROL5cBIQiByhEpQM',
    'HOSTNAME'=>'http://demo-thaiwatertool.online'
  );   
}
  
?>