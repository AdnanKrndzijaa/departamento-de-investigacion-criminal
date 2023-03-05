<?php


class WantedDao {

    private $conn;
    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "12345adnan";
        $schema = "dic_database";
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }

    public function get_all() {
        $stmt = $this->conn->prepare("SELECT * FROM wanted");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function get_by_id($id) {
        $stmt = $this->conn->prepare("SELECT * FROM wanted WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

    public function add($wanted){
        $stmt= $this->conn->prepare("INSERT INTO wanted (first_name, last_name, image, description) VALUES (:first_name, :last_name, :image, :description)");
        $stmt->execute($wanted);
        $wanted['id'] = $this->conn->lastInsertId();
        return $wanted;
    }

    public function delete($id){
        $stmt= $this->conn->prepare("DELETE FROM wanted WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($wanted){
        $stmt = $this->conn->prepare("UPDATE wanted SET first_name=:first_name, last_name=:last_name, image=:image, description=:description WHERE id=:id");
        $stmt->execute($wanted);
        return $wanted;
    }

}


?>