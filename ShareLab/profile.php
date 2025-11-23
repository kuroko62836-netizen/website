<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){ header("Location: login.php"); }

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id='$user_id'");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
/* ====== Global ====== */
* { margin:0; padding:0; box-sizing:border-box; font-family:"Poppins", sans-serif; }
body.profile-page { display:flex; min-height:100vh; background: linear-gradient(135deg, #6e8efb, #a777e3); color:#fff; }

/* ====== Sidebar ====== */
.sidebar {
    width:240px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding:30px 20px;
    display:flex;
    flex-direction:column;
    gap:20px;
}
.sidebar .logo { text-align:center; font-size:1.8rem; font-weight:600; margin-bottom:20px; color:#fff; }
.sidebar a.menu { padding:12px 15px; border-radius:12px; color:#fff; text-decoration:none; background:rgba(255,255,255,0.1); transition:0.3s; }
.sidebar a.menu:hover, .sidebar a.menu.active { background:rgba(255,255,255,0.35); transform:translateX(5px); }
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

/* ====== Main Content ====== */
.content { flex:1; padding:30px; overflow-y:auto; }
.content h2 { font-size:2.5rem; margin-bottom:10px; text-align:center; color:#fff; }
.content hr { width:80px; border:2px solid rgba(255,255,255,0.7); margin:15px auto 40px; border-radius:2px; }
.content .back { display:inline-block; margin-bottom:30px; color:#fff; background: rgba(255,255,255,0.15); padding:8px 18px; border-radius:12px; transition:0.3s; }
.content .back:hover { background: rgba(255,255,255,0.35); transform:translateX(5px); }

/* ====== Profile Card ====== */
.card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding:25px 30px;
    border-radius:18px;
    margin-bottom:25px;
    max-width:min(700px,90%);
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    transform: translateY(20px);
    opacity:0;
    transition: transform 0.5s ease, opacity 0.5s ease, box-shadow 0.3s;
    will-change: transform, opacity;
}
.card.visible { opacity:1; transform:translateY(0); }
.card:hover { transform:translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.35); }
.card p { color:#eee; font-size:1rem; line-height:1.6; margin-bottom:10px; }

/* ====== Responsive ====== */
@media(max-width:800px){ .sidebar{display:none;} body.profile-page{justify-content:center;} .content{padding:15px;} }
a {
    text-decoration: none;
    color: inherit; /* optional: inherit color from parent */
}
</style>
</head>
<body class="profile-page">

<div class="sidebar">
    <div class="logo">Profile</div>
    <a href="index.php" class="menu">Home</a>
    <a href="lessons.php" class="menu">Lessons</a>
    <a href="profile.php" class="menu active">Profile</a>
    <a href="post.php" class="menu">My Posts</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="content">
    <h2>Your Profile</h2>
    <hr>
    <a class="back" href="index.php">← Back to Home</a>

    <div class="card">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    </div>
</div>

<script>
const cards = document.querySelectorAll('.card');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry=>{
        if(entry.isIntersecting){ entry.target.classList.add('visible'); }
    });
},{ threshold:0.1 });
cards.forEach(card=>observer.observe(card));

// Smooth back button
document.querySelectorAll(".back").forEach(btn=>{
    btn.addEventListener("mousedown",()=>btn.style.transform="scale(0.95)");
    btn.addEventListener("mouseup",()=>btn.style.transform="scale(1)");
    btn.addEventListener("mouseleave",()=>btn.style.transform="scale(1)");
});
</script>

</body>
</html>
