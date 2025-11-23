<?php
session_start();
include "db.php";
if($_SESSION['role']!="admin"){ header("Location: login.php"); }

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("DELETE FROM posts WHERE id='$id'");
    header("Location: delete_post.php");
}

$posts = $conn->query("SELECT posts.*, users.username 
                       FROM posts JOIN users ON posts.user_id = users.id 
                       ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Delete Posts</h2>
<a href="admin.php">Back</a>
<hr>
<?php while($p = $posts->fetch_assoc()){ ?>
<div class="post">
<p><?php echo $p['content']; ?></p>
<small>Posted by <?php echo $p['username']; ?> at <?php echo $p['created_at']; ?></small><br>
<a href="delete_post.php?id=<?php echo $p['id']; ?>">Delete</a>
</div>
<?php } ?>

</body>
</html>
