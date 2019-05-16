<?php 
	require '../../core/config.php';
	require '../../core/feedback.php';
	
	if (logged_in() == false)
	{
	    header("Location: ../../login.php");
	}

	$user_id = $_SESSION["id"];
?>
<div class="align-center">
	<h1 class="title">Search your Book Title Here</h1>
</div>
<div class="form-container">
	<form action="index.php?page=SearchBook" method="get">
		<input type="hidden" name="page" value="SearchBook">
		<div class="form-group">
			<input type="text" class="form-control" name="book_title" placeholder="Type your book title here!" value="<?php if (isset($_GET["book_title"])) { echo $_GET['book_title']; } else { echo ''; } ?>" style="width: 68%; display: inline;">
			<select name="book_category" class="form-control" style="width: 20%; display: inline;">
				<option value="Knowledge" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Knowledge") {echo "Selected";}?> >Knowledge</option>
				<option value="Education" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Education") {echo "Selected";}?> >Education</option>
				<option value="Magazine" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Magazine") {echo "Selected";}?> >Magazine</option>
				<option value="Novel" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Novel") {echo "Selected";}?> >Novel</option>
				<option value="Fiction" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Fiction") {echo "Selected";}?> >Fiction</option>
				<option value="Non-Fiction" <?php if(isset($_GET['book_category']) && $_GET['book_category']=="Non-Fiction") {echo "Selected";}?> >Non-Fiction</option>
			</select>
			<button class="btn btn-primary" type="submit"><img src="../../assets/images/search.png" width="15px" style="filter: invert(100%);" alt=""></button>
		</div>
		<div class="form-group">
			
		</div>
	</form>
	<table style="background-color: white;">
		<thead>
			<tr>
				<th>No</th>
				<th>Book No</th>
				<th>Title</th>
				<th>Author</th>
				<th>Location</th>
				<th>Book Category</th>
				<th>Available</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query ="SELECT * FROM tb_book";
			if (isset($_GET["book_title"]))
			{
				$query .= " WHERE title LIKE '%" . $_GET['book_title'] . "%'";
			}
			if (isset($_GET['book_category']))
			{
				$query .= " AND book_category = '" . $_GET['book_category'] . "'";
			}
			$sql = mysqli_query($con, $query);
			
			if(mysqli_num_rows($sql)==0)
				{
					echo "<tr> <td colspan='8'> <center>Sorry! There is no data in the database now.</center> </td> </tr>";
				}
				else
				{
					$i=0;
					while($data = mysqli_fetch_array($sql))
					{
						$i++;
						$id = $data['id'];
						$book_no = $data['book_no'];
						$title = $data['title'];
						$author = $data['author'];
						$location = $data['book_location'];
						$category =$data['book_category'];
						$available = $data['available'];
			?>
				<tr>
					<td> <?php echo $i;?></td>
					<td> <?php echo $book_no;?></td>
					<td> <?php echo $title;?></td>
					<td> <?php echo $author;?></td>
					<td> <?php echo $location;?></td>
					<td> <?php echo $category;?></td>
					<td> <?php if($available==TRUE){echo "Yes";}else{echo "No";}?></td>
					<td> <a class="btn btn-primary" href="index.php?page=BookForm&id=<?php echo $id;?>">Edit</a></td>
				</tr>
			<?php
					}
				}
			?>
		</tbody>
	</table>
	<!-- <form action="" method="GET">
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<div class="form-group">
			<textarea name="content" class="form-control" rows="30" style="height: 400px; max-width: -webkit-fill-available;"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" style="width: 100%;"><b>Submit</b></button>
		</div>
	</form> -->
</div>