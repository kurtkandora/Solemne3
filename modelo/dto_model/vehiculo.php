<?php
    Class Vehiculo{
        public $id_vehiculo,$id_tipo_vehiculo,$fabricante_vehiculo,$modelo_vehiculo,$anio_fabricacion,$descripcion_vehiculo;
        function __destruct() {
        unset($this);
    }
    }
?>