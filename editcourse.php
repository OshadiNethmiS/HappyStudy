<?php
session_start();

/* Protect page – only admin can access */
if (!isset($_SESSION["username"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: login.php");
    exit();
}

include_once 'heder.php';

/* Database connection */
$conn = mysqli_connect("localhost", "root", "", "happystudy_login");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* Handle course update */
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $start_date = $_POST['start_date'];
    $duration = $_POST['duration'];
    $instructor = $_POST['instructor'];
    $course_fee = $_POST['course_fee'];

    $update_sql = "UPDATE course 
                   SET course_name='$course_name', course_description='$course_description',
                       start_date='$start_date', duration='$duration',
                       instructor='$instructor', course_fee='$course_fee'
                   WHERE id='$id'";
    mysqli_query($conn, $update_sql);
    header("Location: editcourse.php");
    exit();
}

/* Handle new course addition */
if (isset($_POST['add'])) {
    $course_name = $_POST['new_course_name'];
    $course_description = $_POST['new_course_description'];
    $start_date = $_POST['new_start_date'];
    $duration = $_POST['new_duration'];
    $instructor = $_POST['new_instructor'];
    $course_fee = $_POST['new_course_fee'];

    $add_sql = "INSERT INTO course (course_name, course_description, start_date, duration, instructor, course_fee)
                VALUES ('$course_name', '$course_description', '$start_date', '$duration', '$instructor', '$course_fee')";
    mysqli_query($conn, $add_sql);
    header("Location: editcourse.php");
    exit();
}

/* Handle course deletion */
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $del_sql = "DELETE FROM course WHERE id='$id'";
    mysqli_query($conn, $del_sql);
    header("Location: editcourse.php");
    exit();
}

/* Fetch all courses */
$sql = "SELECT * FROM course";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Courses</title>
    <style>
        body { font-family: Arial; background: #eef6fcff; margin:0; }
        .container { display: flex; padding: 20px; gap: 20px; }
        .left-panel { width: 50%; }
        .right-panel { width: 50%; padding: 20px; background: #fff; border-left:2px solid #ccc; display: none; flex-direction: column; gap:10px;}
        .right-panel.active { display: flex; }
        .course-cards { display: flex; flex-wrap: wrap; gap: 20px; }
        .card {
            background: #4d2bc9ff; color: white;
            width: 200px; padding: 20px;
            border-radius: 15px; cursor: pointer;
            transition: transform 0.2s;
        }
        .card:hover { transform: scale(1.05); }
        input, textarea { width: 100%; padding:10px; margin-top:10px; font-size:16px; }
        button { padding:12px; background:#11004d; color:white; border:none; border-radius:8px; font-size:16px; cursor:pointer; margin-top:10px;}
        h1, h2 { text-align:center; }
        .add-course { background:#f3f3f3; padding:15px; border-radius:10px; margin-bottom:20px;}
        label { font-weight: bold; margin-top: 10px; display:block;}
    </style>
</head>
<body>

<h1>Edit Courses</h1>

<div class="container">

    <!-- Left Panel: Add & Course Cards -->
    <div class="left-panel">
        <!-- Add New Course -->
        <div class="add-course">
            <h2>Add New Course</h2>
            <form method="POST">
                <label>Course Name:</label>
                <input type="text" name="new_course_name" required>

                <label>Course Description:</label>
                <textarea name="new_course_description" rows="3" required></textarea>

                <label>Start Date:</label>
                <input type="date" name="new_start_date" required>

                <label>Duration:</label>
                <input type="text" name="new_duration" placeholder="e.g., 3 months" required>

                <label>Instructor:</label>
                <input type="text" name="new_instructor" required>

                <label>Course Fee:</label>
                <input type="number" step="0.01" name="new_course_fee" required>

                <button type="submit" name="add">Add Course</button>
            </form>
        </div>

        <!-- Course Cards -->
        <div class="course-cards">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data_attr = htmlspecialchars(json_encode($row), ENT_QUOTES);
                    echo "<div class='card' data-course='$data_attr'>
                            <h3>".$row['course_name']."</h3>
                            <p>".substr($row['course_description'],0,50)."...</p>
                          </div>";
                }
            } else {
                echo "<p>No courses available.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Right Panel: Edit/Delete Course -->
    <div class="right-panel" id="editPanel">
        <h2>Edit Course</h2>
        <form method="POST">
            <input type="hidden" name="id" id="courseId">
            
            <label>Course Name:</label>
            <input type="text" name="course_name" id="courseName" required>

            <label>Course Description:</label>
            <textarea name="course_description" id="courseDesc" rows="3" required></textarea>

            <label>Start Date:</label>
            <input type="date" name="start_date" id="courseStart" required>

            <label>Duration:</label>
            <input type="text" name="duration" id="courseDuration" required>

            <label>Instructor:</label>
            <input type="text" name="instructor" id="courseInstructor" required>

            <label>Course Fee:</label>
            <input type="number" step="0.01" name="course_fee" id="courseFee" required>

            <button type="submit" name="update">Save Changes</button>
            <button type="submit" name="delete" style="background:red;">Delete Course</button>
        </form>
    </div>

</div>

<script>
    const cards = document.querySelectorAll('.card');
    const editPanel = document.getElementById('editPanel');
    const courseId = document.getElementById('courseId');
    const courseName = document.getElementById('courseName');
    const courseDesc = document.getElementById('courseDesc');
    const courseStart = document.getElementById('courseStart');
    const courseDuration = document.getElementById('courseDuration');
    const courseInstructor = document.getElementById('courseInstructor');
    const courseFee = document.getElementById('courseFee');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const course = JSON.parse(card.dataset.course);
            editPanel.classList.add('active');
            courseId.value = course.id;
            courseName.value = course.course_name;
            courseDesc.value = course.course_description;
            courseStart.value = course.start_date;
            courseDuration.value = course.duration;
            courseInstructor.value = course.instructor;
            courseFee.value = course.course_fee;
        });
    });
</script>

</body>
</html>
