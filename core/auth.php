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
		global $con;
		$userdata = userExists($username);
	
		if($userdata) {
			$sql = "SELECT * FROM tb_users WHERE username = '$username' AND password = '$password'";
			$query = $con->query($sql);

			if($query->num_rows == 1) {
                return true;
            }

			return false;
		}
	
		$con->close();
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
		global $con;
	
		$sql = "SELECT * FROM tb_users WHERE username = '$username'";
		$query = $con->query($sql);

		if ($query->num_rows == 1) {
			return true;
		}
		return false;
		$con->close();
	}

	function getLoggedInUser($username) {
		global $con;
		$sql = "SELECT * FROM tb_users WHERE username = '$username'";
		$query = $con->query($sql);

		if ($query->num_rows == 1) {
			return $query->fetch_assoc();
		}

		return false;
	
		$con->close();
	}

?>