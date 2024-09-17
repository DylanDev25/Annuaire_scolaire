<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM schools WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: view_school.php");
} else {
    echo "Erreur lors de la suppression : " . $conn->error;
}
?>
