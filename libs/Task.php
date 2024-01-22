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


    public function getOne($id){
        $sql = "SELECT * FROM todos WHERE id=$id";
        $result= $this->conn->query($sql);
        if($result && $result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function deleteTask($taskId) {
        $sql = "DELETE FROM todos WHERE id=$taskId";
        return $this->conn->query($sql);
    }


    public function updateTask($taskId, $title, $description, $status) {
        $title = mysqli_real_escape_string($this->conn, $title);
        $description = mysqli_real_escape_string($this->conn, $description);
        $status = mysqli_real_escape_string($this->conn, $status);

        $sql = "UPDATE todos SET title='$title', description='$description', status='$status' WHERE id = $taskId";

        return $this->conn->query($sql);

    }
}
?>
