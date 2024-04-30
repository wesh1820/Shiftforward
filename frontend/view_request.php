<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bekijk Aanvraag</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Zorg ervoor dat je de juiste link naar je CSS-bestand plaatst -->
</head>
<body>
    <div class="main">
        <div class="payment-content">
            <?php
            include 'sidebar.php';
            // Controleer of er een ID is meegegeven in de URL
            if(isset($_GET['id'])) {
                // Ontvang het ID van de URL
                $request_id = $_GET['id'];

                // Voer hier de code uit om de specifieke aanvraag op te halen uit de database
                // Dit hangt af van hoe je database is opgezet en welke databaseverbinding je gebruikt

                // Voorbeeld: verbind met de database
                require_once('config.php'); // Include je database configuratiebestand

                // Voorbeeld: haal de aanvraag op uit de database
                $sql = "SELECT * FROM aanvragen WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $request_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Controleer of de aanvraag is gevonden
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    echo "<h2><strong>Aanvraag ID:</strong> " . $row["id"] . "</h2>";
                    echo "<p><strong>Reden van Werkloosheid:</strong> " . $row["unemployment_reason"] . "</p>";
                    echo "<p><strong>Laatste Werkgever:</strong> " . $row["last_employer"] . "</p>";
                    echo "<p><strong>Laatst Verdiende Salaris:</strong> " . $row["last_salary"] . "</p>";
                    echo "<p><strong>Bankrekeningnummer:</strong> " . $row["bank_account"] . "</p>";
                    echo "<p><strong>Duur van Vorige Werkgelegenheid (in maanden):</strong> " . $row["previous_employment_duration"] . "</p>";
                    echo "<p><strong>Reden voor Eventuele Aanvullende Inkomsten:</strong> " . $row["reason_additional_income"] . "</p>";
                    echo "<p><strong>Bedrag van Eventuele Aanvullende Inkomsten:</strong> " . $row["additional_income_amount"] . "</p>";
                    echo "<p><strong>Aanvullende Opmerkingen:</strong> " . $row["additional_notes"] . "</p>";
                    echo "<p><strong>Bijlage:</strong> " . $row["attachment"] . "</p>";
                    echo "<p><strong>Contactvoorkeur:</strong> " . $row["contact_preference"] . "</p>";
                    echo "<p><strong>Voorkeurstijd voor contact:</strong> " . $row["preferred_contact_time"] . "</p>";
                    echo "<p><strong>Startdatum Werkloosheid:</strong> " . $row["unemployment_start_date"] . "</p>";
                    echo "<p><strong>Verwachte Einddatum Werkloosheid:</strong> " . $row["unemployment_end_date"] . "</p>";
                    echo "<p><strong>Gewenste Ondersteuning:</strong> " . $row["support_requested"] . "</p>";
                    echo "<p><strong>CV:</strong> " . $row["resume"] . "</p>";
                    echo "<p><strong>Andere Documenten:</strong> " . $row["other_documents"] . "</p>";
                    echo "<p><strong>Privacy Akkoord:</strong> " . $row["privacy_agreement"] . "</p>";
                } else {
                    echo "<p>Aanvraag niet gevonden.</p>";
                }

                // Sluit de databaseverbinding
                $stmt->close();
                $conn->close();
            } else {
                echo "<p>Geen ID gevonden om te bekijken.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
