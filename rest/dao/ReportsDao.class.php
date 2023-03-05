<?php


class ReportsDao {

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
        $stmt = $this->conn->prepare("SELECT * FROM reports");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function get_by_id($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reports WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

    public function add($reports){
        $stmt= $this->conn->prepare("INSERT INTO reports (first_name, last_name, date_of_birth, phone, email, city, country, zip, category, description) VALUES (:first_name, :last_name, :date_of_birth, :phone, :email, ;city, :country, :category, :description)");
        $stmt->execute($reports);
        $reports['id'] = $this->conn->lastInsertId();
        return $reports;
    }

    public function delete($id){
        $stmt= $this->conn->prepare("DELETE FROM reports WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($reports){
        $stmt = $this->conn->prepare("UPDATE reports SET first_name=:first_name, last_name=:last_name, date_of_birth=:date_of_birth, phone=:phone, email=:email, city=:city, country=:country, zip=:zip, category=:category, description=:description WHERE id=:id");
        $stmt->execute($reports);
        return $reports;
    }

}


?>