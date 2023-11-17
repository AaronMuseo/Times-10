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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">

    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Email">
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div>Don't have an account? <a href="signup.php">Sign Up</a></div>
</body>
</html>
