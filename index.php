<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once "Classes/Connection/Connection.php";
        $con = new Connection;
        $query = $_POST['address'];
        $action = $_POST['action'];
        if($action==0){
            echo ($con->getDBinfo("SELECT * FROM DB WHERE address ='".$query."'"));
        }else{
            echo (json_decode(($con->getDBinfo("SELECT * FROM DB WHERE address ='".$query."'")),true));
        }
    }
?>