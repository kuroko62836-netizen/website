<?php
session_start();
include "db.php";

if($_SESSION['role']!="admin"){ header("Location: login.php"); }

if(isset($_POST['add'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $conn->query("INSERT INTO lessons(title, content) VALUES('$title','$content')");
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Lesson</h2>
<form method="POST">
Title: <input type="text" name="title" required><br><br>
Content:<br><textarea name="content" required></textarea><br><br>
<button name="add">Add Lesson</button>
</form>
<a href="admin.php">Back</a>

</body>
</html>
