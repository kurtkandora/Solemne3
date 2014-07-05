<?php
require_once 'modelo/dto_model/usuarios.php';
require_once 'db_abstract_model.php';
require_once 'modelo/dbconnect/mysqldb.php';
class Usuariosdb extends DBAbstractModel {

    private $mysql_con;

    function __construct() {
        $this -> mysql_con = new MySqlCon();
    }

    function insert($usuario) {

        $reg_valido;
        if($this->exist($usuario))
        {return false;}
        try {
            $sqlQuery = 'INSERT INTO `usuarios`(`NOMBRE`, `CORREO`, `PASSWORD`) VALUES (?,?,?)';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("sss", $usuario->nombre, $usuario->correo, $usuario->contrasena);
            if ($this -> mysql_con -> affected_rows) {
                    $this -> mysql_con -> commit();
                    $valido= true;
                } else {
                    $this -> mysql_con -> rollback();
                    $valido= false;
                }
                $this -> mysql_con -> close();
                $usuario -> __destruct();
        } catch(Exception $e) {

            error_log($e);
            return false;
        }
        return $valido;
    }
    public function delete($usuario)
    {
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `usuarios` WHERE `id_usuario`=?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $usuario->idusuario);
            if ($sentencia -> execute()) {
                $this->mysql_con->commit();
                $del_valido = TRUE;
            } else {
                $this->mysql_con->rollback();
                $del_valido = FALSE;
            }
            $this->mysql_con -> close();
            $usuario->__destruct();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $del_valido;
    }

    function autentificar($correo) {
        $pass = '';
        try {
            $sqlQuery = 'SELECT `password` FROM `usuarios` WHERE `correo`=?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $correo);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($recpass);
                while ($sentencia -> fetch()) {
                    $pass = $recpass;
                }
                $this->mysql_con -> close();
            }
        } catch(Exception $e) {
            error_log($e);
        }
        return $pass;
    }

    //validar usuario ingresar en registrar
    function exist($usuario) {
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `usuarios` WHERE UPPER(TRIM(`correo`)) = UPPER(TRIM(?))';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
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
            $usuario->__destruct();
            $this->mysql_con -> close();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $verificador;

    }

    function listarInformacionUsuario($correo) {
        $objeto = new Usuarios();
        try {
            $sqlQuery = 'SELECT `id_usuario`, `nombre`, `correo`,`password`  FROM `usuarios` WHERE `correo` = ?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $correo);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_usuario, $nombre, $correo, $contrasena);
                while ($sentencia -> fetch()) {
                    $objeto -> id_usuario = $id_usuario;
                    $objeto -> nombre = $nombre;
                    $objeto -> correo = $correo;
                    $objeto -> contrasena = $contrasena;
                }
                $this->mysql_con -> close();
            }
        } catch(Exception $e) {
            error_log($e);
        }
        return $objeto;
    }

    public function selectAll() {
        $arreglo=array();
        $objeto = new Usuarios();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_USUARIO`, `NOMBRE`, `CORREO`, `PASSWORD` FROM `usuarios`';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($ID_USUARIO, $nombre, $correo, $password);
                while ($sentencia -> fetch()) {
                    $objeto = new Usuarios();
                    $objeto -> nombre = $nombre;
                    $objeto -> contrasena = $password;
                    $objeto -> correo = $correo;
                    $objeto -> id_usuario = $ID_USUARIO;
                    $arreglo[$indice] = $objeto;
                    $objeto->__destruct();
                    $indice++;
                }
            }
            $this->mysql_con -> close();
        } catch(Exception $e) {
            error_log($e);
        }
        return $arreglo;
    }

    function update($usuario) {
        $reg_valido;
        try {
            $sqlQuery = 'UPDATE `usuarios` SET `nombre`=?,`correo`=?,`password`=? WHERE `id_usuario`=?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("sssi", $usuario->nombre, $usuario->correo, $usuario->contrasena, $usuario->id_usuario);
            if ($sentencia -> execute()) {
                $this->mysql_con->commit();
                $reg_valido = TRUE;
            } else {
                $this->mysql_con->rollback();
                $reg_valido = FALSE;
            }
            $this->mysql_con -> close();
            $usuario->__destruct();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $reg_valido;
    }
function __destruct() {
        unset($this);
    }
}
?>