<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Chifoumi: Résultat</title>
</head>

<body>
    <main>
        <h1>Chifoumi</h1>

        <?php

        require_once("assets/classes/GameInstance.php");

        session_start();

        $_SESSION['gameInstance']->startResult();
        ?>

        <a href="/chifoumi/index.php">Rejouer</a>
    </main>
</body>

</html>