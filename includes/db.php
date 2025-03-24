<?php
// Filepath: c:/xampp/htdocs/souffle_ecommerce/includes/db.php

class Database {
    private $servername = "localhost:3307"; // Replace with your database server
    private $username = "root"; // Replace with your database username
    private $password = ""; // Replace with your database password
    private $dbname = "souffle_db"; // Replace with your database name
    public $conn;

    public function __construct() {
        // Create a connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Optional: Set the character set to UTF-8
        $this->conn->set_charset("utf8");
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>