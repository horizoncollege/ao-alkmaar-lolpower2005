<?php

// Maak verbinding met de MySQL-server
$conn = mysqli_connect("localhost", "bit_academy", "bit_academy", "netland");

// Controleer of de verbinding is gelukt
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query om de titel en rating van de media op te halen
$sql_media = "SELECT * FROM media WHERE id IS NOT NULL";

// Voer de query uit
$result_media = mysqli_query($conn, $sql_media);

// Controleer of de query is gelukt
if (!$result_media) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Beheerders pagina</title>
</head>

<body>
    <h1 class="titel">Welkom op het netland beheerders paneel</h1>
    <h2>Media:</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Type</th>
            <th>Details</th>
            <th>bewerk</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_media)) : ?>
            <tr>
                <td><?php echo $row["title"]; ?></td>
                <td><?php echo $row["rating"]; ?></td>
                <td><?php echo $row["type_media"]; ?></td>
                <td><a href="detail.php?type=<?php echo $row["type_media"]; ?>&id=<?php echo $row["id"]; ?>">Bekijk details</a></td>
                <td><a href="edit.php?id=<?php echo $row["id"]; ?>">Bewerk</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="insert.php">voeg toe</a>
</body>

</html>