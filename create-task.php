<?php include_once 'header.php'; ?>

<div class="container-sm mt-3 mx-auto w-50 ">
    <form class="align-middle  " action="">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Task title">
        </div>
        <select class="form-select" aria-label="Default select example">
            <option selected>Task status</option>
            <option value="complete">Complete</option>
            <option value="incomplete">Incomplete</option>
        </select>
        <div class="mb-3 mt-3">
            <label for="descripttion" class="form-label">Descripttion</label>
            <textarea class="form-control" id="descripttion" name="descripttion" rows="3"></textarea>
        </div>
        <div>
            <button type="button" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
 

<?php include_once 'footer.php'; ?>