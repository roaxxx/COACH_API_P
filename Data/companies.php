<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $POST_R = json_decode(file_get_contents("php://input"));

        require_once "../Classes/Connection/Connection.php";
        require_once "../Classes/Costcenters/Company.php";

        $con = new Connection;

        $dbParams = $con->getDBParameters($POST_R->pool);

        $con2 = new Company($dbParams);

        $query = "SELECT rut, nombre FROM empresa";
        
        echo ($con2->getDataList($query,"companys"));  
    }
?>