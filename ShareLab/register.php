<?php
include "db.php";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users(username,email,password,role)
                  VALUES('$username','$email','$password','user')");

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>

<div class="auth-box">
    <h2 class="auth-title">Register</h2>

    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button name="register">Register</button>
    </form>

    <a class="auth-link" href="login.php">Already have an account? Login</a>
</div>

<script src="js/auth.js"></script>
</body>
</html>
