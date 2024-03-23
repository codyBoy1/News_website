<?php 
include "config.php" ;
session_start();

session_unset();

session_destroy();
/* header("Location: http://0.0.0.0:8080/admin/user.php",true,301);*/
   echo("<script> location.href= '{$hostname}/admin/';</script>");
?>