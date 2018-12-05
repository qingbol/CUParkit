<?php
    class Database {
        // Jack Production Database Parameters
        private $host = "mysql1.cs.clemson.edu";
        private $db_name = "CPSC_4620_c0ei";
        private $charset = "utf8";
        private $username = "CPSC_4620_a31t";
        private $password = "SoQoolLearning1";
        private $conn;
       
        // Jack localhost DB Params
        // private $host = "localhost";
        // private $db_name = "CUParkit";
        // private $charset = "utf8";
        // private $username = "parkingMgr";
        // private $password = "abc123";
        // private $conn;

        // Qingbo remote Database Parameters
        // private $host = "mysql1.cs.clemson.edu";
        // private $db_name = "parkit";
        // private $charset = "utf8";
        // private $username = "qbl";
        // private $password = "Dbms#6620";
        // private $conn;

        // Qingbo localhost Database Parameters
        // private $host = "localhost";
        // private $db_name = "cpsc6620";
        // private $charset = "utf8";
        // private $username = "root";
        // private $password = "0000";
        // private $conn; // Connection to the database
        
        // Connect to Database
        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=$this->charset", $this->username, $this->password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ));
            } catch (PDOException $e) {
                // echo("Connection Error: " . $e->getMessage());
                // To avoid printing a stack trace that contains the credentials, catch and rethrow the exception
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
            return $this->conn;
        }

        public function getHost() {
            return $this->host;
        }
        public function getDB() {
            return $this->db_name;
        }
        public function getUser() {
            return $this->username;
        }
        public function getPass() {
            return $this->password;
        }
    }
