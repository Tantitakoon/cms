<?php
namespace App\Controllers;
    use App\Api\Potree;
    class PotreeController extends Controller{
        public static function search(){
            Potree::search();
        }
        public static function renderProtree(){
            self::CreateView("viewPotree.html");
            $path = $_GET['path'] ?: "";
            echo "<script>console.log('$path');loadPotree('$path')</script>";
        }
    }
?>
