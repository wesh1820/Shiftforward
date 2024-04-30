<?php
// Controleer of er een ID is meegegeven in de URL
if(isset($_GET['id'])) {
    // Ontvang het ID van de URL
    $request_id = $_GET['id'];
    
    // Voer hier de code uit om de specifieke aanvraag op te halen uit de database en weer te geven in een formulier voor bewerking
    // Dit hangt af van hoe je database is opgezet en welke databaseverbinding je gebruikt
    
    // Voorbeeld: Doorverwijzen naar een bewerkingsformulier met het ID van de aanvraag
    header("Location: edit_request_form.php?id=".$request_id);
    exit();
} else {
    // Als er geen ID is meegegeven, stuur de gebruiker terug naar de hoofdpagina
    header("Location: aanvragen.php");
    exit();
}
?>
