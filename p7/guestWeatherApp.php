<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>P7 - Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="p7files/bootstrap/css/bootstrap.css">
    <!--Grayscale CSS-->
    <link rel="stylesheet" href="p7files/bootstrap/css/grayscale.css">
    <!--Other CSS-->
    <link rel="stylesheet" href="p7files/p7css.css">
    <!--Custom Fonts-->
    <link rel="stylesheet" href="p7files/bootstrap/fontawesome-free/css/all.min.css">
</head>
<body>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Weather App - Guest</a>
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
                        <a class="nav-link js-scroll-trigger" href="logIn.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#top">Back To Top</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<!--Header-->
    <header class="guestApp" id="top">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
				<h1 class="cover-heading">Enter Your Zip Code</h1>
				<form method="post" action="guestWeatherApp.php">
					<p class="lead"><input type="number" name="zipCode" id="zipCode"></p>
					<p class="lead">
						<input type="submit" class="btn btn-lg btn-secondary" value="Submit">
					</p>
				</form>
				<div class="container">
					<?php
						$apiURL = "http://api.openweathermap.org/data/2.5/weather";

						$queryString = "zip=90210&units=imperial&appid=5943285054e07b6985c0445af1c57260";

						if ($_SERVER["REQUEST_METHOD"] == "POST") 
						{				
							if (empty($_POST["zipCode"]) == TRUE) {
								echo '<p class="text-white-0">Please enter a zip code</p>';
								die("Zip code field was empty");
							}
							else 
							{
								$queryString = "zip=" . $_POST["zipCode"] . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
							}
						}
						$fullURL = $apiURL . "?" . $queryString;
			
						$response = file_get_contents($fullURL);
			
						if ($response === FALSE)
						{
							die("Error contacting the web API");
						}
						else 
						{
							$obj = json_decode($response);
				
							$location = $obj->name;
							$currentTemp = $obj->main->temp;
							$description = $obj->weather[0]->description;
							$humidity = $obj->main->humidity;
							$weatherIcon = $obj->weather[0]->icon;
				
							echo '<img src="p7images/' . $weatherIcon . '.png" alt="weatherIcon">';
							echo '<h1 class="text-white-0">Current Weather In ' . $location . '</h1>';
							echo '<p class="text-white-0">Current Temp: ' . $currentTemp . '&deg;F</p>';
							echo '<p class="text-white-0">Description: ' . $description . '</p>';
							echo '<p class="text-white-0">Humidity: ' . $humidity . '%</p>';
						}
					?>
				</div>
				<div class="justify-content-center">
					<p class="text-white-50">If you would like to try more features such as saving zip codes or setting a favorite zip code, try signing up or logging in</p>
					<a href="signUp.php" class="btn btn-primary js-scroll-trigger">Sign Up</a>
				</div>
            </div>
        </div>
    </header>
    <!--Footer-->
    <footer class="bg-black small text-center text-white-50">
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