<?php
    session_start();
    if(isset($_POST['namePath'])){
        $_SESSION['viewPath'] = $_POST['namePath'];
        echo json_encode((object) array('status'=>true));
    } else{
        echo json_encode((object) array('status'=>false));
    }
?>