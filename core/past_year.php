<?php
    include 'config.php';

    function getAllPastYear()
    {
		global $con;
		
		$sql = "SELECT tb_pastyear.id, tb_pastyear.year, tb_pastyear.subject, tb_pastyear.file, tb_faculty.faculty_name, tb_course.course_name FROM tb_pastyear INNER JOIN tb_faculty ON tb_faculty.id = tb_pastyear.faculty_id INNER JOIN tb_course ON tb_course.id = tb_pastyear.course_id";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$con->close();
    }

    function uploadPDF($files) {
		$uploadDir = "/uploads/files/";
		$randomStrName = generateRandomString(8);
		$fileName = $files["file"]["name"];
		$divide = explode(".", $fileName);
		$ext = end($divide);
		$baseDirectory = $uploadDir . $randomStrName . "." . $ext;

		$target_file = '../..'.$baseDirectory;
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file))
		{
			echo "The file ". basename( $files["file"]["name"]). " has been uploaded.";
			return $baseDirectory;
		}
		else
		{
			echo "Sorry, there was an error uploading your file.";
			return false;
		}
	}

    if(isset($_POST['addAdminPastYear'])){
        global $con;
        $user_id = $_POST['user_id'];
        $year = $_POST['year'];
        $faculty_id = $_POST['faculty_id'];
        $course_id = $_POST['course_id'];
        $subject = $_POST['subject'];
        $file = $_FILES['file'];

        $uploadedDir = "";
		if (isset($_FILES["file"]) && count($_FILES["file"]) > 0)
		{
			$uploadedDir = uploadPDF($_FILES);
			if ($uploadedDir == false)
			{
				$uploadedDir = "";
			}
		}

        $sql = "INSERT INTO tb_pastyear (user_id, year, faculty_id, course_id, subject, file) VALUES ('$user_id','$year', '$faculty_id', '$course_id', '$subject', $uploadedDir)";
        
        $exec = mysqli_query($con,$sql);
        if($exec == TRUE){
            echo "<script> alert('Your past year document has been submitted');</script>";
            $url = "/pages/admin/index.php?page=PastYearList";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }

    if(isset($_POST['addLecturePastYear'])){
        global $con;
        $user_id = $_POST['user_id'];
        $year = $_POST['year'];
        $faculty_id = $_POST['faculty_id'];
        $course_id = $_POST['course_id'];
        $subject = $_POST['subject'];
        $file = $_FILES['file'];

        $uploadedDir = "";
		if (isset($_FILES["file"]) && count($_FILES["file"]) > 0)
		{
			$uploadedDir = uploadPDF($_FILES);
			if ($uploadedDir == false)
			{
				$uploadedDir = "";
			}
		}

        $sql = "INSERT INTO tb_pastyear (user_id, year, faculty_id, course_id, subject, file) VALUES ('$user_id','$year', '$faculty_id', '$course_id', '$subject', $uploadedDir)";
        
        $exec = mysqli_query($con,$sql);
        if($exec == TRUE){
            echo "<script> alert('Your past year document has been submitted');</script>";
            $url = "/pages/web/index.php?page=PastYear";
            $link = $baseUrl . $url;
            echo '<script> window.location.replace("'. $link .'");</script>';
            return true;
        }
        else{
            // echo "<div class='alert alert-danger text-center'> Duplicate Book No Detected.</div>";
        }
    }
?>
