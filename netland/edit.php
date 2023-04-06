<?php
// instellingen voor de databaseverbinding
$host = 'localhost';
$db   = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

// database-DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// opties voor de databaseverbinding
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// probeer verbinding te maken met de database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



// ophalen van de film of serie met de opgegeven id
$id = $_GET['id'];


$query = "SELECT * FROM media WHERE id = :id";

$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$item = $stmt->fetch();

// controleren of het item is gevonden
if (!$item) {
    die('Item niet gevonden');
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Bewerk <?php echo $item['title']; ?></title>
</head>

<body>
    <a href="./">Terug</a>
    <h1 class="titel">bewerk <?php echo $item['title']; ?></h1>
    <form method="post">

        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $item['title']; ?>"><br>

        <label for="rating">Rating:</label><br>
        <input type="number" id="rating" name="rating" value="<?php echo $item['rating']; ?>"><br>

        <label for="has_won_awards">Awards:</label><br>
        <input type="number" id="has_won_awards" name="has_won_awards" value="<?php echo $item['has_won_awards']; ?>"><br>

        <label for="country">Land van uitkomst:</label><br>
        <input type="text" id="country" name="country" value="<?php echo $item['country']; ?>"><br>

        <label for="length_in_minutes">Duur:</label><br>
        <input type="text" id="length_in_minutes" name="length_in_minutes" value="<?php echo $item['length_in_minutes']; ?>"><br>

        <label for="released_at">datum van uitkomst:</label><br>
        <input type="date" id="released_at" name="released_at" value="<?php echo $item['released_at']; ?>"><br>

        <label for="spoken_in_language">Taal:</label><br>
        <input type="text" id="spoken_in_language" name="spoken_in_language" value="<?php echo $item['spoken_in_language']; ?>"><br>

        <label for="seasons">seasons:</label><br>
        <input type="number" id="seasons" name="seasons" value="<?php echo $item['seasons']; ?>"><br>

        <label for="youtube_trailer_id">youtube trailer id:</label><br>
        <input type="text" id="youtube_trailer_id" name="youtube_trailer_id" value="<?php echo $item['youtube_trailer_id']; ?>"><br>

        <label for="summary">Samenvatting:</label><br>
        <textarea id="summary" name="summary"><?php echo $item['summary']; ?></textarea><br>

        <button value="1" name="markiplier" type="submit">Bewerk film</button>
    </form>
    <?php
    if (isset($_POST['markiplier'])) {
        $queryupdate = "UPDATE media SET title = :title, rating = :rating, has_won_awards = :awards, length_in_minutes = :minutes, 
        seasons = :seasons, released_at = :release, summary = :summary, country = :country, spoken_in_language = 
        :taal, youtube_trailer_id = :yt WHERE id = :id";
        $stmt2 = $pdo->prepare($queryupdate);
        $stmt2->execute([
            'title' => $_POST['title'],
            'rating' => $_POST['rating'],
            'awards' => $_POST['has_won_awards'],
            'minutes' => $_POST['length_in_minutes'],
            'seasons' => $_POST['seasons'],
            'release' => $_POST['released_at'],
            'summary' => $_POST['summary'],
            'country' => $_POST['country'],
            'taal' => $_POST['spoken_in_language'],
            'yt' => $_POST['youtube_trailer_id'],
            'id' => $_GET['id']
        ]);
        header('Location: ./');
        exit();
    }

    ?>
</body>

</html>