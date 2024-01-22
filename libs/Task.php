<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($title, $description, $status)
    {
        $sql = "INSERT INTO todos (title, description, status) VALUES ('$title', '$description', '$status')";
        return $this->conn->query($sql);
    }
}
?>
