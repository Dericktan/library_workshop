<?php 
    // $server = "127.0.0.1";
	$server = "localhost";
	$user= "root";
	$password="";
	$db_name ="db_library";

	$con = mysqli_connect($server,$user,$password,$db_name);
	if(!$con)
	{
		die("Connection failed! :" . mysqli_connect_error());
	}

	// $baseUrl = "http://127.0.0.1/library_workshop";
	$baseUrl = "http://localhost/library_workshop";
	if ($_SERVER['SERVER_NAME'] == 'localhost') {
		$baseUrl = "http://localhost/library_workshop";
	} else {
		$baseUrl = $_SERVER["HTTP_ORIGIN"];
	}
 ?>