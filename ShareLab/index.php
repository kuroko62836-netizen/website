<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="user"){
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['post'])){
    $content = $_POST['content'];
    $conn->query("INSERT INTO posts(user_id,content,created_at)
                  VALUES('$user_id','$content',NOW())");
    header("Location: index.php");
}

$posts = $conn->query("SELECT posts.*, users.username 
                       FROM posts 
                       JOIN users ON posts.user_id = users.id
                       ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2 class="logo">ShareLab</h2>
    <a href="index.php" class="menu active">Home</a>
    <a href="lessons.php" class="menu">Lessons</a>
    <a href="profile.php" class="menu">Profile</a>
    <a href="post.php" class="menu">My Posts</a>
    <a href="logout.php" class="menu logout">Logout</a>
</div>

<!-- Main Content -->
<div class="content">

    <div class="topbar">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    </div>

    <!-- Post Composer -->
    <div class="composer">
        <form method="POST">
            <textarea name="content" placeholder="What's on your mind?" required></textarea>
            <button name="post">Publish</button>
        </form>
    </div>

    <!-- Feed -->
    <h3 class="feed-title">Latest Posts</h3>

    <?php while($row = $posts->fetch_assoc()){ ?>
    <div class="post-card">
        <p class="content-text"><?php echo $row['content']; ?></p>
        <small class="post-meta">
            Posted by <b><?php echo $row['username']; ?></b> • 
            <?php echo $row['created_at']; ?>
        </small>
    </div>
    <?php } ?>

</div>

<script src="js/main.js"></script>
</body>
</html>
