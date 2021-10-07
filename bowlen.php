<?php

require 'BowlingGame.php';

// Het spel speelt zichzelf.
$result = (new BowlingGame())->play();

echo "De winnaar is: " . $result->displayWinner();
echo "\nScoreboard -> \n" . $result->displayScores();

?>