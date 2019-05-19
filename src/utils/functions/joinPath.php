<?php
    function joinPath($path1,$path2){
       return join('/', array(trim($path1, '/'), trim($path2, '/')));
    }
?>