<?php
	include 'config.php';
	
	function getAllPrinting()
	{
		global $con;
		
		$sql = "SELECT * FROM tb_printing";
		
		$query = $con->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$con->close();
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
	
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	function getOS() { 

		global $user_agent;

		$os_platform  = "Unknown OS Platform";

		$os_array = array(
						'/windows nt 10/i'      =>  'Windows',
						'/windows nt 6.3/i'     =>  'Windows',
						'/windows nt 6.2/i'     =>  'Windows',
						'/windows nt 6.1/i'     =>  'Windows',
						'/windows nt 6.0/i'     =>  'Windows',
						'/windows nt 5.2/i'     =>  'Windows',
						'/windows nt 5.1/i'     =>  'Windows',
						'/windows xp/i'         =>  'Windows',
						'/windows nt 5.0/i'     =>  'Windows',
						'/windows me/i'         =>  'Windows',
						'/win98/i'              =>  'Windows',
						'/win95/i'              =>  'Windows',
						'/win16/i'              =>  'Windows',
						'/macintosh|mac os x/i' =>  'Mac',
						'/mac_powerpc/i'        =>  'Mac',
						'/linux/i'              =>  'Linux',
						'/ubuntu/i'             =>  'Linux'
					);

		foreach ($os_array as $regex => $value)
		{
			if (preg_match($regex, $user_agent))
			{
				$os_platform = $value;
			}
		}

		return $os_platform;
	}

	function getOSBuild()
	{
		$phpIntSize = PHP_INT_SIZE;
		if ($phpIntSize == 4)
		{
			return "32";
		}
		if ($phpIntSize == 8)
		{
			return "64";
		}
		return false;
	}

	function getPdfInfoFilePath()
	{
		$os = getOS();
		$build = getOSBuild();
		$cwd = getcwd();
		$path = "";
		if ($os == "Windows")
		{
			$path = $cwd . "\\..\\..\\core\\plugin\\pdfinfo\\".$os."\\".$build."\\pdfinfo.exe";
		} else if ($os == "Linux" || $os == "Mac")
		{
			$path = $cwd . "/../../core/plugin/pdfinfo/".$os."/".$build."/pdfinfo";
		}

		return $path;
	}

	// Make a function for convenience 
	function getPDFPages($document)
	{
		$cmd = getPdfInfoFilePath();
		
		// Parse entire output
		// Surround with double quotes if file name has spaces
		try {
			//code...
			exec("$cmd \"$document\"", $output);
		} catch (Exception $e) {
			var_dump("Error");die;
		}
		// Iterate through lines
		$pagecount = 0;
		foreach($output as $op)
		{
			// Extract the number
			if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1)
			{
				$pagecount = intval($matches[1]);
				break;
			}
		}

		return $pagecount;
	}
	
	if(isset($_POST['downloadFile'])) {
		global $con;

	}
	
	if(isset($_POST['addPrinting'])){
		global $con;
		$user_id = $_POST['user_id'];
		$grayscale = $_POST['grayscale'];
		$file = $_FILES['file'];
		if ($grayscale == "on")
		{
			$grayscale = 1;
		}
		else
		{
			$grayscale = 0;
		}

		$uploadedDir = "";
		if (isset($_FILES["file"]) && count($_FILES["file"]) > 0)
		{
			$uploadedDir = uploadPDF($_FILES);
			if ($uploadedDir == false)
			{
				$uploadedDir = "";
			}
		}

		$total_pages = getPDFPages(getcwd().'/../..'.$uploadedDir);

		$base_price = 0;
		if ($grayscale)
		{
			$base_price = 0.1;
		}
		else
		{
			$base_price = 0.5;
		}
		$price = $total_pages * $base_price;

		$sql = "INSERT INTO tb_printing (user_id, file, total_pages, grayscale, price, paid) VALUES (1,'$uploadedDir', $total_pages, $grayscale, $price, FALSE)";
		$query = mysqli_query($con, $sql);
		if($query == TRUE)
		{
			echo "<script> alert('Successfully requested for print');</script>";
			$url = "/pages/web/index.php?page=Printing";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return false;   
		}
		else
		{
			echo "<script> alert('Fail to request for print');</script>";
			$url = "/pages/web/index.php?page=Printing";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return false;
		}

	}

	if(isset($_POST['updatePaid'])){
		global $con;
		$id = $_POST['id'];
		$sql = "UPDATE tb_printing set paid=1 where tb_printing.id='$id'";
		$query = mysqli_query($con,$sql);
		if($query == TRUE){
			echo "<script> alert('Successfully update as paid');</script>";
			$url = "/pages/admin/index.php?page=NewsList";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return true;
		}
		else{
			echo "<script> alert('Fail to update as paid');</script>";
			$url = "/pages/admin/index.php?page=NewsForm";
			$link = $baseUrl . $url;
			echo '<script> window.location.replace("'. $link .'");</script>';
			return false;
		}
	}


?>