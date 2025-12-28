<?php 
    include_once 'heder.php';
    

// 1. Database connection
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "happystudy_login"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Fetch courses from database
$sql = "SELECT * FROM course"; 
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses Page</title>
</head>
<body>

    <header>
    <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
    HappYstudY
    
    <h2>  ..Your Easy Path to Learning.. </h2>
    
  </header>
  <div class="nav">
            <h1>Available Courses</h1>
</div>


    <div class="courses-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="course-card">
                    <h3><?php echo $row['course_name']; ?></h3>
                    <p><?php echo $row['course_description']; ?></p>
                    <a class="register-btn" href="register.php?course_id=<?php echo $row['id']; ?>">Register</a>
                </div>
                <?php
            }
        } 
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
