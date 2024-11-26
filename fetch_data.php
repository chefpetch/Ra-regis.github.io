<?php
include 'connect.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$section = $_GET['section'];
$sql = "SELECT * FROM register_info WHERE section = '$section'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

mysqli_close($conn);

echo json_encode($data);
?>