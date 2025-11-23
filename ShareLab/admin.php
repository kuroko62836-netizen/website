<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin"){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
<h2>Admin Dashboard</h2>
<a href="add_lesson.php">Add Lesson</a> |
<a href="show_users.php">Show Users</a> |
<a href="delete_post.php">Delete Posts</a> |
<a href="lessons.php">View Lessons</a> |
<a href="logout.php">Logout</a>
</body>
</html>
