<?php  
$domainName = $_SERVER['SERVER_NAME'] ;
$configs = array(
  'DB_HOST'=>'localhost',
  'DATA_ENCRYPT'=>'testData',
  'PASSWORD_AES'=>'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NTQ2MzM0ODR9.wYAti7R1JuzgOgoIgWaLisrYfYaROL5cBIQiByhEpQM',
);
if($domainName== "localhost"){
  $configs['DB_USERNAME'] = 'root';
  $configs['DB_PASSWORD'] = '';
  $configs['DB_DATABASE'] = 'nextcloudwatertool';
  $configs['HOSTNAME'] = 'http://localhost';
  $configs['PATH_DOWNLOAD'] = '/app/downloadFile/kml/';
}else if($domainName== "chaibwoot.no-ip.org"){
  $configs['DB_USERNAME'] = 'nextclouduser';
  $configs['DB_PASSWORD'] = 'ratana4';
  $configs['DB_DATABASE'] = 'nextcloud';
  $configs['HOSTNAME'] = 'https://chaibwoot.no-ip.org:4448';
  $configs['PATH_DOWNLOAD'] = '/app/downloadFile/kml/';
} else if($domainName== "demo-thaiwatertool.online"){
  $configs['DB_USERNAME'] = 'moomin';
  $configs['DB_PASSWORD'] = ']y[l6fpvf';
  $configs['DB_DATABASE'] = 'nextcloudwatertool';
  $configs['HOSTNAME'] = 'http://demo-thaiwatertool.online';
  $configs['PATH_DOWNLOAD'] = '/home/gexd2awpfnof/downloadFile/kml/';
}
return $configs;
?>