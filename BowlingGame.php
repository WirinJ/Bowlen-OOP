<?php

require 'Player.php';
require 'ScoreBoard.php';

class BowlingGame
{
    private $scoreBoard;
    private $players;
    private $round;

    public function __construct()
    {
        $this->round = 1;
        $this->players = [];
        $this->scoreBoard = new ScoreBoard();
        return $this;
    }

    private function addPlayer($name)
    {
        array_push($this->players, new Player($name));
    }

    public function askPlayerNames()
    {
        $hvl = readline("Hoeveel mensen spelen mee? ");
        for ($i = 0; $i < $hvl; $i++) { 
            $name = readline("  Wat is jou naam? ");
            $this->addPlayer($name);
        }
    }

    private function playRound()
    {
        foreach ($this->players as $player) {
            $rnd = rand(1, 6);
            if ($rnd == 6) {
                $player->throwPins(10, 0);
            } elseif ($rnd == 5) {
                $player->throwPins(1, 9);
            } else {
                $player->throwPins(rand(1, 5), rand(1, 5));
            }
        }
    }

    private function playLastRound()
    {
        foreach ($this->players as $player) {
            $rnd = rand(1, 6);
            if ($rnd == 6) {
                $player->throwPins(10, 0);
                $player->throwPins(rand(1, 5), rand(1, 5));
            } elseif ($rnd == 5) {
                $player->throwPins(1, 9);
                $player->throwPins(rand(1, 5), rand(1, 5));
            } else {
                $player->throwPins(rand(1, 5), rand(1, 5));
            }
        }
    }

    public function play()
    {
        $this->askPlayerNames();
        for ($i = 0; $i < 10; $i++) { 
            if ($i == 9) {
                $this->playLastRound(); 
            } else {
                $this->playRound();
            }
        }
        $this->scoreBoard->calculateAllScores($this->players);
        return $this->scoreBoard;
    }
}
