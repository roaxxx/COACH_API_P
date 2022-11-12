<?php
class Connection{
    //Atributos
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $connection;
    //Método constructor
    function __construct(){
        $dataList = $this->dataConnection();
        foreach ($dataList as $key =>$value){
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->connection = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        if($this->connection->connect_errno){
            echo "Algo ha salido mal con la conexión";
            die;
        }
    }

    private function dataConnection(){
        $address = dirname(__FILE__);
        $jsonData = file_get_contents($address."/"."config");
        return json_decode($jsonData,true);
    }
    private function changeFormat($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,"utf-8",true)){
                $item = utf8_encode($item);
            }
        });
        return json_encode($array); 
    }
    public function getDBInfo($sqlstr){
         $results= $this ->connection ->query($sqlstr);
         $resultArray = array();
         foreach ($results as $key){
            $resultArray[] = $key;
         }
         return $this -> changeFormat($resultArray);
    }
}
?>