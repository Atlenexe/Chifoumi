<?php

require_once("assets/classes/GameInstance.php");

session_start();

if (!isset($_SESSION['gameInstance'])) {
    $gameInstance = new GameInstance();
    $_SESSION['gameInstance'] = $gameInstance;
} else {
    $gameInstance = $_SESSION['gameInstance'];
}

if (isset($_POST["gamemod"])) {
    $gameInstance->gameType = $_POST["gamemod"];
}

if (isset($_POST["playerName"])) {
    $gameInstance->selectPlayer($_POST["playerName"]);
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

        <div class="main-view">
            <div class="settings">
                <h2>Mode de jeu :</h2>
                <form action="" method="post">
                    <select name="gamemod">
                        <option value="0">Classique</option>
                        <option value="1">Lezard Spock</option>
                    </select>
                    <input type="submit">
                </form>

                <h2>Votre nom :</h2>
                <form action="" method="post">
                    <input type="text" name="playerName">
                    <input type="submit">
                </form>
            </div>

            <div class="game">
                <div class="player-infos">
                    <?php echo '<span><strong>Player :</strong> ' . $gameInstance->player->name . '</span>'; ?>
                    <?php echo '<span><strong>Score :</strong> ' . $gameInstance->player->score . '</span>'; ?>
                </div>

                <h2>Choisissez un des éléments pour jouer.</h2>

                <form action="result.php" method="post">
                    <?php
                    foreach ($gameInstance->choices as $choice) {
                        echo '<input type="submit" name="choice" value="' . $choice->value . '" class="' . $choice->value . '">';
                    }
                    ?>
                </form>
            </div>
        </div>
    </main>
</body>

</html>