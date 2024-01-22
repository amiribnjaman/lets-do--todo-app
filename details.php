<?php require_once 'header.php';



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


/**
 * 
 * GETTING WANTED TASK CURRENT VALUES
 * 
 * */ 
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id = $_GET["id"];
    $result = $task->getOne($id);
}


?>

<div class="container-sm mt-4 mx-auto w-50 ">
    <a href='/rtsoft/index.php'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="" width='35' height='35'>
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
</svg>
    </a>

    <div class="my-6 border p-4 rounded">
        <h3><?php echo $result["title"] ?></h3>
        <hr>
        <p>
            <?php echo $result["description"] ?>
        </p>

    <!-- <?php  ?> -->
    </div>
</div>


<?php require_once 'footer.php'; ?>

