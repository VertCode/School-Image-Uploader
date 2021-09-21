<?php
$dbHost = "51.79.21.101";
$dbUserName = "mc";
$dbPassword = "f29kAsDX8xYcYne4Fyazz5mVkAK2j7ArR3dEYrLDdGKdpdHxJKEHKtNJz69vyYYQGnHFfbP8pjLfk7FuV8qVD7cwtfu8rFtsJYmtajbWFHLxwxRLnj4SpQz2bjUAuQS5";
$dbDatabase = "vert-school";

$conn = mysqli_connect($dbHost, $dbUserName, $dbPassword, $dbDatabase);

if (!$conn) {
    die("Couldn't connect to the database.\n".mysqli_connect_error());
}