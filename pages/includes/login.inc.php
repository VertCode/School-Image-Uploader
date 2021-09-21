<?php
if (!isset($_POST['submit'])) {
    header("Location: ../login.php");
    exit();
}

$userName = $_POST["username"];
$pwd = $_POST["pwd"];

require_once './dn.inc.php';
require_once './functions.inc.php';


if (emptyInputLogin($userName, $pwd) !== false) {
    header("Location: ../login.php?error=emptyInput");
    exit();
}

loginUser($conn, $userName, $pwd);


