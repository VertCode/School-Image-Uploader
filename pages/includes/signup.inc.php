<?php
if (!isset($_POST['submit'])) {
    header("Location: ../signup.php");
    exit();
}
$userName = $_POST["username"];
$mail = $_POST["mail"];
$pwd = $_POST["pwd"];
$pwdRepeat = $_POST["pwdRepeat"];

require_once './dn.inc.php';
require_once './functions.inc.php';

if (emptyInputSignup($userName, $mail, $pwd, $pwdRepeat) !== false) {
    header("Location: ../signup.php?error=emptyInput");
    exit();
}
if (invalidUsername($userName) !== false) {
    header("Location: ../signup.php?error=invalidUserName");
    exit();
}
if (invalidEmail($mail) !== false) {
    header("Location: ../signup.php?error=invalidEmail");
    exit();
}
if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("Location: ../signup.php?error=pwdDontMatch");
    exit();
}

if (signupUserNameExists($conn, $userName, $mail) !== false) {
    header("Location: ../signup.php?error=userNameTaken");
    exit();
}

createUser($conn, $userName, $mail, $pwd);

