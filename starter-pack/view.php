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
	<h2>Score right answers: <?php echo $_SESSION['rightAnswer'] ?></h2>
	<h2>Score wrong answers: <?php echo $_SESSION['wrongAnswer'] ?></h2>

	<h2>Your word to translate is: <i><?php echo $_SESSION['word'] ?? $game->randomWord ?></i></h2>

	<form action="index.php" method="post">
		Translation: <input type="text" name="answer">
		<input type="submit" value="submit">
		<input type="submit" value="reset" name="reset">
		<!-- <input type="hidden" name="nickname"> -->
	</form>

	<p><?php echo $game->resultMessage ?></p>

</body>

<!-- <script type="text/javascript">
	const results = prompt('namae wa?');
	<?php $results = "<script>document.write(results)</script>" ?>
</script>
<?php echo $results; ?> -->

</html>