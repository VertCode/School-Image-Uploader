<?php
$phpSelf = $_GET["selfPhP"];
session_start();
session_unset();
session_destroy();
header("Refresh: 0; url=$phpSelf");
exit();