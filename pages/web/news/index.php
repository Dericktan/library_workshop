<?php 
	require '../../core/config.php';
	require '../../core/news.php';
	
	if (logged_in() == false)
	{
		header("Location: ../../login.php");
	}

	$user_id = $_SESSION["id"];
?>
<div class="align-center">
	<h1 class="title">Latest News</h1>
</div>
<div class="content-container" style="background-color: #ffffff;">
	<div class="news-container">
		<?php
			$result = getAllNews();
			$no = 0;
			if ($result != false)
			{
				while($row = $result->fetch_assoc())
				{
					$no++;
					$id = $row["id"];
					$title = $row["title"];
					$content = $row["content"];
					$date_created = $row["date_created"];
		?>
			<span class="news-title"><?php echo $title; ?></span>
			<span class="news-date">Posted on <?php echo date("d-m-Y h:m A", strtotime($date_created)); ?></span>
			<div style="clear: both;"></div>
			<p><?php echo $content; ?></p>
		<?php 
			if ($no > 0 && $no < $result->num_rows)
			{
				echo "<hr style='margin-top: 40px; margin-bottom: 40px;'>";
			}
		?>
		<?php
				}
			} else {
		?>
			<center><h1>No news available</h1></center>
		<?php
			}
		?>
		
	</div>
</div>