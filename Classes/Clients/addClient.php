<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "../Connection/Connection.php";
        require_once "../Costcenters/Company.php";

        $con = new Connection;
        //Parámetros del formulario
        $pool = $_POST['pool'];
        $idClient = $_POST['idClient'];
        $typeId = $_POST['typeId'];
        $clientName = $_POST['clientName'];
        $user = $_POST['user'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $direction = $_POST['direction'];
        $nPhone = $_POST['nPhone'];
        $eMail = $_POST['eMail'];
        
        //Obtiene la base de datos cliente
        $query2 = $con->getDBParameters("SELECT u.usuario, nombre_empresa, pool_empresa, password, ip_servidor FROM EMPRESA e JOIN USUARIO u ON e.usuario = u.usuario and pool_empresa ='".$pool."'");
        $con2 = new Company($query2);

        //Toma los parámetros de configuración
        $dir = dirname(__FILE__);
        $jsonData = file_get_contents($dir."/"."clientConf.json");
        $jsonC = json_decode($jsonData,true);
        
        //Sentencia de creación para cliente
        $sqlStm = "INSERT INTO PERSONA 
        (id_persona,tipo_identificacion,nombre,tipo_persona,regimen,rol,desde,sistema,usuario_insercion,fecha_insercion,usuario_modificacion,fecha_modificacion,ubicacion,vendedor,zona,sucursal_empresa,fecha_nacimiento)
        values 
        ('".$idClient."',".$typeId.",'".$clientName."','".$jsonC['tipo_persona']."','".$jsonC['regimen']."','Cliente',current_timestamp(),".$jsonC['sistema'].",'".$user."',current_timestamp(),'".$user."',current_timestamp(),".$con2->getLocation().",'".$user."',2,'".$jsonC['sucursal_empresa']."','".$dateOfBirth."')";
        echo $sqlStm;
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