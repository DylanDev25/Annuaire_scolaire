<?php
$servername = "localhost";
$username = "dylan";
$password = "DylanMaurcot345@";
$dbname = "school_directory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
