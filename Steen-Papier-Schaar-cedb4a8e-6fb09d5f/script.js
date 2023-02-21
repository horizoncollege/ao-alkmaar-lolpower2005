function playGame(player1, player2) {
    if (player1 === player2) {
        return "It's a tie!";
    } else if (player1 === "rock") {
        if (player2 === "scissors") {
            return "Player 1 wins!";
        } else {
            return "Player 2 wins!";
        }
    } else if (player1 === "paper") {
        if (player2 === "rock") {
            return "Player 1 wins!";
        } else {
            return "Player 2 wins!";
        }
    } else if (player1 === "scissors") {
        if (player2 === "paper") {
            return "Player 1 wins!";
        } else {
            return "Player 2 wins!";
        }
    }
    return playGame();
}

function displayResult(result) {
    document.getElementById("result").innerHTML = result;
}

function playRound() {
    var player1 = document.getElementById("player1").value;
    var player2 = document.getElementById("player2").value;
    var result = playGame(player1, player2);
    displayResult(result);
}
