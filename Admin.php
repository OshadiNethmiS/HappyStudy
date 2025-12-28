<?php 
session_start();

// Only allow admin
if (!isset($_SESSION['username']) || $_SESSION['isAdmin'] != 1) {
    header("Location: login.php");
    exit();
}

include_once 'heder.php';
?>

<body>

<header style="display:flex; justify-content: space-between; align-items: center; padding: 10px; background:#f0f0f0;">
    <div>
        <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
        HappYstudY
        <h2>..Your Easy Path to Learning..</h2>
    </div>

    <div style="text-align:right;">
        <span style="margin-right: 15px;">👤 <?php echo $_SESSION['username']; ?></span>
        <a href="logout.php" style="padding: 8px 15px; background:#ff4d4d; color:white; border-radius:5px; text-decoration:none;">Logout</a>
    </div>
</header>

<div class="nav">
    <h1>Admin Dashboard</h1>
</div>

<div class="main">
    <br><br>
    <div class="card_h">
        <div class="cards">
            <div class="card" style="background: #4d2bc9ff;">
                <h3>📘 Registered</h3>
                <p>Sign up and register for courses</p>
            </div>

            <a href="editcourse.php" target="_blank">
                <div class="card" style="background: #4d2bc9ff;">
                    <h3>✏️ Edit Courses</h3>
                    <p>Check your registered courses</p>
                </div>
            </a>
        </div>
    </div>
</div>

<footer>
    © 2025 HappyStudY - Admin Panel
</footer>

<?php 
include_once 'footer.php';
?>
