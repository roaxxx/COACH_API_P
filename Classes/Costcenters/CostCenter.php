<?php
class Company{
    //Atributos
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $connection;
    //Método constructor
    function __construct($dataList){
        foreach ($dataList as $key =>$value){
            $this->server = $value['ip_servidor'];
            $this->user = $value['usuario'];
            $this->password = $value['password'];
            $this->database = $value['pool_empresa'];
            $this->port = "3306";
        }
        $this->connection = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        if($this->connection->connect_errno){
            echo "Algo ha salido mal con la conexión";
            die;
        }
    }
    public function getDataList($sqlstr){
         $results= $this ->connection ->query($sqlstr);
         if($this ->connection->affected_rows>0){
            $json = "{\"data\":[";
            while($row=$results->fetch_assoc()){
                $json=$json.json_encode($row);
                $json=$json.",";
            }
            $json=substr(trim($json),0,-1);
            $json=$json."]}";
            return $json;
        }
    }
}
?>