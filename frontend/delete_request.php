<?php
// Controleer of er een ID is meegegeven in de URL
if(isset($_GET['id'])) {
    // Ontvang het ID van de URL
    $request_id = $_GET['id'];
    
    // Voer hier de code uit om de specifieke aanvraag uit de database te verwijderen
    // Dit hangt af van hoe je database is opgezet en welke databaseverbinding je gebruikt
    
    // Voorbeeld: Verwijder de aanvraag uit de database
    require_once('config.php'); // Include je database configuratiebestand
    $sql = "DELETE FROM aanvragen WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    // Stuur de gebruiker terug naar de hoofdpagina
    header("Location: aanvragen.php");
    exit();
} else {
    // Als er geen ID is meegegeven, stuur de gebruiker terug naar de hoofdpagina
    header("Location: aanvragen.php");
    exit();
}
?>
