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
        $sql = "SELECT * FROM todos ORDER BY id DESC";
        return $this->conn->query($sql);
    }

    public function deleteTask($taskId) {
        $sql = "DELETE FROM todos WHERE id=$taskId";
        return $this->conn->query($sql);
    }
}
?>
