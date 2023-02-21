<?php

session_start();
$_SESSION['move2'] = $_GET['move2'];

if ($_SESSION['move1'] == $_SESSION['move2']) {
    echo "<h1>It's a tie!</h1>";
} elseif ($_SESSION['move1'] == "rock" && $_SESSION['move2'] == "scissors") {
    echo "<h1>Player 1 wins!</h1>";
} elseif ($_SESSION['move1'] == "paper" && $_SESSION['move2'] == "rock") {
    echo "<h1>Player 1 wins!</h1>";
} elseif ($_SESSION['move1'] == "scissors" && $_SESSION['move2'] == "paper") {
    echo "<h1>Player 1 wins!</h1>";
} else {
    echo "<h1>Player 2 wins!</h1>";
}

echo "<h4>Player 1 had: </h4>" . $_SESSION['move1'] . "<h4>Player 2 had: </h4>" . $_SESSION['move2'];

echo '<br><br><button type="button"><a href="index.php">SEND ME HOME!</a></button>';
?>
