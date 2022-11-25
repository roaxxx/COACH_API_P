<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/CostCenter.php";
        $con = new Connection;
        $query = $_POST['address'];
        $table = $_POST['table'];
        $query2 = $con->getDBinfo("SELECT * FROM DB WHERE address ='".$query."'");
        $con2 = new CostCenter($query2);
        if($table==1){
            echo $con2->getCostCenters("SELECT * FROM CENTRO_COSTO");
        }else if($table==2){
            echo $con2->getCostCenters("SELECT id_persona,tipo_identificacion, nombre FROM persona where rol ='cliente'");
        }else if($table==3){
            echo $con2->getCostCenters("SELECT id_persona,tipo_identificacion, nombre FROM persona where rol ='empleado'");
        }
    }
?>