<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Guess a Number</title>
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="text-center">
	<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
		<header class="masthead mb-auto">
			<div class="inner">
				<h3 class="masthead-brand">Project 5</h3>
				<nav class="nav nav-masthead justify-content-center">
					<a class="nav-link active" href="https://lamp.cse.fau.edu/~arobustelli2018/">Home</a>
				</nav>
			</div>
		</header>
	</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $randNum = rand(1, 10);

    if ($randNum == $_POST["num"]) {
        echo "<h1>Correct!</h1>";
    }
    else {
        echo "<p>No, I was thinking of $randNum.</p>";
    }
}
?>

    <form method="post" action="index.php">
        <p>I'm thinking of a number between 1 and 10.</p>
        <p>Your guess: <input type="number" name="num" min="1" max="10" autofocus></p>
        <input type="submit" value="Guess">
    </form>
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>