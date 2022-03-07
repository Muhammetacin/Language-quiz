<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Language Game</title>
</head>

<body>
	<!-- TODO: add a form for the user to play the game -->
	<h1>Language game! Translate correctly to earn points</h1>
	<h2>Score: <?php echo $game->player->getScore() ?></h2>

	<h2>Your word to translate is: <i><?php echo $_SESSION['word'] ?? $game->randomWord ?></i></h2>

	<form action="index.php" method="post">
		Translation: <input type="text" name="answer">
		<input type="submit" value="submit">
		<input type="submit" value="reset" name="reset">
	</form>

	<p><?php echo $game->resultMessage ?></p>

</body>

</html>