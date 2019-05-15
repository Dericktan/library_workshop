<?php
	SESSION_START();
	function logged_in() {
		if(isset($_SESSION['id'])) {
			return true;
		} else {
			return false;
		}
	}

	function not_logged_in() {
		if(isset($_SESSION['id']) === FALSE) {
			return true;
		} else {
			return false;
		}
	}

	function isAdmin() {
		if (isset($_SESSION['role']) && $_SESSION['role'] == "Admin")
		{
			return true;
		} else {
			return false;
		}
	}

	function login($username, $password) {
		global $connect;
		$userdata = userExists($username);
	
		if($userdata) {
			$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$query = $connect->query($sql);

			if($query->num_rows == 1) {
                return true;
            }

			return false;
		}
	
		$connect->close();
	}

	function logout() {
		if(logged_in() === TRUE){
			session_unset();
			session_destroy();
	
			header('location: login.php');
		} else {
            header('location: login.php');
        }
	}

	function userExists($username) {
		global $connect;
	
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$query = $connect->query($sql);

		if ($query->num_rows == 1) {
			return true;
		}
		return false;
		$connect->close();
	}

	function getLoggedInUser($username) {
		global $connect;
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$query = $connect->query($sql);

		if ($query->num_rows == 1) {
			return $query->fetch_assoc();
		}

		return false;
	
		$connect->close();
	}

?>