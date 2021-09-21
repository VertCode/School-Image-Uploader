<?php
include('./header.php');
?>
<html>

<link rel="stylesheet" href="./css/login.css">
<div id="body">
    <div class="form" id="login">
        <form action="./includes/login.inc.php" method="post">
            <h3>Username</h3>
            <input type="text" name="username">
            <h3>Password</h3>
            <input type="password" name="pwd">

            <?php
            if (!isset($_GET["error"])) echo "<h4>Dont have a account yet? <a class='link' href='./signup.php'>click here</a></h4>";
            else if ($_GET["error"] == "emptyInput") echo "<h4 class='error'>Please fill in all fields!</h4>";
            else if ($_GET["error"] == "wrongLogin") echo "<h4 class='error'>Please fill in a username & password!</h4>";
            ?>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</div>
</html>
