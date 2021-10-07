<?php

class ScoreBoard
{
	private $scores;

	public function __construct() 
	{
		$this->scores = [];
		return $this;
	}

	private function calculatePlayerScore($player)
	{
		$huidig = 0;
		$stats = $player->getPinsThrown();

		foreach ($stats as $round => $pins) {
			if ($pins[0] == 10) {						// Strike
				if ($stats[$round + 1][0] == 10) {
					$huidig += (20 + array_sum($stats[$round + 2]));
				} else {
					$huidig += (10 + array_sum($stats[$round + 1]));
				}
			} elseif (($pins[0] + $pins[1]) == 10) {	// Spare
				$huidig += (10 + $stats[$round + 1][0]);
				if ($round == 9) {
					break;
				}
			} else {									// Overig
				$huidig += array_sum($stats[$round]);
			}
		}
		return $huidig;
	}

	public function calculateAllScores($players)
	{
		foreach ($players as $player) {
			$pnt = $this->calculatePlayerScore($player);
			$this->scores[$pnt] = $player->getName();
		}
	}

	public function displayScores()
	{
		$board = "";
		foreach ($this->scores as $score => $player) {
			$board .= " 	$player -> " . strval($score) . "\n";
		}
		return $board;
	}

	public function displayWinner()
	{
		return $this->scores[max(array_keys($this->scores))];
	}
}

?>