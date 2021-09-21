<?php
include('./header.php');
?>
<html>
<head>
    <link rel="stylesheet" href="./css/register.css">
</head>
<div id="body">
    <div class="form">
        <form action="./includes/signup.inc.php" method="post">
            <h3>Username</h3>
            <input type="text" name="username">
            <h3>Email</h3>
            <input type="email" name="mail">
            <h3>Password</h3>
            <input type="password" name="pwd">
            <h3>Repeat Password</h3>
            <input type="password" name="pwdRepeat">

            <?php
            if (!isset($_GET["error"])) echo "<h4>Already have a account?  <a class='link' href='./login.php'>click here</a></h4>";
            else if ($_GET["error"] == "emptyInput") echo "<h4 class='error'>Please fill in all fields!</h4>";
            else if ($_GET["error"] == "invalidUserName") echo "<h4 class='error'>Please fill in a valid username.</h4>";
            else if ($_GET["error"] == "invalidEmail") echo "<h4 class='error'>Please fill in a valid email.</h4>";
            else if ($_GET["error"] == "pwdDontMatch") echo "<h4 class='error'>Please match your passwords.</h4>";
            else if ($_GET["error"] == "userNameTaken") echo "<h4 class='error'>This username/email already exists.</h4>";
            else if ($_GET["error"] == "databaseError") echo "<h4 class='error'>Something went wrong in the database!</h4>";
            ?>
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
</div>
</html>
