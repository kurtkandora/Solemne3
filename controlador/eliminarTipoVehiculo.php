<?php
    require_once '../modelo/dbo_model/tipo_de_vehiculoDAO.php';
   $model_public = new Tipo_de_vehiculoDAO();
 if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
         if($model_public->eliminarTipoVehiculos($id_tipo_vehiculo)){
                header('Status: 301 Moved Permanently', false, 301);
                header('Location:./inicio.php');
                exit();
     }
     else{
        header('Status: 301 Moved Permanently', false, 301);
        header('Location:./inicio.php');
        exit();  
     } 
   }
else{
        header('Status: 301 Moved Permanently', false, 301);
        header('Location:./inicio.php'');
        exit();  
}
?>