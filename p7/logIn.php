<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>P7 - Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="p7files/bootstrap/css/bootstrap.min.css">
    <!--Grayscale CSS-->
    <link rel="stylesheet" href="p7files/bootstrap/css/grayscale.css">
    <!--Other CSS-->
    <link rel="stylesheet" href="p7files/p7css.css">
    <!--Custom Fonts-->
    <link rel="stylesheet" href="p7files/bootstrap/fontawesome-free/css/all.min.css">
</head>
<body id="page-top">
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Weather App - Login</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-expanded="false" aria-label="Toggle Navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="http://lamp.cse.fau.edu/~arobustelli2018">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="guestWeatherApp.php">Use As Guest</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Header-->
    <header class="logIn">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
				<div class="container">
					<?php
						session_start();
						if ($_SERVER["REQUEST_METHOD"] == "POST")
						{
							$username = $_POST["username"];
							$password = $_POST["password"];

							$mysqli = new mysqli("localhost", "arobustelli2018", "Z9rs+aUOgr", "arobustelli2018");
							$sql = "SELECT username, password FROM weather_logins WHERE username='". $mysqli->real_escape_string($username) . "'";
							$result = $mysqli->query($sql);
							if (!$result)
							{
								die("Error executing query: ($mysqli->errno) $mysqli->error");
							}
							else if ($result->num_rows == 0)
							{
								echo "<p class='errorText'>Incorrect username or password.</p>";
							}
							else
							{
								$row = $result->fetch_assoc();

								if (password_verify($password, $row["password"]))
								{
									//echo "<p class='successText'>Login test successful.</p>";
									$_SESSION["username"] = $username;
									header("Location: weatherApp.php");
									die;
								}
								else 
								{
									echo "<p class='errorText'>Incorrect username or password.</p>";
								}
							}
						}
					?>
				</div>
				<form method="post" action="logIn.php">
					<h1>Login</h1>
					<p>Enter Your Account Credentials</p>
					<hr>
					<div class="form-group row">
						<input type="text" class="form-control" placeholder="Username" name="username" required>
					</div>
					<div class="form-group row">
						<input type="password" class="form-control" placeholder="Password" name="password" minlength="8" required>
					</div>
					<hr>
					<button type="submit" class="btn btn-primary js-scroll-trigger" name="signUpBtn">Login</button>
					<p>Don't have an account? - <a href="signUp.php">Sign Up</a>.</p>
				</form>
            </div>
        </div>
    </header>
    <!--Footer-->
    <footer class="bg-black small text-center text-white-50 fixed-bottom">
        <div class="container">
            Project 7 - Improved Weather App | Anthony Robustelli | Fall 2019
        </div>
    </footer>
    <!--Bootstrap Core JavaScript-->
    <script src="p7files/bootstrap/jquery/jquery.min.js"></script>
    <script src="p7files/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Plugin JavaScript-->
    <script src="p7files/bootstrap/jquery/jquery.easing.min.js"></script>
    <!--Custom Script For Grayscale Template-->
    <script src="p7files/bootstrap/js/grayscale.min.js"></script>
    <!-- Optional JavaScript -->
</body>
</html>