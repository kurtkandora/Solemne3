<?php
require_once 'modelo/dbconnect/mysqldb.php';
require_once 'modelo/dto_model/tipo_de_vehiculo.php';
class Tipo_de_vehiculoDAO {

    function insertarTipoVehiculo($vehiculo) {
        if(!$this->validar($vehiculo->nombre)) 
        {   
        $conexion = new MySqlCon();
        try {
            
            $sqlQuery = 'INSERT INTO `tipo_de_vehiculo`(`NOMBRE_TIPO_VEHICULO`, `DESCRIPCION_TIPO_VEHICULO`) VALUES (?,?)';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("ss", $vehiculo->nombre_tipo_vehiculo,$vehiculo->descripcion_tipo_Vehiculo);
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
        else{return false;}
    }
        function validar($nombre) {
        $conexion = new MySqlCon();
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `tipo_de_vehiculo` WHERE UPPER(TRIM(`nombre_tipo_vehiculo`)) = UPPER(TRIM(?))';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $nombre);
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
    function listarTipoVehiculos() {
        $conexion = new MySqlCon();
        $arreglo=array();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_TIPO_VEHICULO`, `NOMBRE_TIPO_VEHICULO`, `DESCRIPCION_TIPO_VEHICULO` FROM `tipo_de_vehiculo`';
            $sentencia = $conexion -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_tipo_vehiculo, $nombre_tipo_vehiculo,$descripcion_tipo_Vehiculo);
                while ($sentencia -> fetch()) {
                    $objeto = new Tipo_de_vehiculo();
                    $objeto -> id_tipo_vehiculo = $id_tipo_vehiculo;
                    $objeto -> nombre_tipo_vehiculo = $nombre_tipo_vehiculo;
                    $objeto -> descripcion_tipo_Vehiculo = $descripcion_tipo_Vehiculo;
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

    function eliminarTipoVehiculos($id_tipo_vehiculo) {
        $conexion = new MySqlCon();
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `tipo_de_vehiculo` WHERE `ID_TIPO_VEHICULO`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $id_tipo_vehiculo);
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

}
?>