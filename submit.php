<?php
include 'connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$section = $_POST['section'];

// Check if the section already has a record
$sql = "SELECT * FROM tests WHERE section = '$section'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Update the existing record
    $sql = "UPDATE tests SET name='$name', email='$email' WHERE section='$section'";
} else {
    // Insert a new record
    $sql = "INSERT INTO tests (name, email, section) VALUES ('$name', '$email', '$section')";
}

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: newdip.php");
exit;
?>