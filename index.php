

<?php include_once 'header.php'; ?>
<?php

require_once './libs/Database.php';
require_once './libs/Task.php';

/**
 * 
 * CREATE DATABASE CONNECTION 
 * 
 * */ 
$database = new Database();
$conn = $database->getConnection();

/**
 * 
 * CREATE AN USER INSTANCE 
 * 
 * */
$task = new Task($conn);

$allTask = $task->getAllTasks();


/**
 * 
 *  DELETE A TASK THROUGH AN ID 
 * 
 * */ 
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["taskId"])) {
    $taskId = $_POST["taskId"];
    $result = $task->deleteTask($taskId);
    if($result){
        header("location: index.php");
        exit();
    } 
}

?>

<div class='container-sm mt-4'>
    <?php if (!empty($success)): ?>
        <div class="p-3 mb-4 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <?php echo $success; ?>
</div>
    <?php endif; ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        while($row = $allTask->fetch_assoc()){

          
          /**
          * 
          *  CHECK IF DESCIRPTION LENGHT TO LARGE-> THEN SHORT IT AND PROVIDE NEW STRING INTO NEW VAIRABLE
          * 
          * */ 
          $trimedDescription; 
          if(strlen($row["description"]) > 50){
            $trimedDescription = substr($row["description"], 0, 50). '...';
          } else {
            $trimedDescription = $row["description"];
          }
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td class='task-data'> <a class='task-title' href='/rtsoft/details.php?id=".$row["id"]."'>" . $row["title"] . "</a></td>";
            echo "<td>" . $trimedDescription . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "<td class='d-flex gap-3'>
                <a class='btn btn-primary' href='/rtsoft/edit.php?id=" . $row["id"] . "'>Edit</a>
                <form method='post' action='index.php'>
                        <input type='hidden' name='taskId' value='" . $row["id"] . "'>
                        <button type='submit' class='btn btn-danger'>Delete</button>
                    </form>
                
            </td>";
            echo "</tr>";
        } ?>
      
    
  </tbody>
</table>
</div>

<?php include_once 'footer.php'; ?>