<?php
ob_start();
session_start();

/* Admin protection */
if (!isset($_SESSION["username"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: login.php");
    exit();
}

/* DB connection */
$conn = mysqli_connect("localhost", "root", "", "happystudy_login");
if (!$conn) {
    die("DB Connection failed");
}

/* UPDATE course */
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    mysqli_query($conn, "
        UPDATE course SET
            course_name='{$_POST['course_name']}',
            course_description='{$_POST['course_description']}',
            start_date='{$_POST['start_date']}',
            duration='{$_POST['duration']}',
            instructor='{$_POST['instructor']}',
            course_fee='{$_POST['course_fee']}'
        WHERE id='$id'
    ");

    header("Location: editcourse.php");
    exit();
}

/* ADD course */
if (isset($_POST['add'])) {
    mysqli_query($conn, "
        INSERT INTO course
        (course_name, course_description, start_date, duration, instructor, course_fee)
        VALUES (
            '{$_POST['new_course_name']}',
            '{$_POST['new_course_description']}',
            '{$_POST['new_start_date']}',
            '{$_POST['new_duration']}',
            '{$_POST['new_instructor']}',
            '{$_POST['new_course_fee']}'
        )
    ");

    header("Location: editcourse.php");
    exit();
}

/* DELETE course */
if (isset($_POST['delete'])) {
    mysqli_query($conn, "DELETE FROM course WHERE id='{$_POST['id']}'");
    header("Location: editcourse.php");
    exit();
}

/* Fetch courses */
$result = mysqli_query($conn, "SELECT * FROM course ORDER BY id DESC");

include_once 'heder.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Courses</title>
<style>
body { font-family: Arial; background:#eef6fcff; margin:0; }
h1 { text-align:center; }

.container { display:flex; gap:20px; padding:20px; }
.left-panel { width:50%; }
.right-panel {
    width:50%; background:#fff; padding:20px;
    border-left:2px solid #ccc;
    display:none;
}
.right-panel.active { display:block; }

.course-cards { display:flex; flex-wrap:wrap; gap:15px; }
.card {
    background:#4d2bc9ff; color:white;
    width:220px; padding:15px;
    border-radius:12px;
    cursor:pointer;
}
.card h3 { margin:0 0 5px 0; }

input, textarea {
    width:100%; padding:10px; margin-top:10px;
}
button {
    padding:10px; border:none; border-radius:6px;
    background:#11004d; color:white; margin-top:10px;
}
.add-course {
    background:#f3f3f3; padding:15px;
    border-radius:10px; margin-bottom:20px;
}
</style>
</head>

<body>

<h1>📘 Edit Courses</h1>

<div class="container">

<!-- LEFT -->
<div class="left-panel">

<div class="add-course">
<h2>Add New Course</h2>
<form method="POST">
    <input type="text" name="new_course_name" placeholder="Course Name" required>
    <textarea name="new_course_description" placeholder="Description" required></textarea>
    <input type="date" name="new_start_date" required>
    <input type="text" name="new_duration" placeholder="Duration" required>
    <input type="text" name="new_instructor" placeholder="Instructor" required>
    <input type="number" step="0.01" name="new_course_fee" placeholder="Fee" required>
    <button name="add">Add Course</button>
</form>
</div>

<div class="course-cards">
<?php while ($row = mysqli_fetch_assoc($result)) {
    $json = htmlspecialchars(json_encode($row), ENT_QUOTES);
    echo "
    <div class='card' data-course='$json'>
        <h3>{$row['course_name']}</h3>
        <p>{$row['duration']}</p>
        <small>Rs. {$row['course_fee']}</small>
    </div>";
} ?>
</div>

</div>

<!-- RIGHT -->
<div class="right-panel" id="editPanel">
<h2>Edit Course</h2>
<form method="POST">
    <input type="hidden" name="id" id="cid">

    <input type="text" name="course_name" id="cname" required>
    <textarea name="course_description" id="cdesc" required></textarea>
    <input type="date" name="start_date" id="cstart" required>
    <input type="text" name="duration" id="cdur" required>
    <input type="text" name="instructor" id="cins" required>
    <input type="number" step="0.01" name="course_fee" id="cfee" required>

    <button name="update">Update</button>
    <button name="delete" style="background:red;">Delete</button>
</form>
</div>

</div>

<script>
const editPanel = document.getElementById('editPanel');
const cid = document.getElementById('cid');
const cname = document.getElementById('cname');
const cdesc = document.getElementById('cdesc');
const cstart = document.getElementById('cstart');
const cdur = document.getElementById('cdur');
const cins = document.getElementById('cins');
const cfee = document.getElementById('cfee');

document.querySelectorAll('.card').forEach(card=>{
    card.onclick = () => {
        const c = JSON.parse(card.dataset.course);
        editPanel.classList.add('active');
        cid.value = c.id;
        cname.value = c.course_name;
        cdesc.value = c.course_description;
        cstart.value = c.start_date;
        cdur.value = c.duration;
        cins.value = c.instructor;
        cfee.value = c.course_fee;
    }
});
</script>

</body>
</html>

<?php ob_end_flush(); ?>
