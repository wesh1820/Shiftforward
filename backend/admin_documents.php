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
include 'sidebar.php';
// Fetch documents from the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM edocs";
$result = $conn->query($sql);

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a document ID is submitted for deletion
    if (isset($_POST['delete_document'])) {
        $document_id = $_POST['delete_document'];

        // Delete the document from the database
        $delete_sql = "DELETE FROM edocs WHERE id = $document_id";
        if ($conn->query($delete_sql) === TRUE) {
            echo "Document deleted successfully";
            // Refresh the page after deletion
            header("Location: admin_documents.php");
            exit();
        } else {
            echo "Error deleting document: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Management - Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style_admin.css">
</head>

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
<body>
    <h1>Document Management</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Document Name</th>
            <th>Document Path</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["doc_name"] . "</td>";
                echo "<td>" . $row["doc_path"] . "</td>";
                echo "<td><form method='post'><input type='hidden' name='delete_document' value='" . $row["id"] . "'><input type='submit' value='Delete'></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No documents found</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
