<?php
include 'connect.php';

function getUserMoney($connect, $userId)
{
    $sql = "SELECT Money FROM user WHERE user_id = '$userId'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Money'];
    } else {
        return "Error: Unable to fetch money amount";
    }
}

function verifyPassword($connect, $email, $password)
{
    $sql = "SELECT Password FROM user WHERE Email = '$email'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['Password'];

        return password_verify($password, $storedPassword);
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $amount = $_POST['amount'];

    // Validate and sanitize inputs (implement sanitization and validation here)

    if (verifyPassword($connect, $email, $password)) {
        $sql = "UPDATE user SET Money = Money + $amount WHERE Email = '$email'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "Money added successfully!";
        } else {
            echo "Error updating money: " . mysqli_error($connect);
        }
    } else {
        echo "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/wallet.css">
</head>
<body class="main-layout">
    <div class="wallet">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text_align_center">
                        <h2>ACCOUNT</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div id="wa_hover" class="wallet_box text_align_center">
                        <i><img src="images/wa1.svg" alt="#"/></i>
                        <h3>ONLINE WALLET</h3>
                        <p>It is a long established fact that a reader will be distracted by </p>
                    </div>
                </div>
                </div>
            </div>
              </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount to Add:</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Money</button>
                </form>
            </div>
        </div>

        <div class="row">
                <div class="col-md-6 offset-md-3">
                    <button type="button" id="checkMoneyBtn" class="btn btn-secondary">Check Money</button>
                </div>
            </div>

    </div>
</div>





        <!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/wallet.css">
</head>

<body class="main-layout">
    <div class="wallet">
        <div class="container-fluid">
            <!-- Your existing HTML code -->
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="add_money.php">
                    <!-- Your form -->
                </form>
            </div>
        </div>


     
    </div>

    <br>
    <br>
    <br>

</body>

</html>


        
    </div>

    

    <br>
    <br>
    <br>

    <script>
        document.getElementById("checkMoneyBtn").addEventListener("click", function () {
            alert("Your current money amount: $<?php echo $moneyAmount; ?>");
        });
    </script>

   </body>
</html>