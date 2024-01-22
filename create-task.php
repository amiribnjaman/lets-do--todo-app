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


/**
 * 
 * DEFINE INITIAL VALIRABELS WITH EMPTY VALUE
 * 
 * */
$title = $description = $status = "";
$titleErr = $descriptionErr = $statusErr = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = test_input($_POST["title"]);
        // Check if title only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $title)) {
            $titleErr = "Only letters and white space allowed";
            $title = '';
        } else {
            $title = test_input($_POST["title"]);
        }
    }

    // Validate description
    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
    } else {
        $description = test_input($_POST["description"]);
    }

    // Validate Status
    if (empty($_POST["status"])) {
        $statusErr = "Status field is required";
    } else {
        $status = test_input($_POST["status"]);
    }


    // If there are no validation errors, create the user
    if (!empty($title) && !empty($description) && !empty($status)) {
        $task->createTask($title, $description, $status);
        $success = "Task created successfully!";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<div class="container-sm mt-2 mx-auto w-50 ">
    <?php if (!empty($success)): ?>
        <div class="p-3 mb-4 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
  <?php echo $success; ?>
</div>
    <?php endif; ?>
    <form class="align-middle  " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Task title">
            <?php if (!empty($titleErr)): ?>
        <span class="text-danger"> <?php echo $titleErr; ?></span>
    <?php endif; ?>
        </div>
        
        <select name="status" class="form-select" aria-label="Default select example">
            <option selected value="incomplete">Incomplete</option>
            <option value="complete">Complete</option>
        </select>
        <?php if (!empty($statusErr)): ?>
        <span class="text-danger"> <?php echo $statusErr; ?></span>
    <?php endif; ?>

        <div class="mb-3 mt-3">
            <label for="descripttion" class="form-label">Descripttion</label>
            <textarea class="form-control" id="descripttion" name="description" rows="3"></textarea>
            <?php if (!empty($descriptionErr)): ?>
        <span class="text-danger"> <?php echo $descriptionErr; ?></span>
    <?php endif; ?>

        </div>
        <div>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
</div>
 

<?php include_once 'footer.php'; ?>