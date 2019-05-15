<?php 
    require '../../core/auth.php';
    require '../../core/feedback.php';
    
    if (logged_in() == false)
    {
        header("Location: ../../login.php");
    }

    $user_id = $_SESSION["id"];
?>
<div class="align-center">
    <h1 class="title">Feedback</h1>
</div>
<div class="form-container">
    <form action="" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="form-group">
            <textarea name="content" class="form-control" rows="30" style="height: 400px; max-width: -webkit-fill-available;"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="width: 100%;"><b>Submit</b></button>
        </div>
    </form>
</div>