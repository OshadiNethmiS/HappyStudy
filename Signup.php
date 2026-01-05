<?php
session_start();

$showError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];

    if ($password !== $passwordRepeat) {
        $showError = "Passwords do not match!";
    } else {

        $conn = mysqli_connect("localhost", "root", "", "happystudy_login");
        if (!$conn) {
            die("Database Connection Failed");
        }

        // Duplicate check
        $checkSql = "SELECT id FROM users WHERE usersEmail=? OR usersUid=?";
        $stmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $showError = "Email or Username already exists!";
        } else {

            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            $insertSql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, isAdmin)
                          VALUES (?, ?, ?, ?, 0)";
            $stmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);

            if (mysqli_stmt_execute($stmt)) {

                $_SESSION["user_id"] = mysqli_insert_id($conn);
                $_SESSION["username"] = $username;
                $_SESSION["isAdmin"] = 0;

                // Success message
                $_SESSION["success_msg"] = "🎉 Registration Successful! Welcome to HappyStudy";

                header("Location: Course.php");
                exit();
            } else {
                $showError = "Registration Failed!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HappyStudy | Register</title>
    <style>
        body { background:#eef6fc; font-family:Arial; }
        .container { width:900px; margin:auto; background:#fff; display:flex;
                     border-radius:20px; overflow:hidden; margin-top:40px; }
        .left { width:50%; padding:80px 30px; text-align:center;
                background:linear-gradient(#d0eaff,#a7d4f2); }
        .left h1 { font-size:60px; color:#11004d; }
        .left p { font-size:20px; color:#11004d; }
        .right { width:50%; padding:60px 40px; }
        .right h2 { text-align:center; color:#11004d; font-size:30px; }
        input { width:100%; padding:12px; margin-top:18px;
                border-radius:8px; border:1px solid #bbb; font-size:16px; }
        .btn { width:100%; margin-top:30px; padding:12px;
               background:#11004d; border:none; border-radius:25px;
               color:#fff; font-size:18px; cursor:pointer; }
        .msg { text-align:center; margin-top:15px; font-size:18px; color:red; }
        .register-link { text-align:center; margin-top:25px; font-size:18px; }
        .register-link a { color:#11004d; font-weight:bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="left">
        <h1>HappyStudY</h1>
        <p>..Your Easy Path to Learning..</p>
    </div>

    <div class="right">
        <h2>___Welcome___</h2>

        <?php if ($showError != "") { ?>
            <div class="msg"><?php echo $showError; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="passwordrepeat" placeholder="Repeat Password" required>
            <button type="submit" class="btn">Register</button>
        </form>

        <div class="register-link">
            Already Registered?<br>
            <a href="login.php">Login</a>
        </div>
    </div>
</div>

</body>
</html>
