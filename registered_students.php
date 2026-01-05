<?php
session_start();

/* ---------- LOGIN CHECK ---------- */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* ---------- DB CONNECTION ---------- */
$conn = mysqli_connect("localhost","root","","happystudy_login");
if (!$conn) {
    die("DB Error");
}

/* ---------- DELETE ---------- */
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM register WHERE id=$delete_id");
    header("Location: registered_students.php");
    exit();
}

/* ---------- EDIT SUBMIT ---------- */
if (isset($_POST['update_student'])) {
    $id     = intval($_POST['id']);
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $gender = $_POST['gender'];

    mysqli_query($conn,
        "UPDATE register SET
         first_name='$fname',
         last_name='$lname',
         email='$email',
         phone='$phone',
         gender='$gender'
         WHERE id=$id"
    );

    header("Location: registered_students.php");
    exit();
}

/* ---------- EDIT DATA ---------- */
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $res = mysqli_query($conn,"SELECT * FROM register WHERE id=$edit_id");
    $edit_data = mysqli_fetch_assoc($res);
}

/* ---------- COURSES ---------- */
$courses = mysqli_query($conn,"SELECT * FROM course");

/* ---------- FILTER ---------- */
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

/* ---------- STUDENTS ---------- */
$sql = "SELECT r.*, c.course_name
        FROM register r
        JOIN course c ON r.course_id = c.id";

if ($course_id > 0) {
    $sql .= " WHERE r.course_id=$course_id";
}

$sql .= " ORDER BY r.registered_at DESC";
$students = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Registered Students</title>
<style>
body{font-family:Arial;background:#eef6ff;padding:30px;}
h1{text-align:center;color:#1a0957;}
table{width:100%;border-collapse:collapse;background:white;}
th,td{border:1px solid #ccc;padding:10px;text-align:center;}
th{background:#b6daf1;}
.btn{
    padding:6px 10px;
    border-radius:5px;
    text-decoration:none;
    color:white;
    font-size:14px;
}
.edit{background:#28a745;}
.delete{background:#dc3545;}
.filter{text-align:center;margin-bottom:20px;}
.form-box{
    width:400px;
    background:#fff;
    padding:20px;
    margin:20px auto;
    border-radius:8px;
}
input,select{width:100%;padding:8px;margin:6px 0;}
.save{background:#007bff;color:white;border:none;padding:10px;width:100%;}
</style>
</head>

<body>

<h1>Registered Students</h1>

<!-- FILTER -->
<div class="filter">
<form method="GET">
<select name="course_id">
<option value="0">All Courses</option>
<?php while($c=mysqli_fetch_assoc($courses)){ ?>
<option value="<?= $c['id']; ?>" <?= ($course_id==$c['id'])?'selected':''; ?>>
<?= $c['course_name']; ?>
</option>
<?php } ?>
</select>
<button type="submit">Filter</button>
</form>
</div>

<!-- EDIT FORM -->
<?php if($edit_data){ ?>
<div class="form-box">
<h3>Edit Student</h3>
<form method="POST">
<input type="hidden" name="id" value="<?= $edit_data['id']; ?>">
<input type="text" name="fname" value="<?= $edit_data['first_name']; ?>" required>
<input type="text" name="lname" value="<?= $edit_data['last_name']; ?>" required>
<input type="email" name="email" value="<?= $edit_data['email']; ?>" required>
<input type="text" name="phone" value="<?= $edit_data['phone']; ?>" required>

<select name="gender">
<option value="Male" <?= ($edit_data['gender']=="Male")?'selected':''; ?>>Male</option>
<option value="Female" <?= ($edit_data['gender']=="Female")?'selected':''; ?>>Female</option>
</select>

<button class="save" name="update_student">Update Student</button>
</form>
</div>
<?php } ?>

<!-- TABLE -->
<table>
<tr>
<th>ID</th>
<th>Course</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>Action</th>
</tr>

<?php if(mysqli_num_rows($students)>0){
while($row=mysqli_fetch_assoc($students)){ ?>
<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['course_name']; ?></td>
<td><?= $row['first_name']." ".$row['last_name']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['phone']; ?></td>
<td><?= $row['gender']; ?></td>
<td>
<a class="btn edit" href="?edit_id=<?= $row['id']; ?>">Edit</a>
<a class="btn delete"
   href="?delete_id=<?= $row['id']; ?>"
   onclick="return confirm('Delete this student?');">
Delete</a>
</td>
</tr>
<?php }} else { ?>
<tr><td colspan="7">No records</td></tr>
<?php } ?>
</table>

</body>
</html>
