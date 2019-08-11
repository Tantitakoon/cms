<?php
namespace App\Controllers;
    use App\Api\Map;
    use App\Classes\Http;
    class MapController extends Controller{
        public  function getByProvince(){
            header('Content-Type: application/json');
            if(isset($_GET['provinceName'])){
               $provinceName =$_GET['provinceName'];
               $results = Map::getByProvince($provinceName);
               echo json_encode($results);
           }else{
                Http::badRequest();
           }
        }
    }
?>