<?php

session_start();
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/gekozen">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voer een woord in</title>
</head>

<body>
    <h1>Galgje</h1>
    <h3>Kies een woord</h3>
    <form method="POST">
        <input type="text" name="woord" required>
        <input type="submit" id="button" value="speel met dit woord">
        <div class="button"><button><a href="../index.php">TAKE ME HOME</a></button></div>
    </form>
    <?php

    if (isset($_POST["woord"])) {
        $_SESSION["woorden"] = str_split($_POST["woord"]);
        header('Location: ../galgje.php');
    }
    ?>
</body>

</html>