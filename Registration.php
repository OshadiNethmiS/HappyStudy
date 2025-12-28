<?php
session_start();

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize message
$message = "";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "happystudy_login");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // logged-in user ID
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $course_name = $_POST['course'];

    // Get course_id from course table
    $course_sql = "SELECT id FROM course WHERE course_name = ?";
    $stmt_course = $conn->prepare($course_sql);
    $stmt_course->bind_param("s", $course_name);
    $stmt_course->execute();
    $stmt_course->bind_result($course_id);
    $stmt_course->fetch();
    $stmt_course->close();

    if (!$course_id) {
        $message = "Selected course not found.";
    } else {
        // Insert into user_courses table
        $stmt = $conn->prepare("INSERT INTO user_courses 
            (user_id, course_id, first_name, last_name, address, email, phone, dob, gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssssss", $user_id, $course_id, $fname, $lname, $address, $email, $phone, $dob, $gender);

        if ($stmt->execute()) {
            $message = "Course registration successful!";
        } else {
            $message = "Registration failed: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #b9f1f1ff;
            padding: 30px;
        }
        .container {
            width: 700px;
            margin: auto;
            background: linear-gradient(135deg, #ffffff, #9fd0f1ff); 
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        .nav { list-style-type: none; padding: 0; display: flex; border: 0px solid; background-color: #b6daf1ff; margin: 0; }
        header { padding: 20px; font-size: 90px; font-family:Agency FB; font-weight: bold; color: #1a0957ff; text-align: left; }
        h2 { font-size: 27px; margin-bottom: 10px; color: #1a0957ff; margin:20px; }
        h3 { font-size: 20px; color: #1a0957ff; }
        .row { gap: 10px; margin: 30px 40px ; }
        .row-2 { display: flex; width: 80%; }
        .row input, select { width: 80%; padding: 10px; border: 1px solid #ddd; border-radius: 10px; }
        .gender-box { margin-left: 35px; }
        .btn-box { display: flex; justify-content: center; gap: 15px; margin-top: 20px; }
        button { padding: 10px 20px; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
        .submit-btn { background: #007bff; color: white; }
        .cancel-btn { background: #ff4d4d; color: white; }
        .message { text-align: center; font-size: 18px; color: green; margin-bottom: 15px; }
    </style>
</head>

<body>

<div class="container">
    <header>
        <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
        HappYstudY
        <h2>..Your Easy Path to Learning.. </h2>
    </header>

    <div class="nav">
        <h1>Registration Form</h1>
    </div>

    <?php
    if ($message != "") {
        echo "<div class='message'>$message</div>";
    }
    ?>

    <form method="POST">

        <div class="row">
            <h3>Name</h3> 
            <div class="row-2">
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
            </div> 
        </div> 

        <div class="row">
            <h3>Address</h3>
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="row">
            <h3>Email</h3>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="row">
            <h3>Phone Number</h3>
            <input type="text" name="phone" placeholder="Phone Number" required>
        </div>

        <div class="row">
            <h3>Date of Birth</h3>
            <input type="date" name="dob" required>
        </div>

        <div class="gender-box">
            <h3>Gender:</h3><br>
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female
        </div>

        <div class="row">
            <h3>Course</h3>
            <select name="course" required>
                <option disabled selected>-- Select Course --</option>
                <?php
                // Fetch courses dynamically from course table
                $conn = mysqli_connect("localhost", "root", "", "happystudy_login");
                $course_result = mysqli_query($conn, "SELECT course_name FROM course");
                while ($course = mysqli_fetch_assoc($course_result)) {
                    echo "<option>" . htmlspecialchars($course['course_name']) . "</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div class="btn-box">
            <button type="submit" class="submit-btn">Submit</button>
            <button type="reset" class="cancel-btn">Cancel</button>
        </div>

    </form>
</div>

</body>
</html>
