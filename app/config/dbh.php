<?php
class Dbh {
    private $host = "localhost";
    private $dbName = "jblog";
    private $pwd = "";
    private $user = "root";

    protected function conn(){
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $pdo = new PDO($dsn,$this->user,$this->pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }
}

