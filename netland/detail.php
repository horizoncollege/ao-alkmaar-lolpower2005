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

// controleren of er een id is meegegeven
if (!isset($_GET['id'])) {
    die('Geen id meegegeven');
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

// insluiten van de trailer als deze aanwezig is
$trailer = $item['youtube_trailer_id'];
$embed = '';
$embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $trailer . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title><?php echo $item['title']; ?></title>
</head>

<body>
    <a href="./">Terug</a>
    <h1 class="titel"><?php echo $item['title']; ?></h1>
    <div class="informatie">
        <table class="informatie">
            <tr class="inf">

                <th>Rating</th>
                <td><?php echo $item['rating'] ?></td>

                <th>Gewonnen awards</th>
                <td><?php echo $item['has_won_awards'] ?></td>

                <th>Seasons</th>
                <td><?php echo $item['seasons'] ?></td>

                <th>Land</th>
                <td><?php echo $item['country'] ?></td>

                <th>Taal</th>
                <td><?php echo $item['spoken_in_language'] ?></td>

                <th>Lengte</th>
                <td><?php echo $item['length_in_minutes'] ?></td>

            </tr>
        </table>
        <p><?php echo $item['summary']; ?></p>
        <?php echo $embed; ?>
    </div><br>
    <a href="edit.php?id=<?php echo $row["id"]; ?>">Bewerk deze serie</a>
</body>

</html>