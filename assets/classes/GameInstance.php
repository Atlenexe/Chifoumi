<?php

require_once("Choice.php");
require_once("Computer.php");
require_once("Player.php");

class GameInstance
{
    public string $title = "Chifoumi";
    public int $stateCode = -1;
    public Player $player;
    public Computer $computer;

    /**
     * @var Choice[] $choices
     */
    public array $choices = [];

    public function start(): void
    {
        $this->choices = [];
        $this->choices[] = new Choice("rock", "Pierre", "paper");
        $this->choices[] = new Choice("paper", "Papier", "scissors");
        $this->choices[] = new Choice("scissors", "Ciseaux", "rock");

        if (!isset($this->computer) || !isset($this->player)) {
            $this->initPlayer();
        }

        $this->computer->pickRandom($this->choices);
    }

    private function initPlayer(): void
    {
        $this->computer = new Computer();
        $this->player = new Player();
    }

    public function startResult(): void
    {
        if (isset($_POST["choice"])) {
            $userChoice = $_POST["choice"];

            $this->findChoice($userChoice);
            $this->displayResult();
        }
    }

    private function checkWin(): int
    {
        if ($this->player->choice->value == $this->computer->choice->value) {
            //Égalité (2)
            return 2;
        } else if ($this->player->choice->value == $this->computer->choice->nemesisValue) {
            //Win (1)
            $this->player->score++;
            return 1;
        } else {
            //Loose (0)
            $this->computer->score++;
            return 0;
        }
    }

    private function displayResult(): void
    {
        $code = $this->checkWin();

        //Gestion de l'affichage des résultats
        switch ($code) {
            case 0:
                echo "<h2>Vous avez perdu</h2>";
                break;

            case 1:
                echo "<h2>Vous avez gagné</h2>";
                break;

            case 2:
                echo "<h2>Égalité</h2>";
                break;

            default:
                echo "<h2>Vous n'avez pas choisi</h2>";
                break;
        }

        echo "<p>Vous avez choisi <strong>" . $this->player->choice->label . "</strong></p>";
        echo "<p>L'ordinateur a choici <strong>" . $this->computer->choice->label . "</strong></p>";

        echo "<p>Votre score : <strong>" . $this->player->score . "</strong></p>";
        echo "<p>Score de l'ordinateur : <strong>" . $this->computer->score . "</strong></p>";
    }

    private function findChoice(string $userChoice): void
    {
        //Trouver et assigner à player l'objet choice qu'il a selectionné
        foreach ($this->choices as $choice) {
            if ($choice->value == $userChoice) {
                $this->player->choice = $choice;
            }
        }
    }
}
