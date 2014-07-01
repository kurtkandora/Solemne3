<?php
class Tipo_de_vehiculo {
    public $id_tipo_vehiculo, $nombre_tipo_vehiculo,$descripcion_tipo_Vehiculo;
}

require_once '/dbconnect/mysqldb.php';
class Tipo_de_vehiculo {

    function insertarVehiculo($vehiculo) {
        if(!$this->validar($nombre)) 
        {   
        $conexion = new MySqlCon();
        try {
            
            $sqlQuery = 'INSERT INTO `editorial`(`nombre_editorial`) VALUES (?)';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $nombre_editorial);
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
            $sqlQuery = 'SELECT COUNT(*)FROM `editorial` WHERE UPPER(TRIM(`nombre_editorial`)) = UPPER(TRIM(?))';
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
    function listarEditoriales() {
        $conexion = new MySqlCon();
        $arreglo=array();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_EDITORIAL`, `NOMBRE_EDITORIAL` FROM `EDITORIAL`';
            $sentencia = $conexion -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_editorial, $nombre_editorial);
                while ($sentencia -> fetch()) {
                    $objeto = new Editorial();
                    $objeto -> id_editorial = $id_editorial;
                    $objeto -> nombre_editorial = $nombre_editorial;
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

    function eliminarEditoriale($id_editorial) {
        $conexion = new MySqlCon();
        $fecha = date('Y-m-d H:i:s');
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `editorial` WHERE `id_editorial`=?';
            $sentencia = $conexion -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $id_editorial);
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