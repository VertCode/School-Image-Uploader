<?php
$config = parse_ini_file('config.ini');
$secret_key = $config['secret_key']; //Set this as your secret key, to prevent others uploading to your server.
$sharexdir = $config['image_folder'] . '/'; //This is your file dir, also the link..
$domain_url = $config['url'];
$lengthofstring = $config['length_of_image_name']; //Length of the file name

require_once './pages/includes/dn.inc.php';
require_once './pages/includes/functions.inc.php';

function RandomString($length) {
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

if (!isset($_POST['secret']) || !isset($_POST['content'])) {
    echo 'No post data recieved';
    return;
}
if ($_POST['secret'] != $secret_key || !isset($_POST['userToken'])) {
    echo 'Invalid Secret Key/User Token';
    return;
}

$userToken = $_POST['userToken'];
$application = explode("_SPLIT_", $_POST['content'])[0];

if (!$application) {
    echo 'Invalid content';
    return;
}

$existsInDb = true;
if (!tokenExists($conn, $userToken)) {
    echo 'Cannot find token!';
    return;
}

if (!$existsInDb) {
    echo 'Cannot find User with that usertoken!';
    return;
}


$filename = RandomString($lengthofstring);
$target_file = $_FILES["sharex"]["name"];
$fileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (move_uploaded_file($_FILES["sharex"]["tmp_name"], $sharexdir . $filename . '.' . $fileType)) {
    echo $domain_url . '/' . $fileType . '/' . $filename;

    $imageData = array(
        "userToken" => $userToken,
        "application" => str_replace('_', ' ', $application),
        "isPublic" => true
    );
    $imageDataJSON = json_encode($imageData);
    $dataFile = fopen($sharexdir.'data/'.$filename.'.json', "w");
    fwrite($dataFile, $imageDataJSON);
    fclose($dataFile);
    return;
} else {
    echo 'File upload failed - CHMOD/Folder doesn\'t exist?';
    return;
}
?>