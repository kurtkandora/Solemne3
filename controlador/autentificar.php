<?php
 require_once '../modelo/dbo_model/usuariosDAO.php';
 $model_usuario = new Usuariosdb();
       if($_SERVER['REQUEST_METHOD']=='POST'){
		$correo = $_POST['authcorreo'];
		$contrasena1 = $_POST['authpassword'];
		$passbd = $model_usuario->autentificar($correo);
		if($passbd == $contrasena1){
		          	
		          session_start();
			      //Pasamos datos por session
			      $datos_usuario = $model_usuario->listarInformacionUsuario($correo);
				  $_SESSION['usuario']=$datos_usuario->nombre;
				  header('Status: 301 Moved Permanently', false, 301);
                  header('Location:../inicio.php');
                  exit();
		 }
		else{
			header('Status: 301 Moved Permanently', false, 301);
            header('Location:../vista/inicio.php');
            exit();
		}
	   }
	   else{
       	header('Status: 301 Moved Permanently', false, 301);
        header('Location:../vista/inicio.php');
        exit();
	   }
			
?>