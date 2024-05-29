<?php
session_start();
require_once "config/db.php";

if (isset($_SESSION["user"])) {
    header("Location: indeeex.php");
    exit;
}

if (isset($_POST["looogin"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = "yes";
            $_SESSION["email"] = $user["email"];
            header("Location: indeeex.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>
<!-- HTML code remains the same -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login-style.css" />
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="background-color: #a9b7e0; color: white;">Login</h3>
            </div>
            <div class="card-body">
                <form action="looogin.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="looogin">Login</button>
                    <a href="portal.php" class="btn-back float-end">Back</a>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="text-muted mb-0">Not registered yet? <a href="registration.php">Register Here</a></p>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <div class="copy text-center py-3" style="color: black; font-weight: bold;">
        &copy; 2024 - faculté des sciences exacte et science de vie. All Rights Reserved.
    </div>
</body>
</html>
