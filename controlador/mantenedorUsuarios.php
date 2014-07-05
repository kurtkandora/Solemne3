<?php
require_once '../modelo/dbo_model/usuariosDAO.php';
require_once '../modelo/dto_model/usuarios.php';
require_once './validaciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' | $_SERVER['REQUEST_METHOD'] == 'POST') {
    $validaciones = new Validaciones();
    $usuario_model = new Usuariosdb();
    $usuario = new Usuarios();

    switch ($_SERVER['REQUEST_METHOD']) {

        case 'POST' :
            if (!empty($_POST['id_usuario'])) {
                $usuario -> id_usuario = $_POST['id_usuario'];
                $usuario -> nombre = $_POST['nombre'];
                $usuario -> password = $_POST['password'];
                $usuario -> correo = $_POST['correo'];
                if ($validaciones -> validarNombre($usuario -> nombre) & $validaciones -> validarCorreo($usuario -> correo)) {
                    $usuario_model -> update($usuario);
                }
            } else if (!empty($_POST['nombre'])) {
                $usuario -> nombre = $_POST['nombre'];
                $usuario -> password = $_POST['password'];
                $usuario -> correo = $_POST['correo'];
                if ($validaciones -> validarNombre($usuario -> nombre) & $validaciones -> validarCorreo($usuario -> correo)) {
                    $usuario_model -> insert($usuario);
                }
            }
            break;

        case 'GET' :
            if (!empty($_GET['del'])) {
                $usuario -> id_usuario = $_GET['del'];
                $usuario_model -> delete($usuario);
            }
            break;

        default :
            break;
    }
    $usuario -> __destruct();
    $usuario_model -> __destruct();

}

header('Status: 301 Moved Permanently', false, 301);
header('Location:../vista/usuarios.php');



?>