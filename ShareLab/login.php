<?php
session_start();
include "db.php";

$error = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == "admin"){
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>

<div class="auth-box">
    <h2 class="auth-title">Login</h2>

    <?php if($error != "") echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button name="login">Login</button>
    </form>

    <a class="auth-link" href="register.php">Don't have an account? Register</a>
</div>

<script src="js/auth.js"></script>
</body>
</html>
