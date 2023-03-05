<?php


class NewsDao {

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
        $stmt = $this->conn->prepare("SELECT * FROM news");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function get_by_id($id) {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result); 
    }

    public function add($news){
        $stmt= $this->conn->prepare("INSERT INTO news (title, date, description) VALUES (:title, :date, :description)");
        $stmt->execute($news);
        $news['id'] = $this->conn->lastInsertId();
        return $news;
    }

    public function delete($id){
        $stmt= $this->conn->prepare("DELETE FROM news WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($news){
        $stmt = $this->conn->prepare("UPDATE news SET title=:title, description=:description, date=:date WHERE id=:id");
        $stmt->execute($news);
        return $news;
    }

}


?>