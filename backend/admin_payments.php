
    <style>
        /* Stijlen voor de zijdelingse navigatiebalk */
        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #353535;
            overflow-x: hidden;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidenav a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: flex;
            align-items: center;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav a.active {
            background-color: #FF5E00;
        }

        .sidenav a.active span {
            color: white;
        }

        /* Stijlen voor de inhoud van de pagina */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        th {
            background-color: #FF5E00;
            color: white;
        }

        /* Formulierstijlen */
        form {
            display: inline;
        }

        select {
            padding: 5px;
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #FF5E00;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF7F4D;
        }
    </style>




<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['typeOfUser'] !== 'admin') {
    // If not logged in or not admin, redirect to login page
    header("Location: ../frontend/index.php");
    exit();
}

// Include database configuration
require_once 'config.php';

// Fetch payments from the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a payment ID and route are submitted for update
    if (isset($_POST['payment_id']) && isset($_POST['route'])) {
        $payment_id = $_POST['payment_id'];
        $route = $_POST['route'];

        // Update the payment route in the database
        $update_sql = "UPDATE betalingen SET route = '$route' WHERE id = $payment_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "Payment route updated successfully";
            // Refresh the page after update
            header("Location: admin_payments.php");
            exit();
        } else {
            echo "Error updating payment route: " . $conn->error;
        }
    }
}

// Fetch payments from the database after form submission
$sql = "SELECT betalingen.*, users.firstname, users.lastname 
        FROM betalingen 
        JOIN users ON betalingen.user_id = users.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Management - Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style_admin.css">
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
</head>
<body>
    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Page content -->
    <div class="main">
        <h1>Payment Management</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Firstname</th> 
                <th>Lastname</th> 
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Route</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>"; 
                    echo "<td>" . $row["lastname"] . "</td>"; 
                    echo "<td>" . $row["amount"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["datum"] . "</td>";
                    echo "<td>";
                    // Dropdown menu for selecting route
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='payment_id' value='" . $row["id"] . "'>";
                    echo "<select name='route'>";
                    echo "<option value='Onderweg' " . ($row['route'] == 'Onderweg' ? 'selected' : '') . ">Onderweg</option>";
                    echo "<option value='Betaling ontvangen' " . ($row['route'] == 'Betaling ontvangen' ? 'selected' : '') . ">Betaling ontvangen</option>";
                    echo "<option value='Doorgestuurd' " . ($row['route'] == 'Doorgestuurd' ? 'selected' : '') . ">Doorgestuurd</option>";
                    echo "<option value='Teruggestuurd' " . ($row['route'] == 'Teruggestuurd' ? 'selected' : '') . ">Teruggestuurd</option>";
                    echo "<option value='Betaald' " . ($row['route'] == 'Betaald' ? 'selected' : '') . ">Betaald</option>";
                    echo "</select>";
                    echo "<input type='submit' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td><form method='post'><input type='hidden' name='delete_payment' value='" . $row["id"] . "'><input type='submit' value='Delete'></form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No payments found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
