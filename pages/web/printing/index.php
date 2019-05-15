<?php 
	require '../../core/config.php';
	require '../../core/auth.php';
	require '../../core/printing.php';
	
	// if (logged_in() == false)
	// {
	// 	header("Location: ../../login.php");
	// }

    // $user_id = $_SESSION["id"];
    $user_id = 1;
?>
<div class="align-center">
	<h1 class="title">Request to Print</h1>
</div>
<div class="form-container" style="background-color: white; padding: 15px;">
    <p>Upload your file here so we can print it for you!</p>
    <p>0.1 RM for grayscale print</p>
    <p>0.5 RM for colored print</p>
    <fieldset>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="form-group">
                <label for="">File</label>
                <input type="file" name="file" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="">Grayscale ?</label>
                <input type="checkbox" name="grayscale">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="addPrinting" style="width: 100%;"><b>Submit</b></button>
            </div>
        </form>
    </fieldset>
</div>