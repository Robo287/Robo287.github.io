<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/2000/svg">
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
	<?php
		session_start();
		$mysqli = new mysqli("localhost", "arobustelli2018", "Z9rs+aUOgr", "arobustelli2018");
		$username = $_SESSION['username'];
		$apiURL = "http://api.openweathermap.org/data/2.5/weather";
	?>
    <!--Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="p7images/animated/icon.svg"> User: <?php echo $username ?></a>
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
    <header class="guestApp">
		<div class="container">
			<div class="container row">
				<div class="col-3">
					<div class="m-0 p-0 b-0" id="accordion">
						<?php
							$qUserCheck = "SELECT * FROM weather_settings WHERE username='" . $mysqli->real_escape_string($username) . "' LIMIT 1";
							$results = $mysqli->query($qUserCheck);
							if (!$results)
							{
								echo "<p>". $username ."</p>";
								echo "<p>". $mysqli->real_escape_string($username) ."</p>";
								echo "<p>". $qUserCheck ."</p>";
								die("Error executing query: ($mysqli->errno) $mysqli->error");
							}
							else 
							{
								$row = $results->fetch_assoc();
								$ZIP1 = $row["ZIP1"];
								$ZIP2 = $row["ZIP2"];
								$ZIP3 = $row["ZIP3"];
								$ZIP4 = $row["ZIP4"];
								$ZIP5 = $row["ZIP5"];
								$ZIP6 = $row["ZIP6"];
								$ZIP7 = $row["ZIP7"];
								$ZIP8 = $row["ZIP8"];
								$ZIP9 = $row["ZIP9"];
								$ZIP10 = $row["ZIP10"];
								$locCount = 0;
							}
						?>
						<?php
							if (!empty($_GET['clearSaved']))
							{
								$clearSQL = "UPDATE weather_settings SET `ZIP1` = NULL, `ZIP2` = NULL, `ZIP3` = NULL, `ZIP4` = NULL, `ZIP5` = NULL, `ZIP6` = NULL, `ZIP7` = NULL, `ZIP8` = NULL, `ZIP9` = NULL, `ZIP10` = NULL WHERE username = '$username'";
								$clrResults = $mysqli->query($clearSQL);
								if (!$clrResults)
								{
									echo "<p class='text-white'>". $clearSQL ."</p>";
									die("Error executing query: ($mysqli->errno) $mysqli->error");
								}
								else 
								{
									echo '<p class="text-white">Saved zip codes cleared</p>';
									echo '<p class="text-white">Run a zip code to see the effects.</p>';
								}
							}
							else 
							{
						?>
						<form action="weatherApp.php" method="get">
							<input type="hidden" name="clearSaved" value="run">
							<input type="submit" class="btn btn-lg btn-secondary m-2" value="Clear Saved Zips">
						</form>
						<?php
							}//close above script
						?>
						<!--Save Location 1-->
						<?php
							if ($ZIP1 != NULL) {
								$locCount++;
								$loc1Query = "zip=" . $ZIP1 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc1URL = $apiURL . "?" . $loc1Query;
								$loc1response = file_get_contents($loc1URL);
								if ($loc1response === FALSE) {
									echo '<p class="errorText">' . $loc1URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc1obj = json_decode($loc1response);
									$location1 = $loc1obj->name;
									$loc1currentTemp = $loc1obj->main->temp;
									$loc1description = $loc1obj->weather[0]->description;
									$loc1humidity = $loc1obj->main->humidity;
									$loc1weatherIcon = $loc1obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP1 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingOne">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										<?php 
											echo '<p class="m-1">' . $ZIP1 . '<img src="p7images/animated/' . $loc1weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location1 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc1currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc1description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 2-->
						<?php
							if ($ZIP2 != NULL) {
								$locCount++;
								$loc2Query = "zip=" . $ZIP2 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc2URL = $apiURL . "?" . $loc2Query;
								$loc2response = file_get_contents($loc2URL);
								if ($loc2response === FALSE) {
									echo '<p class="errorText">' . $loc2URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc2obj = json_decode($loc2response);
									$location2 = $loc2obj->name;
									$loc2currentTemp = $loc2obj->main->temp;
									$loc2description = $loc2obj->weather[0]->description;
									$loc2humidity = $loc2obj->main->humidity;
									$loc2weatherIcon = $loc2obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP2 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingTwo">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										<?php 
											echo '<p class="m-1">' . $ZIP2 . '<img src="p7images/animated/' . $loc2weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location2 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc2currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc2description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 3-->
						<?php
							if ($ZIP3 != NULL) {
								$locCount++;
								$loc3Query = "zip=" . $ZIP3 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc3URL = $apiURL . "?" . $loc3Query;
								$loc3response = file_get_contents($loc3URL);
								if ($loc3response === FALSE) {
									echo '<p class="errorText">' . $loc3URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc3obj = json_decode($loc3response);
									$location3 = $loc3obj->name;
									$loc3currentTemp = $loc3obj->main->temp;
									$loc3description = $loc3obj->weather[0]->description;
									$loc3humidity = $loc3obj->main->humidity;
									$loc3weatherIcon = $loc3obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP3 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingThree">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										<?php 
											echo '<p class="m-1">' . $ZIP3 . '<img src="p7images/animated/' . $loc3weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location3 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc3currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc3description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 4-->
						<?php
							if ($ZIP4 != NULL) {
								$locCount++;
								$loc4Query = "zip=" . $ZIP4 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc4URL = $apiURL . "?" . $loc4Query;
								$loc4response = file_get_contents($loc4URL);
								if ($loc4response === FALSE) {
									echo '<p class="errorText">' . $loc4URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc4obj = json_decode($loc4response);
									$location4 = $loc4obj->name;
									$loc4currentTemp = $loc4obj->main->temp;
									$loc4description = $loc4obj->weather[0]->description;
									$loc4humidity = $loc3obj->main->humidity;
									$loc4weatherIcon = $loc3obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP4 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingFour">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										<?php 
											echo '<p class="m-1">' . $ZIP4 . '<img src="p7images/animated/' . $loc4weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location4 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc4currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc4description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 5-->
						<?php
							if ($ZIP5 != NULL) {
								$locCount++;
								$loc5Query = "zip=" . $ZIP5 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc5URL = $apiURL . "?" . $loc5Query;
								$loc5response = file_get_contents($loc5URL);
								if ($loc5response === FALSE) {
									echo '<p class="errorText">' . $loc5URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc5obj = json_decode($loc5response);
									$location5 = $loc5obj->name;
									$loc5currentTemp = $loc5obj->main->temp;
									$loc5description = $loc5obj->weather[0]->description;
									$loc5humidity = $loc5obj->main->humidity;
									$loc5weatherIcon = $loc5obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP5 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingFive">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										<?php 
											echo '<p class="m-1">' . $ZIP5 . '<img src="p7images/animated/' . $loc5weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location5 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc5currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc5description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 6-->
						<?php
							if ($ZIP6 != NULL) {
								$locCount++;
								$loc6Query = "zip=" . $ZIP6 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc6URL = $apiURL . "?" . $loc6Query;
								$loc6response = file_get_contents($loc6URL);
								if ($loc6response === FALSE) {
									echo '<p class="errorText">' . $loc6URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc6obj = json_decode($loc6response);
									$location6 = $loc6obj->name;
									$loc6currentTemp = $loc6obj->main->temp;
									$loc6description = $loc6obj->weather[0]->description;
									$loc6humidity = $loc6obj->main->humidity;
									$loc6weatherIcon = $loc6obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP6 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingSix">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
										<?php 
											echo '<p class="m-1">' . $ZIP6 . '<img src="p7images/animated/' . $loc6weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location6 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc6currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc6description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 7-->
						<?php
							if ($ZIP7 != NULL) {
								$locCount++;
								$loc7Query = "zip=" . $ZIP7 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc7URL = $apiURL . "?" . $loc7Query;
								$loc7response = file_get_contents($loc7URL);
								if ($loc7response === FALSE) {
									echo '<p class="errorText">' . $loc7URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc7obj = json_decode($loc7response);
									$location7 = $loc7obj->name;
									$loc7currentTemp = $loc7obj->main->temp;
									$loc7description = $loc7obj->weather[0]->description;
									$loc7humidity = $loc7obj->main->humidity;
									$loc7weatherIcon = $loc7obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP7 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingSeven">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
										<?php 
											echo '<p class="m-1">' . $ZIP7 . '<img src="p7images/animated/' . $loc7weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location7 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc7currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc7description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 8-->
						<?php
							if ($ZIP8 != NULL) {
								$locCount++;
								$loc8Query = "zip=" . $ZIP8 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc8URL = $apiURL . "?" . $loc8Query;
								$loc8response = file_get_contents($loc8URL);
								if ($loc8response === FALSE) {
									echo '<p class="errorText">' . $loc8URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc8obj = json_decode($loc8response);
									$location8 = $loc8obj->name;
									$loc8currentTemp = $loc8obj->main->temp;
									$loc8description = $loc8obj->weather[0]->description;
									$loc8humidity = $loc8obj->main->humidity;
									$loc8weatherIcon = $loc8obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP8 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingEight">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
										<?php 
											echo '<p class="m-1">' . $ZIP8 . '<img src="p7images/animated/' . $loc8weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location8 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc8currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc8description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 9-->
						<?php
							if ($ZIP9 != NULL) {
								$locCount++;
								$loc9Query = "zip=" . $ZIP9 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc9URL = $apiURL . "?" . $loc9Query;
								$loc9response = file_get_contents($loc9URL);
								if ($loc9response === FALSE) {
									echo '<p class="errorText">' . $loc9URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc9obj = json_decode($loc9response);
									$location9 = $loc9obj->name;
									$loc9currentTemp = $loc9obj->main->temp;
									$loc9description = $loc9obj->weather[0]->description;
									$loc9humidity = $loc9obj->main->humidity;
									$loc9weatherIcon = $loc9obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP9 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingNine">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
										<?php 
											echo '<p class="m-1">' . $ZIP9 . '<img src="p7images/animated/' . $loc9weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location9 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc9currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc9description . '</p>';
									?>
								</div>
							</div>
						</div>
						<!--Save Location 10-->
						<?php
							if ($ZIP10 != NULL) {
								$locCount++;
								$loc10Query = "zip=" . $ZIP10 . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
								$loc10URL = $apiURL . "?" . $loc10Query;
								$loc10response = file_get_contents($loc10URL);
								if ($loc10response === FALSE) {
									echo '<p class="errorText">' . $loc10URL . '</p>';
									die("Error contacting the web API");
								}
								else {
									$loc10obj = json_decode($loc10response);
									$location10 = $loc10obj->name;
									$loc10currentTemp = $loc10obj->main->temp;
									$loc10description = $loc10obj->weather[0]->description;
									$loc10humidity = $loc10obj->main->humidity;
									$loc10weatherIcon = $loc10obj->weather[0]->icon;
								}
							}
						?>
						<div class="card" <?php if($ZIP10 == NULL) { echo "style='display: none'"; } ?>>
							<div class="card-header m-0 p-1 b-0 bg-secondary text-white" id="headingTen">
								<h6>
									<a class="btn-block btn-link collapsed m-1 p-1 b-1" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
										<?php 
											echo '<p class="m-1">' . $ZIP10 . '<img src="p7images/animated/' . $loc10weatherIcon . '.svg" class="float-right h-25 w-25"></p>'; 
											echo '<p class="m-1">' . $location10 . '</p>';
										?>
									</a>
								</h6>
							</div>
							<div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
								<div class="card-body m-1 p-0 b-1">
									<?php
										echo '<p class="m-0">Local Temp: ' . $loc10currentTemp . '&deg;F</p>';
										echo '<p class="m-0">Description: ' . $loc10description . '</p>';
									?>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-9">
					<h1 class="cover-heading">Enter Your Zip Code</h1>
					<form method="post" action="weatherApp.php">
						<p class="lead"><input type="number" name="zipCode" id="zipCode"></p>
						<label class="checkbox-inline">
							<input type="checkbox" name="setFav" id="setFav">  Set this Zip Code as default
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" name="addLoc" id="addLoc">  Save this Zip Code
						</label>
						<p class="lead m-0">
							<input type="submit" class="btn btn-lg btn-secondary m-0" value="Submit">
						</p>
					</form>
					<div class="container">
						<?php
							if (isset($_COOKIE["favZip"]) == TRUE) {
								$queryString = "zip=" . $_COOKIE["favZip"] . "&units=imperial&appid=5943285054e07b6985c0445af1c57260";
							}
							else {
								$queryString = "zip=90210&units=imperial&appid=5943285054e07b6985c0445af1c57260";
							}
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							{	
								//create URL query
								if (empty($_POST["zipCode"]) == TRUE && isset($_COOKIE["favZip"]) == FALSE) {
									echo '<p class="text-white">Please enter a zip code</p>';
									die();
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
								echo '<p class="text-white">There was an issue contacting the API, try a different ZIP code.</p>';
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
				
								echo '<img src="p7images/animated/' . $weatherIcon . '.svg" alt="weatherIcon" width="150" height="150">';
								echo '<h1 class="text-white-0">Current Weather In ' . $location . '</h1>';
								echo '<p class="text-white-0">Current Temp: ' . $currentTemp . '&deg;F</p>';
								echo '<p class="text-white-0">Description: ' . $description . '</p>';
								echo '<p class="text-white-0">Humidity: ' . $humidity . '%</p>';

								//setting default zip code cookie
								if (isset($_POST["setFav"])) {
									setcookie("favZip", $_POST["zipCode"]);
								}

								//adding to saved locations into weather_settings DB
								if (isset($_POST["addLoc"])) {
									$locCount++;
									if ($locCount < 10) {
										$field = "ZIP" . $locCount;
										$sql = "UPDATE weather_settings SET ". $field ." = " . $mysqli->real_escape_string($_POST["zipCode"]) . " WHERE username = '$username'";
										if ($mysqli->query($sql)){
											echo "<p class='text-white'>Zip coded added to favorites</p>";
											echo "<p class='text-white'>Please run another zip code to see it appear</p>";
											echo "<p class='text-white'>on the left.</p>";
										}
										else {
											echo "<p class='text-white'>There was an issue inserting into the weather_settings DB.</p>";
											die("Error ($mysqli->errno) $mysqli->error");
										}
									}
									else {
										echo '<p class="text-white">Too many saved zip codes, try deleting some.</p>';
										$locCount--;
										die();
									}
								}
							}

						?>
					</div>
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