<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/Company.php";

        $con = new Connection;

        $poolCompany = $_POST['poolCompany'];
        $action = $_POST['action'];

        $query = $con->getDBParameters("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and pool_empresa ='".$poolCompany."'");
        $con2 = new Company($query);
        /*
        switch($action){
            case 0:
                echo $con2->getDataList("");
                break;
            case 1:
                echo $con2->getDataList("SELECT id_persona as id, nombre as name, rol FROM persona where rol ='cliente' or rol ='Empleado'");
                break;
            case 2:
                echo $con2->getDataList("SELECT id_persona as id,nombre as name,usuario as user,password as passw FROM NOMINA JOIN PERSONA ON persona = id_persona AND usuario != '' AND password != ''");
                break;
            case 3:
                echo $con2->getDataList("SELECT rut, nombre FROM empresa");
                break;
            case 4:
                echo $con2->getDataList("SELECT id_linea_producto as idLinea, nombre FROM linea_producto");
                break;
            case 5:
                echo $con2->getDataList("SELECT id_producto,linea_producto,nombre,precio_venta1,porcentaje_iva,foto FROM producto");
                break;
        }*/
    }
?>