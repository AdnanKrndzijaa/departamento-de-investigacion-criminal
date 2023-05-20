<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
class DICDao {

    protected $conn;
    private $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;
        $servername = "sql7.freemysqlhosting.net";
        $username = "sql7619727";
        $password = "cA7njujdHB";
        $schema = "sql7619727";
        $port = "3306";
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;post=$port", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }

    public function get_all() {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function get_by_id($id) {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name." WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM ".$this->table_name." WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function add($entity){
        $query = "INSERT INTO ".$this->table_name." (";
        foreach ($entity as $column => $value) {
            $query .= $column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
            $query .= ":".$column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    
        $stmt= $this->conn->prepare($query);
        $stmt->execute($entity);
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
    }

    public function update($id, $entity, $id_column = "id"){
        $query = "UPDATE ".$this->table_name." SET ";
        foreach($entity as $name => $value){
        $query .= $name ."= :". $name. ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";

        $stmt= $this->conn->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }

    protected function query($query, $params){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    protected function query_unique($query, $params){
        $results = $this->query($query, $params);
        return reset($results);
    }


}


?>