<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="../../assets/css/main-style.css">
	<title>Document</title>
</head>
<body class="bg">
	<!-- Code for changing content -->
	<div style="height: 60px; padding: 15px 15px 0px 15px;">
		<?php if (isset($_GET['page'])): ?>
			<a class="btn btn-primary text-left" href="index.php">Back to main page</a>
		<?php endif; ?>
		<a class="btn btn-primary text-right" href="../../logout.php">Log out</a>
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