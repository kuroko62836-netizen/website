<?php
session_start();
include "db.php";
if($_SESSION['role']!="admin"){ header("Location: login.php"); }

$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>All Users</h2>
<a href="admin.php">Back</a>
<hr>
<?php while($u = $users->fetch_assoc()){ 
    echo $u['username']." (".$u['email']." | ".$u['role'].")<br>";
} ?>
</body>
</html>
