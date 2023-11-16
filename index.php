<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
                <form action="" method="post">
                    <h2>Mode de jeu :</h2>
                    <select name="gamemod">
                        <option value="0" <?php if ($gameInstance->gameType == 0) echo 'selected="selected"'; ?>>Classique</option>
                        <option value="1" <?php if ($gameInstance->gameType == 1) echo 'selected="selected"'; ?>>Lezard Spock</option>
                    </select>
                    <input type="submit">
                </form>

                <form action="" method="post">
                    <h2>Votre nom :</h2>
                    <input type="text" name="playerName" value="<?php echo $gameInstance->player->name ?>">
                    <input type="submit">
                </form>
            </div>

            <div class="game">
                <div class="player-infos">
                    <?php echo '<span><strong>Player :</strong> ' . $gameInstance->player->name . '</span>'; ?>
                    <?php
                    echo '<span><strong>Score :</strong> ' . $gameInstance->player->score . '</span>';
                    ?>
                </div>

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