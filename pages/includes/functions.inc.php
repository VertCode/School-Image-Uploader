<?php
function emptyInputSignup($username, $mail, $pwd, $pwdRepeat) {
    if (empty($username)) return true;
    if (empty($mail)) return true;
    if (empty($pwd)) return true;
    if (empty($pwdRepeat)) return true;
    return false;
}

function emptyInputLogin($username, $pwd) {
    if (empty($username)) return true;
    if (empty($pwd)) return true;
    return false;
}

function invalidUsername($userName) {
    return preg_match('/^[a-zA-Z0-9]*$/', $userName) ? false : true;
}

function invalidEmail($mail) {
    return filter_var($mail, FILTER_VALIDATE_EMAIL) ? false : true;
}

function pwdMatch($pwd, $pwdRepeat) {
    return $pwd !== $pwdRepeat;
}

function userNameExists($conn, $userName, $mail) {
    $sql = 'SELECT * FROM users WHERE username = ? OR mail = ?;';
    $stm = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stm, $sql)) {
        header("Location: ../signup.php?error=databaseError");
        exit();
    }

    mysqli_stmt_bind_param($stm, "ss", $userName, $mail);
    mysqli_stmt_execute($stm);

    $resultData = mysqli_stmt_get_result($stm);
    $result = mysqli_fetch_assoc($resultData);
    mysqli_stmt_close($stm);

    return $result;
}

function signupUserNameExists($conn, $userName, $mail) {
    return userNameExists($conn, $userName, $mail) ? true : false;
}


function loginUser($conn, $username, $password) {
    $userExists = userNameExists($conn, $username, $username);

    if ($userExists === false) {
        header("Location: ../login.php?error=wrongLogin");
        exit();
    }

    $pwdHashed = $userExists['password'];
    $checkPwd = password_verify($password, $pwdHashed);

    if ($checkPwd === false) {
        header("Location: ../login.php?error=wrongLogin");
        exit();
    }

    session_start();
    $_SESSION['userToken'] = $userExists['userToken'];

    header("Location: ../../index.php?loggedIn=true");
    exit();
}

function tokenExists($conn, $token) {
    $sql = 'SELECT * FROM users WHERE userToken = ?;';
    $stm = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stm, $sql)) {
        echo 'Something went wrong!';
        exit();
    }

    mysqli_stmt_bind_param($stm, "s", $token);
    mysqli_stmt_execute($stm);

    $resultData = mysqli_stmt_get_result($stm);
    $result = mysqli_fetch_assoc($resultData) ? true : false;
    mysqli_stmt_close($stm);
    return $result;
}

function createUser($conn, $userName, $mail, $pwd) {
    $sql = 'INSERT INTO users (userToken, username, mail, password) VALUES (?, ?, ?, ?)';
    $stm = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stm, $sql)) {
        header("Location: ../signup.php?error=databaseError");
        exit();
    }

    $token = guidv4();
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stm, "ssss", $token, $userName, $mail, $pwd);
    mysqli_stmt_execute($stm);
    mysqli_stmt_close($stm);
    header("Location: ../../index.php?signedUp=true");
    exit();
}

function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}