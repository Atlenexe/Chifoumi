<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("Choice.php");
require_once("Computer.php");
require_once("Player.php");
require_once("DataBase.php");

class GameInstance
{
    public string $title = "Chifoumi";
    public int $stateCode = -1;

    /**
     * @var Player[] $players
     */
    public array $players;
    public Player $player;
    public Computer $computer;
    public int $gameType = 0;
    public DataBase $dataBase;

    private string $databaseType = "mysql";
    private string $tableName = "score";

    /**
     * @var Choice[] $choices
     */
    public array $choices = [];

    public function __construct()
    {
        $this->dataBase = new DataBase($this->tableName, $this->databaseType);

        $playersDB = $this->dataBase->selectAll();

        $defaultPlayer = false;

        foreach ($playersDB as $playerDB) {
            $player = new Player;
            $player->name = $playerDB["name"];
            $player->score = $playerDB["score"];

            if ($player->name == "Player") {
                $defaultPlayer = true;
            }

            $this->players[] = $player;
        }

        if (!$defaultPlayer) {
            $this->initPlayer();
        }

        $this->computer = new Computer();
        $this->selectPlayer("Player");
    }

    public function start(): void
    {
        $this->choices = [];

        if ($this->gameType == 0) {
            $this->choices[] = new Choice("rock", "Pierre", ["paper"]);
            $this->choices[] = new Choice("paper", "Papier", ["scissors"]);
            $this->choices[] = new Choice("scissors", "Ciseaux", ["rock"]);
        } else if ($this->gameType == 1) {
            $this->choices[] = new Choice("rock", "Pierre", ["paper", "spock"]);
            $this->choices[] = new Choice("paper", "Papier", ["scissors", "lezard"]);
            $this->choices[] = new Choice("scissors", "Ciseaux", ["rock", "spock"]);
            $this->choices[] = new Choice("lezard", "Lezard", ["scissors", "rock"]);
            $this->choices[] = new Choice("spock", "Spock", ["lezard", "paper"]);
        }

        $this->computer->pickRandom($this->choices);
    }

    private function initPlayer(): void
    {
        $this->player = new Player();
        $players[] = $this->player;
    }

    public function selectPlayer(string $name): void
    {
        if (!$this->checkPlayerExists($name)) {
            //Créer un nouvel utilisateur
            $newPlayer = new Player;
            $newPlayer->name = $name;

            $this->players[] = $newPlayer;
            $this->player = $newPlayer;
        } else {
            //Choisir l'utilisateur existant
            foreach ($this->players as $player) {
                if ($player->name == $name) {
                    $this->player = $player;
                }
            }
        }
    }

    private function checkPlayerExists(string $name): bool
    {
        if (isset($this->players)) {
            foreach ($this->players as $player) {
                if ($player->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function startResult($userChoice): void
    {
        if (isset($userChoice)) {
            $userChoice = $userChoice;

            $this->findChoice($userChoice);
            $this->displayResult();
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

        echo "<p>Score de <strong>" . $this->player->name . "</strong> : <strong>" . $this->player->score . "</strong></p>";
        echo "<p>Score de l'ordinateur : <strong>" . $this->computer->score . "</strong></p>";
    }

    private function checkWin(): int
    {
        if ($this->player->choice->value == $this->computer->choice->value) {
            //Égalité (2)
            return 2;
        } else if (in_array($this->player->choice->value, $this->computer->choice->nemesisValue)) {
            //Win (1)
            $this->player->score++;
            $this->registerScoreDB();
            return 1;
        } else {
            //Loose (0)
            $this->computer->score++;
            return 0;
        }
    }

    private function registerScoreDB(): void
    {
        $score = [
            "name" => $this->player->name,
            "score" => $this->player->score
        ];

        $scoreExisting = false;

        if (sizeof($this->dataBase->selectFrom("name", $this->player->name)) > 0) {
            $scoreExisting = true;
            $this->dataBase->putValue("name", $score);
        }

        if (!$scoreExisting) {
            $this->dataBase->createValue($score);
        }
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
