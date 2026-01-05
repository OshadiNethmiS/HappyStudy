<?php
session_start();

/* DB connection */
$conn = mysqli_connect("localhost", "root", "", "happystudy_login");
if (!$conn) {
    die("Database connection failed");
}

/* Fetch all courses */
$result = mysqli_query($conn, "SELECT * FROM course ORDER BY id DESC");

include_once 'heder.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Courses</title>
<style>
body {
    font-family: Arial, sans-serif;
    background:#eef6fc;
    margin:0;
}

.courses-container {
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    padding:30px;
    justify-content:center;
}

.course-card {
    background:#ffffff;
    width:280px;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 10px rgba(0,0,0,0.15);
}

.course-card h3 {
    color:#11004d;
    margin-top:0;
}

.course-card p {
    margin:6px 0;
    color:#333;
}

.course-card .fee {
    font-weight:bold;
    color:#4d2bc9;
    margin-top:10px;
}

.register-btn {
    display:block;
    margin-top:15px;
    padding:10px;
    background:#11004d;
    color:white;
    text-align:center;
    text-decoration:none;
    border-radius:8px;
}

.register-btn:hover {
    background:#4d2bc9;
}
</style>
</head>

<body>

<h1 style="text-align:center; margin-top:20px;">📘 Available Courses</h1>

<div class="courses-container">

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="course-card">
            <h3><?php echo htmlspecialchars($row['course_name']); ?></h3>

            <p><?php echo htmlspecialchars($row['course_description']); ?></p>
            <p><b>Start Date:</b> <?php echo $row['start_date']; ?></p>
            <p><b>Duration:</b> <?php echo htmlspecialchars($row['duration']); ?></p>
            <p><b>Instructor:</b> <?php echo htmlspecialchars($row['instructor']); ?></p>

            <p class="fee">Fee: Rs. <?php echo $row['course_fee']; ?></p>

            <a class="register-btn"
               href="<?php
                    if (isset($_SESSION['username'])) {
                        echo 'Registration.php?course_id=' . $row['id'];
                    } else {
                        echo 'login.php';
                    }
               ?>">
                Register
            </a>
        </div>
        <?php
    }
} else {
    echo "<p>No courses available.</p>";
}

mysqli_close($conn);
?>

</div>

</body>
</html>
