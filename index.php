<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "Classes/Connection/Connection.php";
        $con = new Connection;
        $query = $_POST['address'];
        print_r($con->getDBinfo("SELECT * FROM DB WHERE address ='".$query."'"));
    }
?>