<?php

    class Database {

        private $servername = "mysql";
        private $username = "root";
        private $password = "root";
        private $dbname = "gamelibrary";
        private $conn;

        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit();
              }
        }

        public function getConnection() {
            return $this->conn;
        }

    }


?>