<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username_email = trim($_POST["username_email"]);
    $password = trim($_POST["password"]);

    // DB connect
    $conn = mysqli_connect("localhost", "root", "", "happystudy_login");

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Check user by username or email
    $sql = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // Password check (not hashed version)
        if ($row["password"] == $password) {

            $_SESSION["username"] = $row["username"];
            header("Location: home.php"); // redirect after login
            exit();

        } else {
            $error = "Incorrect Password!";
        }

    } else {
        $error = "User Not Found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HappyStudy Login</title>

    <style>
        body {
            background: #eef6fcff;
            font-family: Arial;
        }
        .container {
            width: 900px;
            margin: auto;
            background: white;
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
            margin-bottom: 30px;
        }
        .left p {
            font-size: 20px;
            color: #11004d;
        }
        .left button {
            margin-top: 40px;
            padding: 12px 35px;
            background: #0a9b2f;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 18px;
            cursor: pointer;
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
            border-radius: 8px;
            border: 1px solid #bbb;
            margin-top: 18px;
            font-size: 16px;
        }
        .btn {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            background: #11004d;
            border: none;
            border-radius: 25px;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        .msg {
            margin-top: 10px;
            text-align: center;
            color: red;
            font-size: 18px;
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
            if ($error != "") {
                echo "<div class='msg'>$error</div>";
            }
        ?>

        <form method="POST">
            <label>User Name</label>
            <input type="text" name="username_email" placeholder="Name/Email" required> <br>

            <label>PassWord</label>
            <input type="password" name="password" placeholder="Password" required> 

            <button class="btn">Login</button>
        </form>

        <div class="register-link">
            New Here..? <br>
            <a href="Signup.php">Register</a>
        </div>
    </div>

</div>

</body>
</html>
