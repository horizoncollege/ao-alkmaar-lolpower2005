<?php

$move1 = $_GET['move1'];


$RPS = array(
    "rock",
    "paper",
    "scissors"
);

$PC = array_rand($RPS, 1);

if ($PC >= 4 or $PC <= 0) {
    while ($PC <= 0 or $PC >= 4) {
        $PC = array_rand($RPS, 1);
    }
    header('Refresh:0');
} else {
    if ($PC == 1) {
        $PC = "rock";
    } elseif ($PC == 2) {
        $PC = "paper";
    } elseif ($PC == 3) {
        $PC = "scissors";
    }
}

if ($move1 == $PC) {
    echo "<h1>It's a tie!</h1>";
} elseif ($move1 == "rock" && $PC == "scissors") {
    echo "<h1>Player wins!</h1>";
} elseif ($move1 == "paper" && $PC == "rock") {
    echo "<h1>Player wins!</h1>";
} elseif ($move1 == "scissors" && $PC == "paper") {
    echo "<h1>Player wins!</h1>";
} else {
    echo "<h1>Computer wins!</h1>";
}

echo "<h4>Player had: </h4>" . $move1 . "<h4>Computer had: </h4>" . $PC;

echo '<br><br><button type="button"><a href="index.php">SEND ME HOME!</a></button>';
