<?php
	require '../../core/config.php';
	require '../../core/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Library</title>
</head>
<body>
	<?php
		require'navbar.php';
	?>
<!-- Admin Container-->
<div class="admin-container">
	<!-- start Top Navbar -->
	<div class="top-navbar">
	<ul>
		<li class="top-navbar-text">Welcome Admin</li>
		<li style="float:right">
			<a class="btn btn-primary text-right" href="../../logout.php">Log out</a>
		</li>
	</ul>
	</div>
	<!-- end of Top Navbar -->

	<!-- Start of Admin Content -->
	<div class="admin-content">
		<!-- <h2>Here is your content</h2> -->
		<!-- Code for changing content -->
		<?php
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];

			switch ($page)
			{
				case 'BookForm':
					include "./Book/form.php";
					break;
				case 'BookList':
					include "./Book/index.php";
					break;
				case 'RoomForm':
					include "./Room/form.php";
					break;
				case 'RoomList':
					include "./Room/index.php";
					break;
				case 'PastYearForm':
					include "./PastYear/form.php";
					break;
				case 'PastYearList':
					include "./PastYear/index.php";
					break;
				case 'NewsForm':
					include "./News/form.php";
					break;
				case 'NewsList':
					include "./News/index.php";
					break;
				case 'BookBooking':
					include "./Transaction/book_request.php";
					break;
				case 'RoomBooking':
					include "./Transaction/room_request.php";
					break;
				case 'Printing':
					include "./Transaction/print_request.php";
					break;
				case 'FeedBackList':
					include "./FeedBack/index.php";
					break;
				case 'BookBookingForm':
					include "./Transaction/bookbooking_form.php";
					break;
				case 'RoomBookingForm':
						include "./Transaction/roombooking_form.php";
						break;
				case 'BorrowedBook':
					include "./Transaction/book_return.php";
					break;
				case 'BorrowedRoom':
					include "./Transaction/roomkey_return.php";
					break;
				default:
					echo "<center><h3>404 | Not Found</h3></center>";
					break;
			}
		}
		else
		{
			// include "../404.html";
		}
		?>
		<!-- end of Admin Content -->
	</div>
</div>
<!-- end of Container -->
</body>
</html>