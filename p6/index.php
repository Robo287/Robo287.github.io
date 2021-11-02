<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Other CSS-->
    <link rel="stylesheet" href="p6files/p6css.css">
</head>
<body class="text-center">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
	<header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Project 6 - Weather App</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="https://lamp.cse.fau.edu/~arobustelli2018/">Home</a>
                <a class="nav-link" href="#Sources">Sources</a>
            </nav>
        </div>
    </header>
    <main role="main" class="inner cover">
        <h1 class="cover-heading">Enter Your Zip Code</h1>
        <form method="post" action="index.php">
            <p class="lead"><input type="number" name="zipCode" id="zipCode"></p>
			<p class="lead"><input type="checkbox" name="setFav" id="setFav"> Set This Zip Code As A Favorite </p>
            <p class="lead">
                <input type="submit" class="btn btn-lg btn-secondary" value="Submit">
            </p>
        </form>
		<?php
			$apiURL = "http://api.openweathermap.org/data/2.5/weather";
			if (isset($_COOKIE["favZip"]) == TRUE) {
				$queryString = "zip=" . $_COOKIE["favZip"] . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
			}
			else {
				$queryString = NULL;
			}
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (isset($_POST["setFav"])) {
					setcookie("favZip", $_POST["zipCode"]);
				}
				
				if (empty($_POST["zipCode"]) == TRUE && isset($_COOKIE["favZip"]) == FALSE) {
					echo '<p>Please enter a zip code</p>';
					die();
				}
				else if (empty($_POST["zipCode"]) == FALSE) {
					$queryString = "zip=" . $_POST["zipCode"] . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
				}
			}
			if ($queryString == NULL) {
				die();
			}
			else {
				$fullURL = $apiURL . "?" . $queryString;
			}
			
			$response = file_get_contents($fullURL);
			
			if ($response === FALSE){
				die("Error contacting the web API");
			}
			else {
				$obj = json_decode($response);
				
				$location = $obj->name;
				$currentTemp = $obj->main->temp;
				$description = $obj->weather[0]->description;
				$humidity = $obj->main->humidity;
				$weatherIcon = $obj->weather[0]->icon;
				
				echo '<img src="p6images/' . $weatherIcon . '.png" alt="weatherIcon">';
				echo '<h1>Current Weather In ' . $location . '</h1>';
				echo '<p>Current Temp: ' . $currentTemp . '&deg;F</p>';
				echo '<p>Description: ' . $description . '</p>';
				echo '<p>Humidity: ' . $humidity . '%</p>';
			}
		?>
    </main>
	<footer class="mastfoot mt-auto">
		<div class="inner" id="Source">
			<p>Project 6 - Weather App by Anthony Robustelli       <h5>Sources: Weather App - <a href="https://learn.zybooks.com/zybook/FAUCOP3813MarquesFall2019/chapter/12/section/10">ZyBooks</a>  |  Bootstrap Template - <a href="https://getbootstrap.com/docs/4.0/examples/cover/">Cover</a></h5></p>
		</div>
	</footer>
    </div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>