<?php
session_start();
echo (isset($_SESSION['viewPath'])) ?json_encode((object) array('viewPath' => $_SESSION['viewPath'],'status'=>true))
                                    :json_encode((object) array('status'=>false));
?>