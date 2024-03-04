<?php
    class MyConnect {
        private $host;
        private $user;
        private $passwd;
        private $database;
        private $conn;
        private $port;

        public function __construct() {
            $this->host = "cuahang.chy020meocy7.ap-southeast-1.rds.amazonaws.com";
            $this->port = 3306;
            $this->user = "tuqtuo";
            $this->passwd = "Root1234";
            $this->database = "cuahang";
            $this->conn = new mysqli($this->host, $this->user, $this->passwd, $this->database, $this->port);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function getConn() {
            return $this->conn;

        }
        public function setNextRs() {
            mysqli_next_result($this->conn);
        }
        public function isConnected() {
            if($this->conn->connect_errno) 
                return false;
            return true;
        }
        public function getTableData($tableName) {
            if($this->isConnected()) {
                $query = "select * from ".$tableName;
                $tableData = mysqli_query($this->conn, $query);


                return $tableData;
            }
        }
        public function query($query) {
            if($this->isConnected()) {
                $tableData = mysqli_query($this->conn,$query);
                return $tableData;
            }
        }

        public function insertData($query)
        {
            if($this->isConnected()) {
                return mysqli_query($this->conn, $query);
            }
        }
        public function closeConnect() {
            mysqli_close($this->conn);
        }

    }
?>