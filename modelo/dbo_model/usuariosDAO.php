<?php
require_once '../modelo/dbconnect/mysqldb.php';
require_once '../modelo/dto_model/usuarios.php';
class Usuariosdb {

    function registrarUsuario($usuario) {

        $conexion = new MySqlCon();
        $reg_valido;
        try {
            $sqlQuery = 'INSERT INTO `usuarios`(`NOMBRE`, `CORREO`, `PASSWORD`) VALUES (?,?,?)';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("sss", $usuario->nombre, $usuario->correo, $usuario->contrasena);
            if ($sentencia -> execute()) {
                $valido = TRUE;
            } else {
                $valido = FALSE;
            }
            $conexion -> close();
        } catch(Exception $e) {

            error_log($e);
        }
        return $valido;
    }
    public function eliminarUsuario($idusuario)
    {
        $conexion = new MySqlCon();
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `usuarios` WHERE `id_usuario`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $idusuario);
            if ($sentencia -> execute()) {
                $del_valido = TRUE;
            } else {
                $del_valido = FALSE;
            }
            $conexion -> close();
        } catch(Exception $e) {
            error_log($e);
        }
        return $del_valido;
    }

    function autentificar($correo) {
        $conexion = new MySqlCon();
        $pass = '';
        try {
            $sqlQuery = 'SELECT `password` FROM `usuarios` WHERE `correo`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $correo);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($recpass);
                while ($sentencia -> fetch()) {
                    $pass = $recpass;
                }
                $conexion -> close();
            }
        } catch(Exception $e) {
            error_log($e);
        }
        return $pass;
    }

    //validar usuario ingresar en registrar
    function validarUsuario($correo) {
        $conexion = new MySqlCon();
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `usuarios` WHERE UPPER(TRIM(`correo`)) = UPPER(TRIM(?))';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $correo);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($cantidad);
                while ($sentencia -> fetch()) {
                    if ($cantidad == 1) {
                        $verificador = TRUE;
                    } else {
                        $verificador = FALSE;
                    }
                }
            }
            $conexion -> close();
        } catch(Exception $e) {
            error_log($e);
        }
        return $verificador;

    }

    function listarInformacionUsuario($correo) {
        $conexion = new MySqlCon();
        $objeto = new Usuarios();
        try {
            $sqlQuery = 'SELECT `id_usuario`, `nombre`, `correo`,`password`  FROM `usuarios` WHERE `correo` = ?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $correo);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_usuario, $nombre, $correo, $contrasena);
                while ($sentencia -> fetch()) {
                    $objeto -> id_usuario = $id_usuario;
                    $objeto -> nombre = $nombre;
                    $objeto -> correo = $correo;
                    $objeto -> contrasena = $contrasena;
                }
                $conexion -> close();
            }
        } catch(Exception $e) {
            error_log($e);
        }
        return $objeto;
    }

    public function listarUsuarios() {
        $conexion = new MySqlCon();
        $arreglo=array();
        $objeto = new Usuarios();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_USUARIO`, `NOMBRE`, `CORREO`, `PASSWORD` FROM `usuarios`';
            $sentencia = $conexion -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($ID_USUARIO, $nombre, $correo, $password);
                while ($sentencia -> fetch()) {
                    $objeto = new Usuarios();
                    $objeto -> nombre = $nombre;
                    $objeto -> contrasena = $password;
                    $objeto -> correo = $correo;
                    $objeto -> id_usuario = $ID_USUARIO;
                    $arreglo[$indice] = $objeto;
                    $indice++;
                }
            }
            $conexion -> close();
        } catch(Exception $e) {
            error_log($e);
        }
        return $arreglo;
    }

    function modificarUsuario($usuario) {
        $conexion = new MySqlCon();
        $reg_valido;
        try {
            $sqlQuery = 'UPDATE `usuarios` SET `nombre`=?,`correo`=?,`password`=? WHERE `id_usuario`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("sssi", $usuario->nombre, $usuario->correo, $usuario->contrasena, $usuario->id_usuario);
            if ($sentencia -> execute()) {
                $reg_valido = TRUE;
            } else {
                $reg_valido = FALSE;
            }
            $conexion -> close();
        } catch(Exception $e) {
            error_log($e);
        }
        return $reg_valido;
    }

}
?>