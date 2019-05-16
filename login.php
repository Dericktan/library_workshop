<?php
	require 'core/config.php';
	require 'core/auth.php';

	if (logged_in() == true)
	{
		if (isset($_SESSION['role']))
		{
			$role = $_SESSION['role'];
			if ($role == 1)
			{
				header("Location: ./pages/admin/index.php");
			} else if ($role == 2 || $role == 3)
			{
				header("Location: ./pages/web/index.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login - Library System</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="container">
		<div class="box-shadow text-center login-container">
			<div class="container">
				<?php
					// form submiited
					if($_POST) {
						$username = $_POST['username'];
						$password = $_POST['password'];

						$alertFailed = "<div class='alert alert-danger'>";
						$error = false;
						
						if($username == "") {
							$alertFailed .= " * Username Field is Required <br />";
						}

						if($password == "") {
							$alertFailed .= " * Password Field is Required <br />";
						}

						if($username && $password) {
							if(userExists($username) == TRUE) {
								$login = login($username, $password);
								if($login) {
									$userdata = getLoggedInUser($username);

									$_SESSION['id'] = $userdata['id'];
									$_SESSION['username'] = $userdata['username'];
									$_SESSION['role'] = $userdata['role'];
									if ($userdata['role'] == 1)
									{
										$link = "/pages/admin/index.php";
										$redirect = $baseUrl . $link;
										echo "<script> window.location.replace('$redirect'); </script>";

										return true;
										exit();
									} else if ($userdata['role'] == 2 || $userdata['role'] == 3)
									{
										$link = "/pages/web/index.php";
										$redirect = $baseUrl . $link;
										echo "<script> window.location.replace('$redirect'); </script>";

										return true;
										exit();
									}
									

									$link = "/login.php";
									$redirect = $baseUrl . $link;
									echo "<script> window.location.replace('$redirect'); </script>";

									return true;
									exit();
										
								} else {
									$alertFailed .= "Incorrect username or password.";
								}
							} else{
								$alertFailed .= "Incorrect username or password.";
							}
						}
						$alertFailed .= "</div>";
						echo $alertFailed;
					}
				?>
				<form action="" method="post">
					<h2 class="text-muted">Login Form</h2>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Enter your username ...">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Enter your password ...">
					</div>
					<button type="submit" class="btn btn-primary" name="login">Login</button>
					<div style="margin-top: 20px; margin-bottom: 20px;">
						<a href="register.php">I don't have an account</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>