<?php

// Empty input check
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        return true;
    }
    return false;
}

// Invalid username (only letters + numbers)
function invalidUid($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        return true;
    }
    return false;
}

// Invalid email check
function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

// Password match
function pwdMatch($pwd, $pwdRepeat){
    if($pwd !== $pwdRepeat){
        return true;
    }
    return false;
}

// Check username OR email already exists
function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE username=? OR email=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

// Create user
function createUser($conn, $name, $email, $username, $pwd){
    $sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("Location: ../signup.php?error=none");
    exit();
}
