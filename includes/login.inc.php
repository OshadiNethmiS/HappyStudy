<?php
if(isset($_POST["submit"])){

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Check if user exists
    $userExists = uidExists($conn, $username, $username);

    if($userExists === false){
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $userExists["id"];
        $_SESSION["username"] = $userExists["username"];
        header("Location: ../welcome.php");
        exit();
    }

}
else{
    header("Location: ../login.php");
    exit();
}
?>
