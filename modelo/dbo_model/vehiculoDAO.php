<?php
require_once '../modelo/dto_model/vehiculo.php';
require_once 'db_abstract_model.php';
require_once '../modelo/dbconnect/mysqldb.php';
class vehiculoDAO extends DBAbstractModel {

    private $mysql_con;

    function __construct() {
        $this -> mysql_con = new MySqlCon();
    }

    function insert($vehiculo) {
        if(!$this->exist($vehiculo)) 
        {   
        try {
            
            $sqlQuery = 'INSERT INTO `INSERT INTO `vehiculo`( `ID_TIPO_VEHICULO`, `FABRICANTE_VEHICULO`, `MODELO_VEHICULO`, `ANIO_FABRICACION`, `DESCRIPCION_VEHICULO`) VALUES (?,?,?,?,?)';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("issss", $vehiculo->id_tipo_vehiculo,$vehiculo->fabricante_vehiculo,$vehiculo->modelo_vehiculo,$vehiculo->anio_fabricacion,$vehiculo->descripcion_vehiculo);
            if ($this -> mysql_con -> affected_rows) {
                    $this -> mysql_con -> commit();
                    $valido= true;
                } else {
                    $this -> mysql_con -> rollback();
                    $valido= false;
                }
                $this -> mysql_con -> close();
                $vehiculo -> __destruct();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $valido;
        }
        else{return false;}
    }
        function exist($vehiculo) {
        try {
            $sqlQuery = 'SELECT COUNT(*)FROM `vehiculo` WHERE UPPER(TRIM(`MODELO_VEHICULO`)) = UPPER(TRIM(?))';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("s", $vehiculo->modelo_vehiculo);
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
            $vehiculo->__destruct();
        } catch(Exception $e) {
            error_log($e);
            return false;
        }
        return $verificador;
    }
    function selectAll() {
        $arreglo=array();
        $indice = 0;
        try {
            $sqlQuery = 'SELECT `ID_VEHICULO`,`ID_TIPO_VEHICULO`, `FABRICANTE_VEHICULO`, `MODELO_VEHICULO`, `ANIO_FABRICACION`, `DESCRIPCION_VEHICULO` FROM `vehiculo`';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
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

    function delete($vehiculo) {
        $del_valido;
        try {
            $sqlQuery = 'DELETE FROM `vehiculo` WHERE `ID_VEHICULO`=?';
            $sentencia = $this->mysql_con -> prepare($sqlQuery);
            $sentencia -> bind_param("i", $vehiculo->id_vehiculo);
            if ($sentencia -> execute()) {
                $this->mysql_con->commit();
                $del_valido = TRUE;
            } else {
                $this->mysql_con->rollback();
                $del_valido = FALSE;
            }
            $this->mysql_con -> close();
            $vehiculo->__destruct();
        } catch(Exception $e) {
            error_log($e);
        }
        return $del_valido;
    }
    
    function update($obj){
        $reg_valido;
        try{
            $vehiculo= new Vehiculo();
            $vehiculo = $obj;
            $query = 'UPDATE `vehiculo` SET `ID_TIPO_VEHICULO`=?,`FABRICANTE_VEHICULO`=?,`MODELO_VEHICULO`=?,`ANIO_FABRICACION`=?,`DESCRIPCION_VEHICULO`=? WHERE `ID_VEHICULO`= ?';
            $sentencia = $this->mysql_con->prepare($query);
            $sentencia->bind_param("issssi",$vehiculo->id_tipo_vehiculo,$vehiculo->fabricante_vehiculo,$vehiculo->modelo_vehiculo,$vehiculo->anio_fabricacion,$vehiculo->descripcion_vehiculo,$vehiculo->id_vehiculo);
            $sentencia->execute();
            if($this->mysql_con->affected_rows){
                $this->mysql_con->commit();
                $reg_valido = true;
            }else{
                $this->mysql_con->rollback();
                $reg_valido = false;
            }
            $this->mysql_con->close();
            $vehiculo->__destruct();
        }
        catch(exception $e){
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