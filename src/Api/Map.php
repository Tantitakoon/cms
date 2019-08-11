<?php 
 namespace App\Api;
class Map {
    public  function getAllProvince(){
        include "src/Db/connect.php";
        $provinces = [
            "bangkok",
            "nonthaburi",
        ];
        return $provinces;
    }
    public  function getByProvince($provinceName){
        //include "src/Db/connect.php";
        $results = [
                    "bangkok" => ['test.kml','newkml.kml','test2.kml'],
                    "nonthaburi" => ["testNonthaburi.kml","testNonthaburi1.kml"]
                   ];
        return (isset($results[$provinceName]))?$results[$provinceName]:[];
    }
}
    
?>