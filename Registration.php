
<?php
session_start();

/* ---------- LOGIN CHECK ---------- */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* ---------- DB CONNECTION ---------- */
$conn = mysqli_connect("localhost", "root", "", "happystudy_login");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* ---------- MESSAGE ---------- */
$message = "";

/* ---------- GET COURSE ID FROM URL ---------- */
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

/* ---------- FORM SUBMIT ---------- */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $fname   = trim($_POST['fname']);
    $lname   = trim($_POST['lname']);
    $address = trim($_POST['address']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $dob     = $_POST['dob'];
    $gender  = $_POST['gender'];
    $course_id = intval($_POST['course_id']);

    if ($course_id == 0) {
        $message = "❌ Invalid course!";
    } else {

        /* ---------- INSERT INTO register TABLE ---------- */
        $stmt = $conn->prepare(
            "INSERT INTO register
            (user_id, course_id, first_name, last_name, address, email, phone, dob, gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "iisssssss",
            $user_id,
            $course_id,
            $fname,
            $lname,
            $address,
            $email,
            $phone,
            $dob,
            $gender
        );

        if ($stmt->execute()) {
            $message = "✅ Registration Successful!";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>

    <style>
        body{
            font-family: Arial;
            background:#b9f1f1ff;
            padding:30px;
        }
        .container{
            width:700px;
            margin:auto;
            background:#e8f4ff;
            padding:25px;
            border-radius:10px;
        }
        header{
            font-size:50px;
            font-weight:bold;
            color:#1a0957ff;
        }
        h2{font-size:20px;}
        .nav{
            background:#b6daf1ff;
            padding:10px;
            margin-top:20px;
        }
        .row{margin:20px;}
        .row-2{display:flex; gap:10px;}
        input{
            width:100%;
            padding:10px;
            border-radius:8px;
            border:1px solid #ccc;
        }
        .gender-box{margin-left:20px;}
        .btn-box{
            display:flex;
            justify-content:center;
            gap:15px;
            margin-top:20px;
        }
        button{
            padding:10px 20px;
            border:none;
            border-radius:6px;
            font-size:16px;
            cursor:pointer;
        }
        .submit-btn{background:#007bff;color:white;}
        .cancel-btn{background:#ff4d4d;color:white;}
        .message{
            text-align:center;
            font-size:18px;
            color:green;
            margin:15px;
        }
    </style>
</head>

<body>

<div class="container">

<header>
    <img src="images/img_01.WEBP" width="120"><br>
    HappYstudY
    <h2>..Your Easy Path to Learning..</h2>
</header>

<div class="nav">
    <h1>Registration Form</h1>
</div>

<?php if($message!=""){ ?>
    <div class="message"><?php echo $message; ?></div>
<?php } ?>

<form method="POST">

    <!-- hidden course id -->
    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

    <div class="row">
        <h3>Name</h3>
        <div class="row-2">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" required>
        </div>
    </div>

    <div class="row">
        <h3>Address</h3>
        <input type="text" name="address" required>
    </div>

    <div class="row">
        <h3>Email</h3>
        <input type="email" name="email" required>
    </div>

    <div class="row">
        <h3>Phone</h3>
        <input type="text" name="phone" required>
    </div>

    <div class="row">
        <h3>Date of Birth</h3>
        <input type="date" name="dob" required>
    </div>

    <div class="gender-box">
        <h3>Gender</h3>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
    </div>

    <div class="btn-box">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="cancel-btn">Cancel</button>
    </div>

</form>

</div>

</body>
</html>
