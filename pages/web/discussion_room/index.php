<?php 
	require '../../core/config.php';
	require '../../core/auth.php';
	require '../../core/discussion_room.php';
	
	// if (logged_in() == false)
	// {
	// 	header("Location: ../../login.php");
	// }

	// $user_id = $_SESSION["id"];
?>
<div class="align-center">
	<h1 class="title">Discussion Room</h1>
</div>
<?php if (getTotalAvailableRoom() > 0): ?>
	<div class="form-container">
		<form action="" method="POST">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<div class="form-group">
				<select name="room_id" class="form-control">
					<?php
						$result = getAllDiscussionRoom();
						$no = 0;
						if ($result != false)
						{
							while($row = $result->fetch_assoc())
							{
								$no++;
								$id = $row["id"];
								$room_no = $row["room_no"];
								$room_type = $row["room_type"];
					?>
						<option value="<?php echo $id; ?>"><?php echo $room_no; ?> - <?php echo $room_type; ?></option>
					<?php
							}
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="">Date</label>
				<input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
			</div>
			<div class="form-group">
				<label for="">Start Time</label>
				<input type="time" name="start_time" class="form-control" min="10:00">
			</div>
			<div class="form-group">
				<label for="">End Time</label>
				<input type="time" name="end_time" class="form-control" max="20:00">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="addBooking" style="width: 100%;"><b>Submit</b></button>
			</div>
		</form>
	</div>

<?php else: ?>
	<u><center><h1 style="color: white;">No available room!</h1></center></u>
<?php endif; ?>