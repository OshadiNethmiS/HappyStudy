<?php
session_start(); // 1. Start Session at the very top

$showError = "";
$showSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $passwordRepeat = trim($_POST["passwordrepeat"]);

    // Password check
    if ($password !== $passwordRepeat) {
        $showError = "Passwords do not match!";
    } else {

        // DB connection
        $conn = mysqli_connect("localhost", "root", "", "happystudy_login");

        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        // Hash password
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        // Insert query (MATCH DATABASE COLUMN NAMES)
        $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, isAdmin)
                VALUES ('$name', '$email', '$username', '$hashedPwd', 0)";

        if (mysqli_query($conn, $sql)) {
            // 2. AUTO-LOGIN LOGIC (Session Handling)
            // Get the ID of the user we just created
            $newUserId = mysqli_insert_id($conn); 

            // Save details to session so they are "Logged In"
            $_SESSION["user_id"] = $newUserId; 
            $_SESSION["username"] = $username;
            $_SESSION["isAdmin"] = 0; // Default to student

            // Redirect immediately to Course page
            header("Location: Course.php");
            exit();
            
        } else {
            $showError = "Registration Failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HappyStudy | Register</title>
    <style>
        body {
            background: #eef6fcff;
            font-family: Arial;
        }
        .container {
            width: 900px;
            margin: auto;
            background: #fff;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 40px;
        }
        .left {
            width: 50%;
            padding: 80px 30px;
            text-align: center;
            background: linear-gradient(#d0eaff, #a7d4f2);
        }
        .left h1 {
            font-size: 60px;
            color: #11004d;
        }
        .left p {
            font-size: 20px;
            color: #11004d;
        }
        .right {
            width: 50%;
            padding: 60px 40px;
        }
        .right h2 {
            text-align: center;
            color: #11004d;
             font-size: 30px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 18px;
            border-radius: 8px;
            border: 1px solid #bbb;
            font-size: 16px;
        }
        .btn {
            width: 100%;
            margin-top: 30px;
            padding: 12px;
            background: #11004d;
            border: none;
            border-radius: 25px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
        .msg {
            text-align: center;
            margin-top: 15px;
            font-size: 18px;
            color: red;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 18px;
        }
        .register-link a {
            color: #11004d;
            font-weight: bold;
        }

        .success {
            color: green;
        }
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

        <?php
        if ($showError != "") echo "<div class='msg'>$showError</div>";
        ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="passwordrepeat" placeholder="Repeat Password" required>

            <button type="submit" class="btn">Register</button>
        </form>

         <div class="register-link">
            Are you Registered..? <br>
            <a href="login.php">Login</a>
        </div>
    </div>

</div>

</body>
</html>