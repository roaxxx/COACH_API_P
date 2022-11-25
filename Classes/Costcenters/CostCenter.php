<?php
class CostCenter{
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
            $this->server = $value['address'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['DBName'];
            $this->port = $value['port'];
        }
        $this->connection = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        if($this->connection->connect_errno){
            echo "Algo ha salido mal con la conexión";
            die;
        }
    }
    private function changeFormat($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,"utf-8",true)){
                $item = utf8_encode($item);
            }
        });
        return json_encode($array); 
    }
    public function getCostCenters($sqlstr){
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