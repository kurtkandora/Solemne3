<?php
require_once '../modelo/dbo_model/tipo_de_vehiculoDAO.php';
require_once '../modelo/dto_model/tipo_de_vehiculo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' | $_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_de_vehiculo_model = new Tipo_de_vehiculoDAO();
    $tipo_de_vehiculo = new Tipo_de_vehiculo();

    switch ($_SERVER['REQUEST_METHOD']) {

        case 'POST' :
            if (!empty($_POST['id_tipo_vehiculo'])) {
                $tipo_de_vehiculo -> id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
                $tipo_de_vehiculo -> descripcion_tipo_Vehiculo = $_POST['descripcion_tipo_Vehiculo'];
                $tipo_de_vehiculo -> nombre_tipo_vehiculo = $_POST['nombre_tipo_vehiculo'];
                $tipo_de_vehiculo_model -> update($vehiculo);
            } else if (!empty($_POST['descripcion_tipo_Vehiculo'])) {
                $tipo_de_vehiculo -> descripcion_tipo_Vehiculo = $_POST['descripcion_tipo_Vehiculo'];
                $tipo_de_vehiculo -> nombre_tipo_vehiculo = $_POST['nombre_tipo_vehiculo'];
                $tipo_de_vehiculo_model -> insert($tipo_de_vehiculo);
            }
            break;

        case 'GET' :
            if (!empty($_GET['del'])) {
                $tipo_de_vehiculo -> id_tipo_vehiculo = $_GET['del'];
                $tipo_de_vehiculo_model -> delete($tipo_de_vehiculo);
            }
            break;

        default :
            break;
    }
    $tipo_de_vehiculo -> __destruct();
    $tipo_de_vehiculo_model -> __destruct();
}

header('Status: 301 Moved Permanently', false, 301);
header('Location:../vista/tipoVehiculos.php');

?>