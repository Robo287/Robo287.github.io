<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dice Game</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Other CSS-->
    <link rel="stylesheet" href="p5files/p5css.css">
</head>
<body class="text-center">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
	<header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Project 5 - Dice Game</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="https://lamp.cse.fau.edu/~arobustelli2018/">Home</a>
                <a class="nav-link" href="#Sources">Sources</a>
            </nav>
        </div>
    </header>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$DMroll = rand(1, 20); //initialize the dungeon master roll

				echo '<h1>You have rolled: ' . $_POST["roll"] . '</h1>'; //display your roll
				echo '<h1>The Dungeon Master has Rolled: ' . $DMroll . '</h1>'; //display DM roll
				if ($DMroll < $_POST["roll"]) {
					echo '<h1 class="victory">They fall to your might!</h1>'; //If you roll higher, you win
				}
				else if ($DMroll > $_POST["roll"]) {
					echo '<h1 class="defeat">You have been culled, mortal!</h1>'; //If you roll lower, you lose
				}
				else if ($DMroll == $_POST["roll"]) {
					echo '<h1>Blades clash, but there is no victor!</h1>'; //If you and the DM roll the same, it's a draw
				}
			}
		?>
    <main role="main" class="inner cover">
        <h1 class="cover-heading">First Roll Your Dice</h1>
        <h1 class="cover-heading">Then See If You Beat</h1>
        <h1 class="cover-heading">The Dungeon Master!</h1>
        <form method="post" action="index.php">
            <p class="lead">Your D20 Roll: <input type="number" name="roll" id="roll"></p>
            <p class="lead">
                <input type="button" class="btn btn-lg btn-secondary" onclick="diceRoll();" value="ROLL YOUR DICE">
            </p>
            <p class="lead">
                <input type="submit" class="btn btn-lg btn-secondary" value="FIGHT!">
            </p>
        </form>
    </main>
	<footer class="mastfoot mt-auto">
		<div class="inner">
			<p>Project 5 - Guess The Number by Anthony Robustelli</p>
		</div>
        <div id="Source">
            <h5>Sources</h5>
            <p>Number Game - <a href="https://learn.zybooks.com/zybook/FAUCOP3813MarquesFall2019/chapter/11/section/10">ZyBooks</a></p>
            <p>Bootstrap Template - <a href="https://getbootstrap.com/docs/4.0/examples/cover/">Cover</a></p>
        </div>
	</footer>
    </div>

	<!-- Optional JavaScript -->
    <script src="p5files/diceGame.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>