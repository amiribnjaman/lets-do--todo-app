<?php
class Database
{
    
    /**
    * 
    * DATABASE VAIRABLES
    * 
    * */
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "rtsoft_todo";
    private $conn;

    public function __construct()
    {
        /**
        * 
        *  MYSQL CONNECTION
        * 
        * */
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
    * 
    *  ESTABSISH THE CONNECTION
    * 
    * */
    public function getConnection()
    {
        return $this->conn;
    }
}
?>
