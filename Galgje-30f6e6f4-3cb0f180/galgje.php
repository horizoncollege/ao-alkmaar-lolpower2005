<?php
session_start();
if (!isset($_SESSION['gameActive'])) {
    $_SESSION['display'] = array();
    $_SESSION['characters'] = range('A', 'Z');
    $_SESSION['guesses'] = [];
    $_SESSION['mistakes'] = 0;
    $_SESSION['gameActive'] = true;
    foreach ($_SESSION['woorden'] as $key => $value) {
        array_push($_SESSION['display'], '*');
    }
}

if (isset($_POST['character'])) {
    foreach ($_SESSION['characters'] as $char) {
        if ($_POST['character'] == $char) {
            if (in_array(strtolower($_POST['character']), $_SESSION['woorden'])) {
                foreach ($_SESSION['woorden'] as $key => $value) {
                    if ($value == strtolower($_POST['character'])) {
                        $_SESSION['display'][$key] = $value;
                    }
                    $_SESSION['correct'] = true;
                }
            } else {
                $_SESSION['mistakes']++;
                $_SESSION['correct'] = false;
            }
            array_push($_SESSION['guesses'], strtolower($_POST['character']));
            unset($_SESSION['characters'][array_search($_POST['character'], $_SESSION['characters'])]);
        }
    }
}

if (isset($_POST['random'])) {
    header('Location:PHP/willekeurig.php');
} elseif (isset($_POST['gekozen'])) {
    header('Location:HTML/gekozen.php');
} elseif (isset($_POST['start'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/galgje.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galgje</title>
</head>

<body style="background-color: grey;">
    <div style="display: flex;
    justify-content: center;">
        <?php
        switch ($_SESSION['mistakes']) {
            case 0:
                echo '<img src="img/hangman1.png">';
                break;
            case 1:
                echo '<img src="img/hangman2.png">';
                break;
            case 2:
                echo '<img src="img/hangman3.png">';
                break;
            case 3:
                echo '<img src="img/hangman4.png">';
                break;
            case 4:
                echo '<img src="img/hangman5.png">';
                break;
            case 5:
                echo '<img src="img/hangman6.png">';
                break;
            case 6:
                echo '<img src="img/hangman7.png">';
                $_SESSION['verloren'] = true;
                break;
        } ?>
    </div>
    <form method="post">
        <?php
        echo "<h2>" . implode($_SESSION['display']) . "</h2><br>";

        if (isset($_SESSION['correct'])) {
            if ($_SESSION['correct']) {
                echo "<h3>Goed! Deze letter zit in het woord</h3>";
            } else {
                echo "<h3>Fout! Deze letter zit niet in het woord</h3>";
            }
        }

        if ($_SESSION['woorden'] === $_SESSION['display']) {
            echo '<h1>GEWONNEN!</h1>';
        } elseif (isset($_SESSION['verloren'])) {
            echo '<h1>VERLOREN!</h1>';
        } else {
            foreach ($_SESSION['characters'] as $char) {
                echo '<input type="submit" name="character" value="' . $char . '"></input>';
            }
        } ?>
        <input type="submit" name="random" value="restart met random">
        <input type="submit" name="gekozen" value="restart met gekozen">
        <input type="submit" name="start" value="terug naar start">
    </form>
</body>

</html>