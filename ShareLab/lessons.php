<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){ 
    header("Location: login.php"); 
}

$lessons = $conn->query("SELECT * FROM lessons");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lessons</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
/* ====== Global ====== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body.lessons-page {
    display: flex;
    min-height: 100vh;
    background: linear-gradient(135deg, #6e8efb, #a777e3);
    color: #fff;
}

/* ====== Sidebar ====== */
.sidebar {
    width: 240px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 30px 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sidebar .logo {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #fff;
}

.sidebar a.menu {
    padding: 12px 15px;
    border-radius: 12px;
    color: white;
    text-decoration: none;
    background: rgba(255, 255, 255, 0.1);
    transition: 0.3s;
}

.sidebar a.menu:hover,
.sidebar a.menu.active {
    background: rgba(255, 255, 255, 0.35);
    transform: translateX(5px);
}

/* Sidebar logout button */
.sidebar a.logout {
    margin-top: auto;
    background: rgba(255, 80, 80, 0.4); /* semi-transparent red */
    color: #fff;
    text-align: center;
    padding: 12px 15px;
    border-radius: 12px;
    transition: 0.3s;
}

.sidebar a.logout:hover {
    background: rgba(255, 80, 80, 0.55); /* brighter red on hover */
    transform: translateX(5px);
}
a {
    text-decoration: none;
    color: inherit; /* optional: inherit color from parent */
}

/* ====== Main Content ====== */
.content {
    flex: 1;
    padding: 30px;
    overflow-y: auto;
}

.content h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    text-align: center;
    color: #fff;
}

.content hr {
    width: 80px;
    border: 2px solid rgba(255, 255, 255, 0.7);
    margin: 15px auto 40px;
    border-radius: 2px;
}

.content .back {
    display: inline-block;
    margin-bottom: 30px;
    color: #fff;
    background: rgba(255, 255, 255, 0.15);
    padding: 8px 18px;
    border-radius: 12px;
    transition: 0.3s;
}

.content .back:hover {
    background: rgba(255, 255, 255, 0.35);
    transform: translateX(5px);
}

/* ====== Lesson Cards ====== */
.post {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 25px 30px;
    border-radius: 18px;
    margin-bottom: 25px;
    max-width: 700px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
    animation: fadeIn 0.5s ease forwards;
}

.post:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
}

.post h3 {
    font-size: 1.8rem;
    margin-bottom: 12px;
    color: #fff;
}

.post p {
    font-size: 1rem;
    line-height: 1.6;
    color: #eee;
}

/* ====== Fade-in animation ====== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ====== Responsive ====== */
@media (max-width: 800px) {
    .sidebar { display: none; }
    body.lessons-page { justify-content: center; }
    .content { padding: 15px; }
}
</style>
</head>
<body class="lessons-page">

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">My Lessons</div>
    <a href="index.php" class="menu <?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'active'; ?>">Home</a>
    <a href="lessons.php" class="menu <?php if(basename($_SERVER['PHP_SELF'])=='lessons.php') echo 'active'; ?>">Lessons</a>
    <a href="profile.php" class="menu <?php if(basename($_SERVER['PHP_SELF'])=='profile.php') echo 'active'; ?>">Profile</a>
    <a href="post.php" class="menu">My Posts</a>
    <a href="logout.php" class="logout">Logout</a>
</div>


<!-- Main Content -->
<div class="content">
    <h2>Lessons</h2>
    <hr>
    <a class="back" href="index.php">← Back to Home</a>

    <?php while($l = $lessons->fetch_assoc()){ ?>
    <div class="post">
        <h3><?php echo htmlspecialchars($l['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($l['content'])); ?></p>
    </div>
    <?php } ?>
</div>

<script>
// Fade-in on scroll
const posts = document.querySelectorAll('.post');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if(entry.isIntersecting){
            entry.target.style.animation = "fadeIn 0.5s forwards";
        }
    });
}, { threshold: 0.1 });
posts.forEach(post => observer.observe(post));

// Smooth button click animation
document.querySelectorAll("button, .back").forEach(btn => {
    btn.addEventListener("mousedown", () => btn.style.transform = "scale(0.95)");
    btn.addEventListener("mouseup", () => btn.style.transform = "scale(1)");
});
</script>

</body>
</html>
