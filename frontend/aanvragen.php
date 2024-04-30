<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanvraaggegevens</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
       
        .request-info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .request-info-table th,
        .request-info-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

    </style>
</head>
<body>
    <div class="main">
        <div class="payment-content">
            <h1>Alle aanvragen</h1>
            <a href="add_request.php" class="view-button">Aanvraag Toevoegen</a><br>
            <div class="request-info"><br>
                <?php
                session_start();
                if (!isset($_SESSION['user_id'])) {
                    header("Location: login.php");
                    exit();
                }

                include 'sidebar.php';
                include 'config.php';
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM aanvragen WHERE user_id = $user_id";
                $result = $conn->query($sql);

                if (!$result) {
                    echo "Fout bij het uitvoeren van de query: " . $conn->error;
                } else {
                    if ($result->num_rows > 0) {
                        echo "<table class='request-info-table'>";
                        echo "<tr><th>ID</th><th>Onderwerp</th><th>Status</th><th>Meer info</th><th>T&T</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["subject"] . "</td>";
                            if(isset($row["route"])) {
                                echo "<td>" . $row["route"] . "</td>";
                            } else {
                                echo "<td>Niet gespecificeerd</td>";
                            }
                            echo "<td><a href='view_request.php?id=" . $row["id"] . "' class='view-button'>Bekijk</a></td>";
                            echo "<td><button class='view-button' onclick='navigateToDetails(" . $row["id"] . ")'>Track & Trace</button></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Geen aanvraaggegevens gevonden.";
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script>
        function navigateToDetails(paymentId) {
            window.location.href = "AanvraagDetails.php?id=" + paymentId;
        }
    </script>
</body>
</html>
