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
    //Función para retornar varios datos de una tabla.
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
    public function addClient($slqStamtement){
        return $this -> connection ->query($slqStamtement);   
    }
    public function addContacDetails($idClient,$type,$value,$user){
       $result =$this -> connection ->query(
       "INSERT INTO DATOS_CONTACTO 
       (codigo_pertenece,tipo_dato,valor_dato,tipo_uso,usuario_insercion,fecha_insercion,fecha_modificacion)
       VALUES
       ((SELECT id_persona FROM PERSONA WHERE id_persona ='".$idClient."'),'".$type."','".$value."','P','".$user."',current_timestamp(),current_timestamp())");   
    }
}
?>