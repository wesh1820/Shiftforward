<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['typeOfUser'] !== 'admin') {
    // If not logged in or not admin, redirect to login page
    header("Location: ../frontend/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style_admin.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidenav">
        <div class="sidebar-logo">
            <img src="../image/logo.png" alt="Logo"class="sidebar-logo">
        </div>
        <a href="../backend/admin_requests.php">Request Management</a>
        <a href="../backend/admin_payments.php">Payment Management</a>
        <a href="../backend/admin_documents.php">Document Management</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Page content -->
    <div class="main">
        <h1>Welcome to the Admin Dashboard, <?php echo $_SESSION['firstname']; ?>!</h1>
    </div>
</body>
</html>
