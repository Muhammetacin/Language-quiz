<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game over</title>
</head>

<body>
    <h1>Game over</h1>
    <h2>Right answers: <?php echo $_SESSION['endGameRightScore'] ?></h2>
    <h2>Wrong answers: <?php echo $_SESSION['endGameWrongScore'] ?></h2>

    <form action="index.php" method="post">
        <input type="submit" value="reset" name="resetGame">
    </form>
</body>

</html>