<?php
    class Usuarios {
    public $id_usuario, $nombre,$correo,$password;
    function __destruct() {
        unset($this);
    }
}
?>