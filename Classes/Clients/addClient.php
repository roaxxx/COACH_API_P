<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/CostCenter.php";
        $con = new Connection;
        $address = $_POST['address'];
        $idClient = $_POST['idClient'];
        $typeId = $_POST['typeId'];
        $clientName = $_POST['clientName'];
        $typeClient = $_POST['typeClient'];
        $user = $_POST['user'];
        $location = $_POST['location'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $direction = $_POST['direction'];
        $nPhone = $_POST['nPhone'];
        $eMail = $_POST['eMail'];
        $query2 = $con->getDBParameters("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and ip_servidor ='".$address."'");
        $con2 = new Company($query2);
        $sqlStm = "INSERT INTO PERSONA 
        (id_persona,tipo_identificacion,nombre,tipo_persona,rol,desde,sistema,usuario_insercion,fecha_insercion,usuario_modificacion,fecha_modificacion,ubicacion,vendedor,zona,sucursal_empresa,fecha_nacimiento)
        values 
        ('".$idClient."',".$typeId.",'".$clientName."','".$typeClient."','Cliente',current_timestamp(),1,'".$user."',current_timestamp(),'".$user."',current_timestamp(),".$location.",'".$user."',2,'01P','".$dateOfBirth."')";
        if($con2->addClient($sqlStm)){
            $con2->addContacDetails($idClient,"D",$direction,$user);
            $con2->addContacDetails($idClient,"T",$nPhone,$user);
            $con2->addContacDetails($idClient,"M",$eMail,$user);
            echo "Se ha registrado el cliente";
        }else{
            echo "No ha sido posible registrar el cliente";
        }
    }
?>