<?php
    session_start();
    $_SESSION = array();
    session_destroy(); 
    header('Status: 301 Moved Permanently', false, 301);
    header('Location:inicio.php');
    exit();
?>