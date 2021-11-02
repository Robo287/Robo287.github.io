<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>P7 - Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="p7files/bootstrap/css/bootstrap.css">
    <!--Grayscale CSS-->
    <link rel="stylesheet" href="p7files/bootstrap/css/grayscale.css">
    <!--Other CSS-->
    <link rel="stylesheet" href="p7files/p7css.css">
</head>
<body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Weather App - Sign Up</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-expanded="false" aria-label="Toggle Navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="http://lamp.cse.fau.edu/~arobustelli2018">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Header-->
    <header class="signUp">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
				<div class="container">
					<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST")
						{
							$mysqli = new mysqli("localhost", "arobustelli2018", "Z9rs+aUOgr", "arobustelli2018");
							$username = $_POST["username"];
							$password = $_POST["password"];
							$passwordConfirm = $_POST["passwordConfirm"];
							$qUserCheck = "SELECT * FROM weather_logins WHERE username='$username' LIMIT 1";
							$qResults = $mysqli->query($qUserCheck);
							$user = $qResults->fetch_assoc();
							$errorCount = 0;

							if ($password != $passwordConfirm)
							{
								$errorCount = 1;
								echo "<p class='errorText'>Your passwords did not match, please try again</p>";
							}

							if ($user)
							{
								if ($user['username'] === $username)
								{
									$errorCount = 1;
									echo "<p class='errorText'>The username <strong>$username</strong> already exists. Please choose a different one.</p>";
								}
							}

							if ($errorCount == 0)
							{
								$passwordHash = password_hash($password, PASSWORD_BCRYPT);
								$sql = "INSERT INTO weather_logins (username, password) VALUES ('". $mysqli->real_escape_string($username) . "', '$passwordHash')";
								$sql2 = "INSERT INTO weather_settings (username, ZIP1, ZIP2, ZIP3, ZIP4, ZIP5, ZIP6, ZIP7, ZIP8, ZIP9, ZIP10) VALUES ('". $mysqli->real_escape_string($username) . "', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

								if ($mysqli->query($sql))
								{
									echo "<p class='successText'>Your account has been created.</p>";
									if(!$mysqli->query($sql2))
									{
										echo "<p class='errorText'>There was an issue inserting into weather_settings DB.</p>";
										echo "<p class='errorText'>sql2 query: " . $sql2 . "</p>";
									}
									echo "<p><a href='logIn.php'>Login</a></p>";
								}
								else if ($mysqli->errno == 1062)
								{
									echo "<p class='errorText'>Database entry already exists. Please try again.</p>";
								}
								else
								{
									die("Error ($mysqli->errno) $mysqli->error");
								}
							}
						}
					?>
				</div>
				<form method="post" action="signUp.php">
					<h1>Sign Up</h1>
					<p>Please fill this form to sign up for a Weather App account</p>
					<hr>
					<div class="form-group row">
						<input type="text" class="form-control" placeholder="Username" name="username" required>
					</div>
					<div class="form-group row">
						<input type="password" class="form-control" placeholder="Password (At Least 8 Characters)" name="password" minlength="8" required>
					</div>
					<div class="form-group row">
						<input type="password" class="form-control" placeholder="Confirm Password" name="passwordConfirm" minlength="8" required>
					</div>
					<hr>
					<button type="submit" class="btn btn-primary js-scroll-trigger" name="signUpBtn">Sign Up</button>
					<p>Have an account already? - <a href="logIn.php">Log In</a>.</p>
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