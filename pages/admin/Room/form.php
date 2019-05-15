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
	<input type="text" name="room_no" <?php if($edit){echo "disabled";}else{}?> value="<?php if($edit){ echo $room['room_no']; } else { echo ''; }; ?>" required>
	<br>
	Room Category:<br>
	<select name="room_type">
		<option value="Single Room" <?php if($edit && $room['room_type']=="Single Room") {echo "Selected";}?> >Single Room</option>
		<option value="Discussion Room" <?php if($edit && $room['room_type']=="Discussion Room") {echo "Selected";}?> >Discussion Room</option>
	</select>
	<br>
	<br>
	<input type="submit" name="<?php if($edit){ echo 'updateRoom'; } else { echo 'addRoom'; }; ?>" value="<?php if($edit){echo 'Update Room';} else{echo 'Add New Room';};?>">
</form>