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

// Initialize variables for form input
$id = $firstname = $lastname = $email = $phoneNumber = '';

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if an action (add, edit, delete) is specified
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        // ADD: Insert new user into the database
        if ($action === 'add') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            $sql = "INSERT INTO users (firstname, lastname, email, phoneNumber, password) VALUES ('$firstname', '$lastname', '$email', '$phoneNumber', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New user added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // EDIT: Update existing user in the database
        elseif ($action === 'edit') {
            $id = $_POST['id'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            // You may want to add validation and sanitization here

            $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', phoneNumber='$phoneNumber' WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
                echo "User updated successfully";
            } else {
                echo "Error updating user: " . $conn->error;
            }
        }

        // DELETE: Delete user from the database
        elseif ($action === 'delete') {
            $id = $_POST['id'];
            $sql = "DELETE FROM users WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
                echo "User deleted successfully";
            } else {
                echo "Error deleting user: " . $conn->error;
            }
        }
    }
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management - Admin Dashboard</title>
    <!-- Add your CSS files here -->
</head>
<body>
    <h1>User Management</h1>
    
    <!-- User Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" id="action">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>"><br>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br>
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $phoneNumber; ?>"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <button type="button" onclick="addUser()">Add User</button>
        <button type="button" onclick="editUser()">Edit User</button>
        <button type="button" onclick="deleteUser()">Delete User</button>
    </form>
    
    <!-- Users Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phoneNumber"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>
    
    <!-- JavaScript functions for handling CRUD operations -->
    <script>
        function addUser() {
            document.getElementById("action").value = "add";
            document.getElementById("id").value = "";
            document.getElementById("firstname").value = "";
            document.getElementById("lastname").value = "";
            document.getElementById("email").value = "";
            document.getElementById("phoneNumber").value = "";
            document.getElementById("password").value = "";
            document.querySelector("form").submit();
        }
        
        function editUser() {
            document.getElementById("action").value = "edit";
            document.querySelector("form").submit();
        }
        
        function deleteUser() {
            if (confirm("Are you sure you want to delete this user?")) {
                document.getElementById("action").value = "delete";
                document.querySelector("form").submit();
            }
        }
    </script>
    
    <a href="logout.php">Logout</a>
</body>
</html>
