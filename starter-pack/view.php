<?php $disabled = !empty($_SESSION['nickname']) ? "disabled='disabled'" : ""; ?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Language Game</title>
</head>

<body>
	<!-- add a form for the user to play the game -->
	<h1>Language game! Translate correctly to earn points</h1>

	<?php if (isset($_SESSION['nickname'])) { ?>
		<h2>Score right answers: <?php echo $game->rightScorePlayer ?></h2>
		<h2>Score wrong answers: <?php echo $game->wrongScorePlayer ?></h2>

		<h2>Your word to translate is: <i><?php echo $game->randomWord ?></i></h2>
	<?php } ?>

	<form action="index.php" method="post">
		What is your nickname?
		<input type="text" name="nickname" <?php echo $disabled; ?> placeholder="<?php echo $_SESSION['nickname'] ?? '' ?>">
		<input type="submit" value="register" <?php if (isset($_SESSION['nickname'])) { ?> disabled <?php   } ?>>
	</form>

    <br>

	<?php if (isset($_SESSION['nickname'])) { ?>
		<form action=" index.php" method="post">
			Translation: <input type="text" name="answer">
			<input type="submit" value="submit">
			<input type="submit" value="reset" name="reset">
		</form>


		<p><?php echo $game->resultMessage ?></p>
	<?php } ?>
</body>

</html>