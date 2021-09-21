<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../pages/css/general.css"/>
    <script>
        function copyToClipboard(text) {
            var input = document.body.appendChild(document.createElement("input"));
            input.value = text;
            input.focus();
            input.select();
            document.execCommand('copy');
            input.parentNode.removeChild(input);
        }
    </script>
</head>

<div id="nav">
    <div class="nav-left">
        <div class="nav-logo">
            <img src="https://vertcode.eu/logo%27s/VertCode-Logo.png" alt="VertCode">
        </div>
        <div class="nav-item-container">
            <div class="nav-item"><a href="../index.php">Home</a></div>
            <?php
            session_start();
            if (isset($_SESSION['userToken'])) {
                $token = $_SESSION['userToken'];
                echo '<div class="nav-item"><a href="../pages/images.php">Images</a></div>';
                echo '<div class="nav-item"><a href="#" onclick="copyToClipboard(\''.$token.'\')">Copy Token</a></div>';
            }
            ?>
        </div>
    </div>
    <?php
    $self = $_SERVER['PHP_SELF'];
    if (isset($_SESSION['userToken'])) echo "<div class='nav-right'><div class='nav-item'><a href='../pages/includes/logout.inc.php?selfPhP=$self'>Logout</a></div></div>";
    else echo "<div class='nav-right'><div class='nav-item'><a href='../pages/login.php'>Login</a></div></div>";
    ?>
</div>
