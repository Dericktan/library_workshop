<?php
    include'config.php';

    function getAllNews()
	{
		global $con;
		
		$sql = "SELECT * FROM tb_news";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$con->close();
	}


    if(isset($_POST['addNews'])){
        global $con;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $sql = "INSERT INTO tb_news (title,content) VALUES ('$title','$content')";
        $exec = mysqli_query($con,$sql);
        if($exec == TRUE){
            echo "<script> alert('Successfully add a news!');</script>";
            $url = "/pages/admin/index.php?page=NewsList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }


?>