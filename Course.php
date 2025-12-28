<?php
session_start();

include_once 'heder.php';

/* 1. Database connection */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happystudy_login";

/* Create connection */
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* Check connection */
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* 2. Fetch courses from database */
$sql = "SELECT * FROM course";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef6fc;
        }
        header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15px 30px;
            background: #d0eaff;
        }
        header img {
            width: 150px;
        }
        header h2 {
            color: #11004d;
        }
        .courses-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 30px;
        }
        .course-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 250px;
        }
        .course-card h3 {
            color: #11004d;
        }
        .course-card p {
            color: #333;
            margin: 10px 0;
        }
        .register-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #11004d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .register-btn:hover {
            background: #4d2bc9;
        }
    </style>
</head>
<body>
            
           <header >
    <div>
        <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
        HappYstudY
        <h2>..Your Easy Path to Learning..</h2>
    </div>
    </header>

<div class="courses-container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="course-card">
                <h3><?php echo $row['course_name']; ?></h3>
                <p><?php echo $row['course_description']; ?></p>
                <a class="register-btn" 
                   href="<?php 
                        if(isset($_SESSION['username'])) {
                            echo 'Registration.php?course_id=' . $row['id'];
                        } else {
                            echo 'login.php';
                        } ?>">
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
