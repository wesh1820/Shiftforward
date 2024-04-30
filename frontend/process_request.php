<?php
// Controleer of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de ingediende gegevens van het formulier
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $request_text = $_POST['request_text'];
    
    // Voer hier de code uit om de aanvraag naar de database te schrijven
    // Dit hangt af van hoe je database is opgezet en welke databaseverbinding je gebruikt
    
    // Voorbeeld: verbind met de database
    require_once('config.php'); // Include je database configuratiebestand
    
    // Voorbeeld: voeg de aanvraag toe aan de database
    $sql = "INSERT INTO aanvragen (user_id, request_text) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $request_text);
    
    // Voorbeeld: bepaal de user_id op basis van de voornaam en achternaam (dit kan anders zijn in je eigen database)
    $user_id = 1; // Vervang dit door de daadwerkelijke user_id
    $stmt->execute();
    
    // Voorbeeld: sluit de databaseverbinding
    $stmt->close();
    $conn->close();
    
    // Optioneel: stuur de gebruiker door naar een andere pagina na het toevoegen van de aanvraag
    header("Location: aanvragen.php");
    exit();
} else {
    // Als het formulier niet is verzonden, stuur de gebruiker terug naar het formulier
    header("Location: add_request.php");
    exit();
}
?>
