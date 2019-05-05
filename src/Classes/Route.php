<?php
 namespace App\Classes;
class Route {
 
    // public static $validRoutes = array();
     public static $isFound = false;
     public static function set($route,$function){
        if (self::isRouteValid($route)) {
            self::registerRoute($route);
            $function->__invoke();
            self::$isFound = true;
          } /*else if ($_GET['url'] == explode('/', $route)[0]) {
            self::registerRoute(self::dyn($route));
            $closure->__invoke();
          }*/
         
     }
     

    

    public function isRouteValid($route) {
        $uri = $_SERVER['REQUEST_URI'];
        return ($uri == $route || explode('?',$uri)[0] == $route);
    }

    public function isNotFound() {
         return !self::$isFound; 
    } 

    private static function registerRoute($route) {
        global $Routes;
        $Routes[] = $route;
    }
}
?>
