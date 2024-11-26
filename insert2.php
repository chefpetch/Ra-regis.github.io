
<?php
/*
include "connect.php";
$section = $_POST["section"];
$subject_matter = $_POST["category"];
$subject_name= $_POST["subject"];


///echo $section . $category . $subject;

$sql = "INSERT INTO register_info (subject_name, section, subject_matter)
VALUES ($subject_name, $section, $subject_matter)";

//$query = mysqli_query($db_conn, $sql);
if ($sql) { 
  echo 'New data inserted successfully. <a href="./index.html">Go Back</a>';
} else {
  echo "Failed to insert new data.";
}
exit;
*/

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from the form
    $section = isset($_POST["section"]) ? $_POST["section"] : "";
    $category = isset($_POST["category"]) ? $_POST["category"] : "";
    $student = isset($_POST["student"]) ? $_POST["student"] : "";
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";

    // Check if the section already has a record for the student
    $sql_check = "SELECT * FROM register_info WHERE section = '$section' AND student_id = '$student'";
    $result_check = mysqli_query($conn, $sql_check);

    if ($result_check) {
        if (mysqli_num_rows($result_check) > 0) {
            // Update the existing record
            $sql = "UPDATE register_info SET subject_name='$subject', subject_matter='$category' WHERE section='$section' AND student_id='$student'";
        } else {
            // Insert a new record
            $sql = "INSERT INTO register_info (student_id, subject_name, section, subject_matter) VALUES ('$student', '$subject', '$section', '$category')";
        }

        if (mysqli_query($conn, $sql)) {
            echo "Record inserted/updated successfully.<br>";
            header('Location: newdip.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql_check . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>




/*

$section = $_POST["section"];
$subject_matter = $_POST["category"];
$subject_name= $_POST["subject"];
$student= $_POST["student"];
$student1 = 1986;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
*****
$sql2 = "SELECT section from register_info";


$sql = "INSERT INTO register_info (student_id, subject_name, section, subject_matter) 
VALUES ('$student','$subject_name','$section','$subject_matter')";



if (($conn->query($sql)))  {

  header('location:display.php');
  ///echo $student;

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
?>
