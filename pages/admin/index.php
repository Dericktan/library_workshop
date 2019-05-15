<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
		<li style="float:right"><a class="active" href="#about">Logout</a></li>
	</ul>
	</div>
	<!-- end of Top Navbar -->

	<!-- Start of Admin Content -->
	<div class="admin-content">
		<h2>Here is your content</h2>
		<!-- Code for changing content -->
		<?php
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];

			switch ($page)
			{
				case 'BookForm':
					include "./";
					break;
				case 'BookList':
					include "./";
					break;
				case 'RoomForm':
					include "./";
					break;
				case 'RoomList':
					include "./";
					break;
				case 'PastYearForm':
					include "./";
					break;
				case 'PastYearList':
					include "./";
					break;
				case 'NewsForm':
					include "./";
					break;
				case 'NewsList':
					include "./";
					break;
				case 'BookBookingForm':
					include "./";
					break;
				case 'RoomBookingForm':
					include "./";
					break;
				case 'PrintingForm':
					include "./";
					break;
				case 'FeedBackList':
					include "./";
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