<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "Classes/Connection/Connection.php";
        $con = new Connection;
        $user = $_POST['user'];
        $password = $_POST['password'];
        $nameCompany = $_POST['nameCompany'];
        $query ="SELECT pool_empresa 
                FROM EMPRESA e JOIN USUARIO u 
                ON e.usuario = u.usuario
                and e.usuario ='".$user."' 
                and u.password='".$password."' 
                and nombre_empresa = '".$nameCompany."'";
        echo ($con->getDBinfo($query));
    }
?>