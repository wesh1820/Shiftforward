<?php
// Inclusief de databaseconfiguratie
require_once('config.php');

// Verbinding maken met de database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Controleren op fouten in de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvangen van formuliergegevens
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];

    // Controleer of alle velden zijn ingevuld
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phoneNumber) || empty($password)) {
        echo "Alle velden moeten worden ingevuld.";
    } else {
        // Voeg gebruiker toe aan de database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Wachtwoord hashen voordat het wordt opgeslagen
        $sql = "INSERT INTO users (firstname, lastname, email, phoneNumber, password) VALUES ('$firstname', '$lastname', '$email', '$phoneNumber', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registratie succesvol!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Databaseverbinding sluiten
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratieformulier</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <h2>Registratieformulier</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Voornaam: <input type="text" name="firstname"><br>
        Achternaam: <input type="text" name="lastname"><br>
        E-mail: <input type="text" name="email"><br>
        Telefoonnummer: <input type="text" name="phoneNumber"><br>
        Wachtwoord: <input type="password" name="password"><br>
        <input type="submit" value="Registreren">
    </form>
</body>
</html>
