<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $POST_R = json_decode(file_get_contents("php://input"));

        require_once "../Classes/Connection/Connection.php";
        require_once "../Classes/Costcenters/Company.php";

        $con = new Connection;

        $query = $con->getDBParameters($POST_R ->pool);

        $con2 = new Company($query);

        $query = "SELECT id_persona as id, nombre as name, rol FROM persona where  rol ='cliente' or rol = 'Empleado'";
        
        echo ($con2->getDataList($query,"persons"));  
    }
?>