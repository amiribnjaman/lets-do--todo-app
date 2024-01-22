<?php include_once 'header.php'; ?>
<?php

require_once './libs/Database.php';
require_once './libs/Task.php';

// Create a database connection
$database = new Database();
$conn = $database->getConnection();

// Create a User instance
$task = new Task($conn);
$allTask = $task->getAllTasks()

?>

<div class='container-sm mt-4'>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        while($row = $allTask->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        } ?>
      
    
  </tbody>
</table>
</div>
<?php include_once 'footer.php'; ?>