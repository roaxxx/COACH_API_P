<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/CostCenter.php";

        $con = new Connection;

        $poolCompany = $_POST['poolCompany'];
        $table = $_POST['table'];

        $query2 = $con->getDBParameters("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and pool_empresa ='".$poolCompany."'");
        $con2 = new Company($query2);
        if($table==1){
            echo $con2->getDataList("SELECT id,nombre FROM CENTRO_COSTO");
        }else if($table==2){
            echo $con2->getDataList("SELECT id_persona as id, nombre as name FROM persona where rol ='cliente'");
        }else if($table==3){
            echo $con2->getDataList("SELECT nombre,usuario,password FROM NOMINA JOIN PERSONA ON persona = id_persona AND ROL = 'Empleado' AND usuario != '' AND password != ''");
        }
    }
?>