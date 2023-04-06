<?php

// Maak een PDO-verbinding met de database
$servername = "localhost";
$username = "bit_academy";
$password = "bit_academy";
$dbname = "netland";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Controleer of het formulier is ingediend
if (isset($_POST['submit'])) {
    // Verzamel de formuliergegevens
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $length_in_minutes = $_POST['length_in_minutes'];
    $has_won_awards = $_POST['has_won_awards'];
    $seasons = $_POST['seasons'];
    $released_at = $_POST['released_at'];
    $country = $_POST['country'];
    $spoken_in_language = $_POST['spoken_in_language'];
    $youtube_trailer_id = $_POST['youtube_trailer_id'];
    $summary = $_POST['summary'];
    $type_media = $_POST['type_media'];

    // Voeg de gegevens toe aan de database
    $stmt = $conn->prepare("INSERT INTO media (title, rating, length_in_minutes, has_won_awards, seasons, released_at, country, spoken_in_language, youtube_trailer_id, summary, type_media)
            VALUES (:title, :rating, :length_in_minutes, :has_won_awards, :seasons, :released_at, :country, :spoken_in_language, :youtube_trailer_id, :summary, :type_media)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':length_in_minutes', $length_in_minutes);
    $stmt->bindParam(':has_won_awards', $has_won_awards);
    $stmt->bindParam(':seasons', $seasons);
    $stmt->bindParam(':released_at', $released_at);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':spoken_in_language', $spoken_in_language);
    $stmt->bindParam(':youtube_trailer_id', $youtube_trailer_id);
    $stmt->bindParam(':summary', $summary);
    $stmt->bindParam(':type_media', $type_media);

    $stmt->execute();

    // Bevestig dat de gegevens zijn toegevoegd
    echo "Gegevens succesvol toegevoegd aan de database.";
}

$conn = null; // Sluit de databaseverbinding

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Voeg Film Toe</title>
</head>

<body>
    <a href="./">Terug</a>
    <h1 class="titel">Voeg Toe</h1>
    <div class="invoer">
        <form method="post">

            <label for="title">Titel:</label><br>
            <input type="text" id="title" name="title"><br>

            <label for="rating">Rating:</label><br>
            <input type="number" id="rating" name="rating"><br>

            <label for="length_in_minutes">Duur:</label><br>
            <input type="number" id="length_in_minutes" name="length_in_minutes"><br>

            <label for="has_won_awards">Aantal awards:</label><br>
            <input type="number" id="has_won_awards" name="has_won_awards"><br>

            <label for="seasons">Seasons</label><br>
            <input type="number" id="seasons" name="seasons"><br>

            <label for="released_at">released op:</label><br>
            <input type="date" id="released_at" name="released_at"><br>

            <label for="country">Land van uitkomst:</label><br>
            <input type="text" id="country" name="country"><br>

            <label for="spoken_in_language">Taal</label><br>
            <input type="text" id="spoken_in_language" name="spoken_in_language"><br>

            <label for="youtube_trailer_id">Trailer id:</label><br>
            <input type="text" id="youtube_trailer_id" name="youtube_trailer_id"><br>

            <label for="summary">Samenvatting:</label><br>
            <textarea id="summary" name="summary"></textarea><br><br>

            <label for="type_media">Type:</label>
            <select name="type_media" id="type_media">
                <option value="serie">Serie</option>
                <option value="film">Film</option>
            </select><br><br>

            <button name="submit" type="submit">Voeg Film Toe</button>

        </form>
    </div>
</body>

</html>