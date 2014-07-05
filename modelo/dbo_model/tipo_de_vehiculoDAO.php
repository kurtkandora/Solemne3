<?php
require_once '../modelo/dto_model/tipo_de_vehiculo.php';
require_once 'db_abstract_model.php';
require_once '../modelo/dbconnect/mysqldb.php';
class Tipo_de_vehiculoDAO extends DBAbstractModel {

    private $mysql_con;

    function __construct() {
        $this -> mysql_con = new MySqlCon();
    }

    function insert($tipo_de_vehiculo) {
        if (!$this -> exist($tipo_de_vehiculo)) {
            try {

                $sqlQuery = 'INSERT INTO `tipo_de_vehiculo`(`NOMBRE_TIPO_VEHICULO`, `DESCRIPCION_TIPO_VEHICULO`) VALUES (?,?)';
                $sentencia = $this -> mysql_con -> prepare($sqlQuery);
                $sentencia -> bind_param("ss", $tipo_de_vehiculo -> nombre_tipo_vehiculo, $tipo_de_vehiculo -> descripcion_tipo_Vehiculo);
                $sentencia -> execute();

                if ($this -> mysql_con -> affected_rows) {
                    $this -> mysql_con -> commit();
                    return true;
                } else {
                    $this -> mysql_con -> rollback();
                    return false;
                }
                $this -> mysql_con -> close();
                $vehiculo -> __destruct();
            } catch(exception $e) {
                #exception arrastra solo el mensaje y Exception crea un objeto de si misma con otros atributos
                error_log($e);
                return false;
            }
        }
    }

    function exist($tipo_de_vehiculo) {
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `tipo_de_vehiculo` WHERE UPPER(TRIM(`nombre_tipo_vehiculo`)) = UPPER(TRIM(?))';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $tipo_de_vehiculo->nombre);
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
            $tipo_de_vehiculo->__destruct();
            $this->mysql_con -> close();
        } catch(Exception $e) {
            error_log($e);
           return FALSE;
        
        }
        return $verificador;
    }

    function selectAll() {
        $arreglo = array();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_TIPO_VEHICULO`, `NOMBRE_TIPO_VEHICULO`, `DESCRIPCION_TIPO_VEHICULO` FROM `tipo_de_vehiculo`';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            if ($sentencia -> execute()) {
                $sentencia -> bind_result($id_tipo_vehiculo, $nombre_tipo_vehiculo, $descripcion_tipo_Vehiculo);
                while ($sentencia -> fetch()) {
                    $objeto = new Tipo_de_vehiculo();
                    $objeto -> id_tipo_vehiculo = $id_tipo_vehiculo;
                    $objeto -> nombre_tipo_vehiculo = $nombre_tipo_vehiculo;
                    $objeto -> descripcion_tipo_Vehiculo = $descripcion_tipo_Vehiculo;
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

    function delete($tipo_vehiculo) {
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `tipo_de_vehiculo` WHERE `ID_TIPO_VEHICULO`=?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $tipo_vehiculo->$id_tipo_vehiculo);
            if ($sentencia -> execute()) {
                $this->mysql_con->commit();
                $del_valido = TRUE;
            } else {
                $this->mysql_con->rollback();
                $del_valido = FALSE;
            }
            $this->mysql_con -> close();
            $tipo_vehiculo->__destruct();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $del_valido;
    }
    
    function update($obj){
        
        try{
            $tipo_de_vehiculo= new Tipo_de_vehiculo();
            $tipo_de_vehiculo = $obj;
            $query = 'UPDATE `tipo_de_vehiculo` SET `NOMBRE_TIPO_VEHICULO`=?,`DESCRIPCION_TIPO_VEHICULO`=? WHERE `ID_TIPO_VEHICULO`= ?';
            $sentencia = $this->mysql_con->prepare($query);
            $sentencia->bind_param("sss",$tipo_de_vehiculo->nombre_tipo_vehiculo,$tipo_de_vehiculo->descripcion_tipo_Vehiculo,$tipo_de_vehiculo->id_tipo_vehiculo);
            $sentencia->execute();
            if($this->mysql_con->affected_rows){
                $this->mysql_con->commit();
                return true;
            }else{
                $this->mysql_con->rollback();
                return false;
            }
            $this->mysql_con->close();
            $tipo_de_vehiculo->__destruct();
        }
        catch(exception $e){
            error_log($e);
            return false;
        }
    }

    function __destruct() {
        unset($this);
    }

}
?>