<?php
    include 'config.php';
    
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
    function getNews($id)
    {
        global $con;
        $select = "SELECT * FROM tb_news where tb_news.id ='$id'";
        $check = mysqli_query($con,$select);
        if($check->num_rows >0){
            return $check->fetch_assoc();
        }
        return false;
    }
    
    if(isset($_POST['addNews'])){
        global $con;
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "INSERT INTO tb_news (title,content) VALUES ('$title','$content')";
        $query = mysqli_query($con, $sql);
        if($query == TRUE)
        {
            echo "<script> alert('Successfully Added the News');</script>";
            $url = "/pages/admin/index.php?page=NewsList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;   
        }
        else
        {
            echo "<script> alert('Fail to add News');</script>";
            $url = "/pages/admin/index.php?page=NewsForm";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }

    }

    if(isset($_POST['updateNews'])){
        global $con;
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $sql = "UPDATE tb_news set title='$title', content='$content' where tb_news.id='$id'";
        $query = mysqli_query($con,$sql);
        if($query == TRUE){
            echo "<script> alert('Successfully Updated the News');</script>";
            $url = "/pages/admin/index.php?page=NewsList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to update the News');</script>";
            $url = "/pages/admin/index.php?page=NewsForm";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }

    if(isset($_POST['deleteNews'])){
        global $con;
        $id = $_POST['id'];
        $sql = "DELETE FROM tb_news where tb_news.id='$id'";
        $query = mysqli_query($con,$sql);
        if($query == TRUE){
            echo "<script> alert('Successfully Delete the News');</script>";
            $url = "/pages/admin/index.php?page=NewsList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            echo "<script> alert('Fail to delete the News');</script>";
            $url = "/pages/admin/index.php?page=NewList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return false;
        }
    }
?>