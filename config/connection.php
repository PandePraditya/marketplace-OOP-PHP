<?php 
    class Connection {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "market";
        public $conn;

        // Create connection
        public function connect() {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
            return $this->conn;
        }
    }