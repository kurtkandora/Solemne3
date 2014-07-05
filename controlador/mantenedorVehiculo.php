<?php
require_once '../modelo/dbo_model/vehiculoDAO.php';
require_once '../modelo/dto_model/vehiculo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' | $_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehiculo_model = new Vehiculodb();
    $vehiculo = new Vehiculo();

    switch ($_SERVER['REQUEST_METHOD']) {

        case 'POST' :
            if (!empty($_POST['id_vehiculo'])) {
                $vehiculo -> id_vehiculo = $_POST['id_vehiculo'];
                $vehiculo -> id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
                $vehiculo -> anio_fabricacion = $_POST['anio_fabricacion'];
                $vehiculo -> descripcion_vehiculo = $_POST['descripcion_vehiculo'];
                $vehiculo -> fabricante_vehiculo = $_POST['fabricante_vehiculo'];
                $vehiculo -> modelo_vehiculo = $_POST['modelo_vehiculo'];
                $vehiculo_model -> update($vehiculo);
            } else if (!empty($_POST['modelo_vehiculo'])) {
                $vehiculo -> id_tipo_vehiculo = $_POST['id_tipo_vehiculo'];
                $vehiculo -> anio_fabricacion = $_POST['anio_fabricacion'];
                $vehiculo -> descripcion_vehiculo = $_POST['descripcion_vehiculo'];
                $vehiculo -> fabricante_vehiculo = $_POST['fabricante_vehiculo'];
                $vehiculo -> modelo_vehiculo = $_POST['modelo_vehiculo'];
                $vehiculo_model -> insert($vehiculo);
            }
            break;

        case 'GET' :
            if (!empty($_GET['del'])) {
                $vehiculo -> id_vehiculo = $_GET['del'];
                $vehiculo_model -> delete($vehiculo);
            }
            break;

        default :
            break;
    }
    $vehiculo -> __destruct();
    $vehiculo_model -> __destruct();
}
header('Status: 301 Moved Permanently', false, 301);
header('Location:../vista/vehiculos.php');
?>