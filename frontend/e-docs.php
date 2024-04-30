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
    <?php
session_start();

// Controleer of de gebruiker is ingelogd, anders doorsturen naar het inlogscherm
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'sidebar.php';
require_once('config.php'); // Include your database configuration file

// Fetch e-docs data from the database
$sql = "SELECT * FROM edocs";
$result = $conn->query($sql);

// Check if there are any e-docs available
if ($result->num_rows > 0) {
    // Output e-docs list
    echo "<div class='main'>";
    echo "<div class='payment-content'>";
    echo "<h2>E-docs</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        // Check if the document belongs to the logged-in user
        if ($row["user_id"] == $_SESSION['user_id']) {
            echo "<li><a href='" . $row["doc_path"] . "' target='_blank'>" . $row["doc_name"] . "</a></li>";
        }
    }
    echo "</ul>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Geen e-docs gevonden.";
}

// Close database connection
$conn->close();
?>

    </div>
</div>