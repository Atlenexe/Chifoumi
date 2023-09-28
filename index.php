<?php

require_once("assets/classes/GameInstance.php");

session_start();

if (!isset($_SESSION['gameInstance'])) {
    $gameInstance = new GameInstance();
    $_SESSION['gameInstance'] = $gameInstance;
} else {
    $gameInstance = $_SESSION['gameInstance'];
}

$gameInstance->start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Chifoumi</title>
</head>

<body>
    <main>
        <h1>Chifoumi</h1>

        <h2>Choisissez un des trois éléments.</h2>

        <form action="result.php" method="post">
            <?php
            foreach ($gameInstance->choices as $choice) {
                echo '<input type="submit" name="choice" value="' . $choice->value . '" class="' . $choice->value . '">';
            }
            ?>
        </form>
    </main>
</body>

</html>