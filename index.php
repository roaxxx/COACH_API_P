<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "Classes/Connection/Connection.php";
        $con = new Connection;
        $address = $_POST['address'];
        echo ($con->getDBinfo("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and ip_servidor ='".$address."'"));
    }
?>