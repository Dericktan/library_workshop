<?php
	include '../../core/config.php';
	include '../../core/room.php';

	$edit = false;
    if (isset($_GET["id"]))
    {
        $edit = true;
        $room = getRoom($_GET["id"]);
    }
?>

<form action="../../core/room.php" method="POST">
	<?php
        if ($edit)
        {
            echo "<input type='hidden' name='id' value='" . $room["id"] . "'>";
        }
    ?>
	Room No:<br>
	<input type="text" name="book_no" <?php if($edit){echo "disabled";}else{}?> value="<?php if($edit){ echo $book['book_no']; } else { echo ''; }; ?>" required>
	<br>
	Title:<br>
	<input type="text" name="title"  value="<?php if($edit){ echo $book['title']; } else { echo ''; }; ?>" required>
	<br>
	Author:<br>
	<input type="text" name="author"  value="<?php if($edit){ echo $book['author']; } else { echo ''; }; ?>" required>
	<br>
	Location:<br>
	<input type="text" name="book_location"  value="<?php if($edit){ echo $book['book_location']; } else { echo ''; }; ?>" required>
	<br>
	Book Category:<br>
	<select name="book_category">
		<option value="Knowledge" <?php if($edit && $book['book_category']=="Knowledge") {echo "Selected";}?> >Knowledge</option>
		<option value="Education" <?php if($edit && $book['book_category']=="Education") {echo "Selected";}?> >Education</option>
		<option value="Magazine" <?php if($edit && $book['book_category']=="Magazine") {echo "Selected";}?> >Magazine</option>
		<option value="Novel" <?php if($edit && $book['book_category']=="Novel") {echo "Selected";}?> >Novel</option>
		<option value="Fiction" <?php if($edit && $book['book_category']=="Fiction") {echo "Selected";}?> >Fiction</option>
		<option value="Non-Fiction" <?php if($edit && $book['book_category']=="Non-Fiction") {echo "Selected";}?> >Non-Fiction</option>
	</select>
	<br>
	<br>
	<input type="submit" name="<?php if($edit){ echo 'updateBook'; } else { echo 'addBook'; }; ?>" value="<?php if($edit){echo 'Update Book';} else{echo 'Add New Book';};?>">
</form>