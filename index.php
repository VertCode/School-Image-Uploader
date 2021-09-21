<?php

date_default_timezone_set("Europe/Amsterdam");

$config = parse_ini_file('config.ini');
$image_dir = $config['image_folder'];
$favicon = $config['favicon'];
$title = $config['site_title'];

$url = 'https://' . $_SERVER['HTTP_HOST'];
$path = explode("/", $_SERVER['REQUEST_URI']);
$file_id = $path[2];
$file_type = $path[1];
$image_local = $image_dir . '/' . $file_id . '.' . $file_type;
$image = $url . '/' . $image_dir . '/' . $file_id . '.' . $file_type;
$upload_date = date("F j, Y, g:i a", filemtime($image_local));
include('pages/image-page.php');
include('pages/header.php');


if ($file_id == null || !is_file($image_local)) {
    echo "<title>Wesley | Home</title>";
    include('pages/home.php');
    return;
}

$dataFileLoc = $image_dir.'/data/'.$file_id.'.json';
$dataFile = fopen($dataFileLoc, "r");
$data = json_decode(fread($dataFile, filesize($dataFileLoc)));
fclose($dataFile);
$app = $data->application;

initImagePage($upload_date, $url, $image, $app);

?>
