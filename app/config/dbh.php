<?php
class Dbh {
    private $host = "localhost";
    private $dbName = "jblog";
    private $pwd = "";
    private $user = "root";
    protected $conn;

    public function __construct(){
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $this->conn = new PDO($dsn,$this->user,$this->pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }
}

