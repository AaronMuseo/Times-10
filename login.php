<?php
include 'connect.php';

function login($connect, $email, $password) {
    // SQL to fetch user details based on provided email
    $sql = "SELECT Email, Password FROM user WHERE Email='$email'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['Password'];

        // Compare passwords directly without hashing (NOT RECOMMENDED)
        if ($password === $storedPassword) {
            return $row['Email']; // Return email on successful login
        } else {
            return false; // Incorrect password
        }
    } else {
        return false; // User not found or error occurred
    }
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Attempt login without hashing
    $loggedInEmail = login($connect, $email, $password);
    if ($loggedInEmail) {
        header("Location: index.html");
        exit;
    } else {
        echo "Invalid email or password. Please try again.";
    }
}

// Move the following outside of the form submission block
if ($success) {
    echo "<div style='Color: green; text-align: center;'>Signup successful!!</div>";
}

if ($unsuccess) {
    echo "<div style='Color: red; text-align: center;'>Email already exists!!</div>";
}
?>
