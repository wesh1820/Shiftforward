<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betalingsgegevens</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="main">
    <div class="payment-content">
        <h1>Betalingsgegevens</h1>
        <div class="payment-info">
            <!-- Je PHP-code voor betalingsinformatie -->
            <?php
session_start();

// Controleer of de gebruiker is ingelogd, anders doorsturen naar het inlogscherm
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'sidebar.php';
include 'config.php';

// Databaseverbinding controleren
if ($conn->connect_error) {
    die("Kan geen verbinding maken met de database: " . $conn->connect_error);
}

// Gebruikers-ID van de ingelogde gebruiker ophalen
$user_id = $_SESSION['user_id'];

// Query om betalingsgegevens op te halen voor de ingelogde gebruiker
$sql = "SELECT users.firstname, users.lastname, betalingen.id, betalingen.amount, betalingen.status, betalingen.datum
        FROM betalingen
        INNER JOIN users ON betalingen.user_id = users.id
        WHERE betalingen.user_id = $user_id";
$result = $conn->query($sql);

// Betalingsgegevens weergeven
if ($result->num_rows > 0) {
    echo "<table class='payment-info-table'>";
    echo "<tr><th>Bedrag</th><th>Status</th><th>Datum</th><th>Meer</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>€" . $row["amount"] . "</td>";

        // Bepalen van de statuskleur op basis van de statuswaarde
        $status_color = '';
        switch ($row["status"]) {
            case 'geslaagd':
                $status_color = 'green';
                break;
            case 'in behandeling':
                $status_color = 'orange';
                break;
            case 'afgewezen':
                $status_color = 'red';
                break;
            default:
                $status_color = 'black';
                break;
        }

        // Weergeven van de status met de juiste kleur
        echo "<td style='color: $status_color;'>" . $row["status"] . "</td>";
        echo "<td>" . $row["datum"] . "</td>";
        // JavaScript toevoegen om naar de BetalingsDetails.php te navigeren
        echo "<td><button class='view-button' onclick='navigateToDetails(" . $row["id"] . ")'>Track & Trace</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Geen betalingsgegevens gevonden.";
}

// Databaseverbinding sluiten
$conn->close();


            ?>
        </div>
    </div>
</div>

<script>
    function navigateToDetails(paymentId) {
        // Navigeer naar BetalingsDetails.php met behulp van JavaScript
        window.location.href = "BetalingDetails.php?id=" + paymentId;
    }
</script>

</body>
</html>
