<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createTask($title, $description, $status)
    {
        $sql = "INSERT INTO todos (title, description, status) VALUES ('$title', '$description', '$status')";
        return $this->conn->query($sql);
    }

    public function getAllTasks()
    {
        $sql = "SELECT * FROM todos";
        return $this->conn->query($sql);
    }
}
?>
