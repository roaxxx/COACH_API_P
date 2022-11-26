<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/CostCenter.php";

        $con = new Connection;

        $address = $_POST['address'];
        $action = $_POST['action'];
        $filter = $_POST['filter'];

        $query2 = $con->getDBParameters("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and ip_servidor ='".$address."'");

        $con2 = new Company($query2);
        if($action==0){
            echo $con2->getDataList("SELECT id_linea_producto, nombre FROM LINEA_PRODUCTO");
        }else if($action==1){
            echo $con2->getDataList("SELECT id_producto,nombre, precio_venta1, foto FROM PRODUCTO");
        }else if($action==2){
            echo $con2->getDataList("SELECT id_producto,p.nombre, precio_venta1, foto FROM PRODUCTO p JOIN linea_producto l_p where id_linea_producto = (SELECT id_linea_producto FROM linea_producto WHERE nombre = '".$filter."')");
        }
    }
?>