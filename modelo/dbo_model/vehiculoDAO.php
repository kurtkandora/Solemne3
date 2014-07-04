<?php
require_once 'modelo/dbconnect/mysqldb.php';
require_once 'modelo/dto_model/vehiculo.php';
class vehiculoDAO {

    function insertarVehiculo($vehiculo) {
        if(!$this->validar($vehiculo->modelo_vehiculo)) 
        {   
        $conexion = new MySqlCon();
        try {
            
            $sqlQuery = 'INSERT INTO `INSERT INTO `vehiculo`( `ID_TIPO_VEHICULO`, `FABRICANTE_VEHICULO`, `MODELO_VEHICULO`, `ANIO_FABRICACION`, `DESCRIPCION_VEHICULO`) VALUES (?,?,?,?,?)';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("issss", $vehiculo->id_tipo_vehiculo,$vehiculo->fabricante_vehiculo,$vehiculo->modelo_vehiculo,$vehiculo->anio_fabricacion,$vehiculo->descripcion_vehiculo);
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
        function validar($modelo_vehiculo) {
        $conexion = new MySqlCon();
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `vehiculo` WHERE UPPER(TRIM(`MODELO_VEHICULO`)) = UPPER(TRIM(?))';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $modelo_vehiculo);
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
    function listarVehiculos() {
        $conexion = new MySqlCon();
        $arreglo=array();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_VEHICULO`,`ID_TIPO_VEHICULO`, `FABRICANTE_VEHICULO`, `MODELO_VEHICULO`, `ANIO_FABRICACION`, `DESCRIPCION_VEHICULO` FROM `vehiculo`';
            $sentencia = $conexion -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_vehiculo,$id_tipo_vehiculo,$fabricante_vehiculo,$modelo_vehiculo,$anio_fabricacion,$descripcion_vehiculo);
                while ($sentencia -> fetch()) {
                    $objeto = new Vehiculo();
                    $objeto -> id_vehiculo = $id_vehiculo;
                    $objeto -> id_tipo_vehiculo = $id_tipo_vehiculo;
                    $objeto -> fabricante_vehiculo = $fabricante_vehiculo;
                    $objeto -> modelo_vehiculo = $modelo_vehiculo;
                    $objeto -> anio_fabricacion = $anio_fabricacion;
                    $objeto -> descripcion_vehiculo = $descripcion_vehiculo;
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

    function eliminarVehiculos($id_vehiculo) {
        $conexion = new MySqlCon();
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `vehiculo` WHERE `ID_VEHICULO`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $id_vehiculo);
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