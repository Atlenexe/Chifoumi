<?php

require_once("Choice.php");

class Computer
{
    public Choice $choice;
    public int $score = 0;

    /**
     * @param Choice[] $choices
     */
    public function pickRandom(array $choices): void
    {
        $randomChoice = $choices[rand(0, count($choices) - 1)];
        $this->choice = $randomChoice;
    }
}
