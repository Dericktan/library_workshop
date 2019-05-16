<?php
	include '../../core/config.php';
	include '../../core/faculty.php';
	include '../../core/course.php';
	include '../../core/past_year.php';

	$edit = false;
    if (isset($_GET["id"]))
    {
        $edit = true;
        $pastyear = getPastYear($_GET["id"]);
	}
	$user_id = $_SESSION["id"];
?>

<div class="half-width">
	<form action="" method="POST" enctype="multipart/form-data">
		<?php
			if ($edit)
			{
				echo "<input type='hidden' name='id' value='" . $pastyear["id"] . "'>";
			}
		?>
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<div class="form-group">
			<label for="">Year</label>
			<input type="text" class="form-control" name="year" value="<?php if ($edit) { echo $pastyear['year']; }else{} ?>">
		</div>
		<div class="form-group">
			<label for="">Subject</label>
			<input type="text" class="form-control" name="subject" value="<?php if ($edit) { echo $pastyear['subject']; }else{} ?>">
		</div>
		<div class="form-group">
			<label for="">Faculty</label>
			<select name="faculty_id" class="form-control">
				<?php
					$result = getAllFaculty();
					$no = 0;
					if ($result != false)
					{
						while($row = $result->fetch_assoc())
						{
							$no++;
							$id = $row["id"];
							$faculty_name = $row["faculty_name"];
				?>
					<option value="<?php echo $id; ?>" <?php if ($edit && $id == $pastyear['faculty_id']) {echo 'selected';}else{} ?>><?php echo $faculty_name; ?></option>
				<?php
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Course</label>
			<select name="course_id" class="form-control">
				<?php
					$result = getAllCourse();
					$no = 0;
					if ($result != false)
					{
						while($row = $result->fetch_assoc())
						{
							$no++;
							$id = $row["id"];
							$course_name = $row["course_name"];
				?>
					<option value="<?php echo $id; ?>" <?php if ($edit && $id == $pastyear['course_id']) {echo 'selected';}else{} ?>><?php echo $course_name; ?></option>
				<?php
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="">File</label>
			<input type="file" class="form-control" name="file" accept=".pdf">
		</div>
		<button type="submit" class="btn btn-primary" name="<?php if($edit){ echo 'updateAdminPastYear'; } else { echo 'addAdminPastYear'; }; ?>"><?php if($edit){echo 'Update Past Year';} else{echo 'Add New Past Year';};?></button>
	</form>
</div>