<?php
include('./header.php');
?>

<?php
session_start();
if (!isset($_SESSION['userToken'])) {
    header("Location: ../index.php");
    die();
}
?>

<link rel="stylesheet" href="../pages/css/images.css">
<title>Wesley | Images</title>
<div id="body">
    <?php
    session_start();
    $userToken = $_SESSION['userToken'];
    $files = preg_grep('~\.png$~', scandir('../images'));
    $files = array_filter($files, function ($v, $k) use ($userToken) {
        $fileName = str_replace('.png', '', $v);
        $data = json_decode(file_get_contents('../images/data/' . $fileName . '.json'));
        if ($data->userToken !== $userToken) return false;
        return true;
    }, ARRAY_FILTER_USE_BOTH);

    if (empty($files)) {
        echo "<h1 class='error'>Couldn't find any images.</h1>";
        return;
    }

    echo "<div class='image-container'>";
    echo "<ul>";
    foreach ($files as $file) {
        $fileName = str_replace('.png', '', $file);
        echo "<li><img src='../images/$file' onclick='window.location.href=\"https://wesleybreukers.nl/png/$fileName\"'></li>";
    }
    echo "</ul>";
    echo "</dv>"
    ?>
</div>
