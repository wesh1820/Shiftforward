<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Track & Trace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 100%;
            margin: 10px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        p {
            margin-bottom: 20px;
            color: #666;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-between;
        }
        li {
            color: #333;
            text-align: center;
            flex: 1;
            position: relative;
        }
        .circle {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 auto 10px;
            line-height: 122px;
            font-size: 14px;
        }
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            height: 2px;
            background-color: #ccc;
        }
        .arrow:first-child {
            left: 0;
        }
        .arrow:last-child {
            right: 0;
        }
        .selected-circle {
        background-color: #ff5733; /* Verander de achtergrondkleur naar wat je maar wilt */
        color: #fff; /* Verander de tekstkleur naar wit of een andere kleur voor betere leesbaarheid */
    }
    </style>
</head>
<body>
<div class="main">
    <div class="payment-content">
        <?php
        // Databaseconfiguratiebestand inclusief
        include 'sidebar.php';
        include 'config.php';

        // Controleer of de betalings-ID aanwezig is in de queryparameters
        if (isset($_GET['id'])) {
            // Ontvang de betalings-ID uit de queryparameters
            $paymentId = $_GET['id'];

            // Query om de huidige waarde van het veld 'route' op te halen
            $sql = "SELECT route FROM betalingen WHERE id = $paymentId";
            $result = $conn->query($sql);

            // Controleer of er resultaten zijn
            if ($result !== false && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $selectedRoute = $row['route'];

                // Lijst van alle mogelijke waarden voor het veld 'route'
                $allRoutes = array('Ontvangen', 'Doorgestuurd', 'Geaccepteerd', 'Betaald');

                // Toon de kop van de tabel
                echo "<h1>Track & Trace</h1>";
                echo "<p>De uitkering is <strong>$selectedRoute</strong>.</p>";
                echo "<ul>";

                // Loop door alle mogelijke routes
                foreach ($allRoutes as $route) {
                    // Controleer of de huidige route overeenkomt met de geselecteerde route
                    $class = ($route == $selectedRoute) ? "selected-circle" : ""; // Voeg de klasse 'selected-circle' toe aan de geselecteerde route
                    echo "<li>";
                    echo "<div class='circle $class'>$route</div>";
                    echo "<div class='arrow'></div>";
                    echo "</li>";
                }

                // Sluit de lijst
                echo "</ul>";
            } else {
                echo "Geen betalingsgegevens gevonden voor deze betalings-ID.";
            }
        } else {
            echo "Geen betalings-ID opgegeven.";
        }

        // Databaseverbinding sluiten
        $conn->close();
        ?>
    </div>
    </div>
</body>
</html>
