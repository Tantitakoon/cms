<?php
namespace App\Controllers;
    use App\Api\Potree;
    class PotreeController extends Controller{
        public static function setView(){
            Potree::setView();
        }
        public static function getView(){
            Potree::getView();
        }
        public static function search(){
            Potree::search();
        }
    }
?>
