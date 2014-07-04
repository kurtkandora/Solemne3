<?php
    if (file_exists('../config.txt')) {
        header('Status: 301 Moved Permanently', false, 301);
        header('Location:../inicio.php');
    } else {
        require_once '../modelo/dbconnect/mysqldb.php';
        try {
            $conexion = new MySqlCon();
            $sqlQuery = 'INSERT INTO `usuarios`(`NOMBRE`, `CORREO`, `PASSWORD`) VALUES ("admin","admin@localhost.com","admin")';
            $sentencia = $conexion ->prepare($sqlQuery);
            $sentencia -> execute();
        } catch(Exception $e) {
    
            error_log($e);
        }
    
        $fp = fopen('../config.txt', 'w');
        fwrite($fp, '../');
        fclose($fp);
     
        header('Status: 301 Moved Permanently', false, 301);
        header('Location:../inicio.php');
}
?>
