<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// Check for login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username exists
    $sql = "SELECT * FROM staff WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If username exists, check the password
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Start the session and store the user data
            $_SESSION['staff'] = $row['username'];

            // Redirect to the staff dashboard
            header("Location: staff/staff_dashboard.html");
            exit;
        } else {
            // Invalid password
            echo "Invalid password.";
        }
    } else {
        // Username not found
        echo "No user found with that username.";
    }
}
?>
