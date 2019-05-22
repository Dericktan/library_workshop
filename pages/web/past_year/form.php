<?php
	include '../../core/config.php';
	include '../../core/faculty.php';
	include '../../core/course.php';
	include '../../core/past_year.php';
    $edit = false;
?>
<div class="align-center">
    <h1 class="title">Add Past Year</h1>
</div>
<div class="form-container">
	<form action="" method="POST" enctype="multipart/form-data">
		<?php
			if ($edit)
			{
				echo "<input type='hidden' name='id' value='" . $pastyear["id"] . "'>";
			}
		?>
		<div class="form-group">
			<label for="">Year</label>
			<input type="text" class="form-control" name="year">
		</div>
		<div class="form-group">
			<label for="">Subject</label>
			<input type="text" class="form-control" name="subject">
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
					<option value="<?php echo $id; ?>"><?php echo $faculty_name; ?></option>
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
					<option value="<?php echo $id; ?>"><?php echo $course_name; ?></option>
				<?php
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="">File</label>
			<input type="file" class="form-control" name="file" accept=".pdf,.docx,.doc">
		</div>
		<button type="submit" class="btn btn-primary" name="addLecturePastYear">Add past year</button>
	</form>
</div>