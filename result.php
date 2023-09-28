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
        $choices = ["Pierre", "Feuille", "Ciseaux"];

        if (isset($_POST["choice"])) {
            $userChoice = $_POST["choice"];

            $computerChoice = $choices[rand(0, 2)];

            if ($userChoice == $computerChoice) {
                echo "<h2>Égalité</h2>";
            } else if ($userChoice == "Pierre" && $computerChoice == "Ciseaux") {
                echo "<h2>Vous avez gagné</h2>";
            } else if ($userChoice == "Feuille" && $computerChoice == "Pierre") {
                echo "<h2>Vous avez gagné</h2>";
            } else if ($userChoice == "Ciseaux" && $computerChoice == "Feuille") {
                echo "<h2>Vous avez gagné</h2>";
            } else {
                echo "<h2>Vous avez perdu</h2>";
            }

            echo "<p>Vous avez choisi <strong>$userChoice</strong></p>";
            echo "<p>L'ordinateur a choisi <strong>$computerChoice</strong></p>";
        } else {
            echo "<h2>Vous n'avez pas choisi</h2>";
        }
        ?>

        <a href="/chifoumi/index.php">Rejouer</a>
    </main>
</body>

</html>