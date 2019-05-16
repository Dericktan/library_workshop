<?php 
	require '../../core/config.php';
	require '../../core/past_year.php';
	
	// if (logged_in() == false)
	// {
	// 	header("Location: ../../login.php");
	// }

	// $user_id = $_SESSION["id"];
?>
<div class="align-center">
	<h1 class="title">Past Year</h1>
</div>
<div class="content-container" style="background-color: #ffffff;">
	<table style="background-color: white;">
		<thead>
			<tr>
				<th>No</th>
				<th>Subject</th>
				<th>Year</th>
				<th>Faculty</th>
				<th>Course</th>
				<th>Download</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$result = getAllPastYear();
				$no = 0;
				if ($result != false)
				{
					while($row = $result->fetch_assoc())
					{
						$no++;
						$id = $row["id"];
						$year = $row["year"];
						$subject = $row["subject"];
						$faculty_name = $row["faculty_name"];
						$course_name = $row["course_name"];
						$file = $row["file"];
			?>
			<tr>
				<th scope="row"><?php echo $no; ?></th>
				<td><?php echo $subject; ?></td>
				<td><?php echo $year; ?></td>
				<td><?php echo $faculty_name; ?></td>
				<td><?php echo $course_name; ?></td>
				<td>
					<a class="btn btn-primary" href="../../download.php?file=<?php echo urlencode($file); ?>">Download</a>
				</td>
                <td>
					<a class="btn btn-primary" href="index.php?page=PastYearForm&id=<?php echo $id;?>">Edit</a>
				</td>
			</tr>
			<?php
					}
				} else {
					
				
			?>
				<tr>
					<td colspan=""></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>