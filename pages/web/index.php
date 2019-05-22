<?php 
	require '../../core/config.php';
	require '../../core/auth.php';
	
	if (logged_in() == false)
	{
		header("Location: ../../login.php");
	}

    $user_id = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/css/main-style.css">
	<title>Library System</title>
</head>
<body class="bg">
	<!-- Code for changing content -->
	<div style="height: 60px; padding: 15px 15px 0px 15px;">
		<?php if (isset($_GET['page'])): ?>
			<a class="btn btn-primary text-left" href="index.php">Back to main page</a>
		<?php endif; ?>
		<a class="btn btn-primary text-right" href="../../logout.php">Log out</a>
		<?php if (!isset($_GET['page']) || $_GET['page'] == ""): ?>
			<a class="btn btn-primary text-right" style="margin-right:20px;" href="index.php?page=MyBooking">My Booking</a>
		<?php endif; ?>
		<?php if (isset($_GET['page']) && $_GET['page'] == "SearchBook"): ?>
			<a class="btn btn-primary text-right" href="index.php?page=Cart" style="margin-right: 20px;">Cart</a>
		<?php endif; ?>
		<?php if (isset($_GET['page']) && $_GET['page'] == "PastYear"): ?>
			<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 3): ?>
			<a class="btn btn-primary text-right" href="index.php?page=PastYearForm" style="margin-right: 20px;">Add Past Year</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];

			switch ($page)
			{
				case 'DiscussionRoom':
					include "./discussion_room/index.php";
					break;
				case 'Feedback':
					include "./feedback/index.php";
					break;
				case 'News':
					include "./news/index.php";
					break;
				case 'Printing':
					include "./printing/index.php";
					break;
				case 'PastYearForm':
					include "./past_year/form.php";
					break;
				case 'PastYear':
					include "./past_year/index.php";
					break;
				case 'SearchBook':
					include "./book/index.php";
					break;
				case 'Cart':
					include "./book/cart.php";
					break;
				case 'MyBooking':
					include "./booking/index.php";
					break;
				default:
					include "content.php";
					break;
			}
		}
		else
		{
			include "content.php";
		}
	?>
		<!-- end of Admin Content -->
	
</body>
</html>