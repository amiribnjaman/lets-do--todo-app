<?php include_once 'header.php'; 


require_once './libs/Database.php';
require_once './libs/Task.php';
// Create a database connection
$database = new Database();
$conn = $database->getConnection();

// Create a User instance
$task = new Task($conn);


// GETTING WANTED TASK CURRENT VALUES
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id = $_GET["id"];
    $result = $task->getOne($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    // If there are no validation errors, create the user
    if (!empty($title) && !empty($description) && !empty($status)) {
        $result = $task->updateTask($taskId, $title, $description, $status);
        if($result){
            $success = "Task updated successfully!";
            header('location: index.php');
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<div  class="container-sm mt-2 mx-auto w-50 ">
    <form class="align-middle  " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $result["id"];?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" value="<?php echo $result["title"] ?>" type="text" class="form-control" id="title" placeholder="Task title">
        </div>
        
        <select name="status" class="form-select" aria-label="Default select example">
            <option <?php if($result["status"] == 'incomplete'): ?> selected <?php endif;?> value="incomplete">Incomplete</option>
            <option <?php if($result["status"] == 'complete'): ?> selected <?php endif;?>  value="complete">Complete</option>
        </select>

        <div class="mb-3 mt-3">
            <label for="descripttion" class="form-label">Descripttion</label>
            <textarea class="form-control"  value="<?php echo $result["description"];?>" id="descripttion" name="description" rows="3"><?php echo $result["description"];?></textarea>

        </div>
        <div>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>

<?php include_once 'footer.php'; ?>
