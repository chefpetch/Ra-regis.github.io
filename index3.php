<?php

include 'connect.php';
session_start(); // Add this at the top of your PHP file
include 'inc/conf.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit();
}

// Extract numbers from the email
$student_id = $_SESSION['student_id'];



$checkSec1 = $checkSec2 = $checkSec3 = "";
$showSec1 = $showSec2 = $showSec3 ="none";
$checkC1S1 = $checkC2S1 = $checkC3S1 = $checkC4S1 = "";
$checkC1S2 = $checkC2S2 = $checkC3S2 = $checkC4S2 = "";
$checkC1S3 = $checkC2S3 = $checkC3S3 = $checkC4S3 = "";
$section = $category = $subject = $student = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["section"])){
        $section= $_POST["section"];
    }
    if(!empty($_POST["category"])){
        $category= $_POST["category"];
    }
    if (isset($_POST["subject"]) && !empty($_POST["subject"])) {
        $subject = $_POST["subject"];
    } else {
        $subject="";
    }
    if (isset($_SESSION['student'])) {
        $student = $student_id;
    } else {
        $student = $student_id;
    }
    
    ### SESSION สามารถ เก็บค่าได้โดยค่าจะไม่หายเเละจะหายโดยการ delete session (การเก็บค่าใน sever ) โดยไม่ต้องกลัวค่า หาย เพราะ post ค่าจะหายหลังจาก มี การ refresh หรือเปลี่ยนหน้า
    /*d check value that are already in database

    echo "Section: " . $section . "<br>";
    echo "Category: " . $category . "<br>";
    echo "Subject: " . $subject . "<br>";
    echo "Student: " . $student . "<br>";

    echo "Posted Section: " . $_POST["section"] . "<br>";
    echo "Posted Category: " . $_POST["category"] . "<br>";
    echo "Posted Subject: " . $_POST["subject"] . "<br>";
    
    if (!empty($subject)) {
        $fsql = "SELECT * FROM register_info WHERE subject_name = '$subject'";
        $fresult = mysqli_query($conn, $fsql);

        if ($fresult) {
            $subjectExists = mysqli_num_rows($fresult) > 0;
        } else {
            echo "Error executing query: " . mysqli_error($conn);
            $subjectExists = false;
        }

        if ($subjectExists) {
            echo "Subject already exists";
            $disabled_values[] = $subject;
        } else {
            echo "Subject does not exist";
        }
    }
    */
    if (!empty($disabled_values)) {
        $disabled_values = array_unique($disabled_values);
    }

    if($section=="section_1"){
        $checkSec1 = "checked";
        $showSec1 = "block";
    }
    if($section=="section_2"){
        $checkSec2 = "checked";
        $showSec2 = "block";
    }
    if($section=="section_3"){
        $checkSec3 = "checked";
        $showSec3 = "block";
    }

    if($section=="section_1" && $category=="ดนตรีไทย"){$checkC1S1 = "checked";}
    if($section=="section_1" && $category=="ดนตรีสากล"){$checkC2S1 = "checked";}
    if($section=="section_1" && $category=="พละศึกษา"){$checkC3S1 = "checked";}
    if($section=="section_1" && $category=="ศิลปะ"){$checkC4S1 = "checked";}

    if($section=="section_2" && $category=="ดนตรีไทย"){$checkC1S2 = "checked";}
    if($section=="section_2" && $category=="ดนตรีสากล"){$checkC2S2 = "checked";}
    if($section=="section_2" && $category=="พละศึกษา"){$checkC3S2 = "checked";}
    if($section=="section_2" && $category=="ศิลปะ"){$checkC4S2 = "checked";}

    if($section=="section_3" && $category=="ดนตรีไทย"){$checkC1S3 = "checked";}
    if($section=="section_3" && $category=="ดนตรีสากล"){$checkC2S3 = "checked";}
    if($section=="section_3" && $category=="พละศึกษา"){$checkC3S3 = "checked";}
    if($section=="section_3" && $category=="ศิลปะ"){$checkC4S3 = "checked";}

    /*
    show array of amount of each subject
    if ($conn) {
        $sqal = "SELECT amount, subject_name FROM subject ";
        $resultA = mysqli_query($conn, $sqal);
        $table1A_subjects = array();
        if ($resultA->num_rows > 0) {
            while ($row = $resultA->fetch_assoc()) {
                $tableA_subjects[] = $row['amount'];
            }
        }
        #show amount of each subject
        print_r($tableA_subjects);

    } else {
        echo "Error connecting to the database: " . mysqli_connect_error();
    }
    */       


}

$disabled_subjects = [];
$disabled_categories = [];

// Function to count occurrences in register_info table for subjects
function countSubjectOccurrences($conn, $subject) {
    $sql_count = "SELECT COUNT(*) AS count FROM register_info WHERE subject_matter = '$subject'";
    $result_count = mysqli_query($conn, $sql_count);

    if ($result_count) {
        $row_count = mysqli_fetch_assoc($result_count);
        return $row_count['count'];
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        return 0;
    }
}

// Initialize an array to store disabled values
$disabled_values = [];
// Function to count occurrences of the combination
function countCombinationOccurrences($conn, $student_id) {
    $sql_count = "SELECT COUNT(*) AS count 
                  FROM register_info 
                  WHERE subject_matter IN ('ดนตรีสากล', 'ศิลปะ', 'ดนตรีไทย') 
                  AND student_id = '$student_id'"; // Filter by student_id
    $result_count = mysqli_query($conn, $sql_count);

    if ($result_count) {
        $row_count = mysqli_fetch_assoc($result_count);
        return $row_count['count'];
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        return 0;
    }
}

// Check if combination occurrences exceed 2
$count_combination = countCombinationOccurrences($conn,$student_id);

if ($count_combination >= 2) {
    // Disable radio buttons for 'ดนตรีสากล', 'ศิลปะ', and 'ดนตรีไทย' in all sections  
    $disabled_values = ['ดนตรีสากล', 'ศิลปะ', 'ดนตรีไทย'];
}

$disabled_values1 = [];
// Check if "พละศึกษา" occurs more than twice in register_info
$sql_count = "SELECT COUNT(*) AS count FROM register_info WHERE subject_matter = 'พละศึกษา' AND student_id = $student_id";
$result_count = mysqli_query($conn, $sql_count);

if ($result_count) {
    $row_count = mysqli_fetch_assoc($result_count);
    $count = $row_count['count'];

    // If count is 2 or more, disable the radio button for "พละศึกษา"
    if ($count >= 2) {
        $disabled_values1[] = 'พละศึกษา';
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Ensure unique disabled values
$disabled_values1 = array_unique($disabled_values1);

// Initialize an array to store disabled sections
$disabled_sections = [];

// Function to check if a section is disabled
function isSectionDisabled($conn, $section) {
    $sql_check = "SELECT COUNT(*) AS count FROM register_info WHERE section = '$section'";
    $result_check = mysqli_query($conn, $sql_check);

    if ($result_check) {
        $row = mysqli_fetch_assoc($result_check);
        return $row['count'] > 0; // Return true if section exists
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        return false;
    }
}

// Check each section and disable if it exists in register_info
$sections_to_check = ['section_1', 'section_2', 'section_3'];
foreach ($sections_to_check as $section) {
    if (isSectionDisabled($conn, $section)) {
        $disabled_sections[] = $section;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["section"])) {
        $section = $_POST["section"];
        if ($section == "section_1") {
            $checkSec1 = "checked";
            $showSec1 = "block";
        } elseif ($section == "section_2") {
            $checkSec2 = "checked";
            $showSec2 = "block";
        } elseif ($section == "section_3") {
            $checkSec3 = "checked";
            $showSec3 = "block";
        }
    }
}

// Check each section and disable if it exists in register_info

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles2.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            left: 20px;
            width: 220px;
            height: 140px;
            border-radius: 20px;
            font-size: 2.25rem;
            padding: 1.5rem 3rem;
            margin-right: 30px;
            position: relative;
            top: -35px;
            background-color: #D9D9D9;
            color: #505050;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: background-color 0.3s ease;
            z-index: 10; /* Ensure the button is on top */
            pointer-events: auto; /* Ensure buttons are clickable */
        }
    /* Change color on button click (active state) */
        .btn-custom:active {
            background-color: #FFD097; /* Color when button is clicked */
        }
        .container-custom {
            border-radius: 20px;
            position: relative;
            top: -14rem; /* Adjust this value to move the buttons up */
            padding-left: 20rem; /* Adjust as needed to move buttons to the left */
            display: inline-block; /* Ensure the container itself doesn't stretch */
            width: auto; /* Adjust width as needed */
            margin-bottom: 20px; /* Add spacing between sections */
            
        }
        .d-flex .btn-section {
            margin-right: 20px; /* Space between buttons within a section */
            margin-bottom: 20px; /* Space between sections */
        }
        .align-with-matter {
            position: relative; /* Position relative to its containing block */
            top: 40px; /* Adjust this value to move the button up further */

            transform: translate(-50%, -50%); /* Adjust to center properly */
            z-index: 1; /* Ensure it is above the .matter div */ 
        }
        .h2 {
            font-family: 'kanit', sans-serif;
            position: relative; /* Ensure positioning is relative to its normal position */
            top: -250px; /* Adjust this value to move the button up */
            left: 100px; /* Adjust this value to move the button to the left */
        }
        .category-btn {
            font-family: 'kanit', sans-serif;
            top: 80px;
            border-radius: 20px;
            font-size: 1.75rem; /* Increase font size */
            padding: 1.25rem 2.5rem; /* Increase padding */
            margin-right: 30px; /* Space between buttons */
        }
        .special-btn {
            font-family: 'kanit', sans-serif;
            top: -12rem;
            right: -12rem;
            font-size: 2rem; /* Larger font size for the special button */
            padding: 1.5rem 3rem; /* Larger padding for the special button */
            margin-right: 15px;

        }
        .subject-btn {

            white-space: nowrap; /* Prevent text from wrapping */
            font-family: 'kanit', sans-serif;
            position: relative; /* Ensure it can be moved down */
            top: 80px; /* Move the button down */
            border-radius: 15px;
            display: inline-flex; /* Prevent stretching */
            margin-right: 10px; /* Space between buttons */
            font-size: 1.5rem; /* Adjust font size */
            padding: 1rem 2rem; /* Adjust padding */
            align-items: center;
            background: #FFECC7;
            border: none;
            color: #505050;
        }
        .btn:active {
            background-color: #FFD097; /* Color when button is clicked */
        }
        .subject-container {
            top : 70px;
            border-radius: 20px;
            margin-top: -250px; /* Adjust this value to move higher */
            display: flex;
            align-items: center; /* Center items vertically */
            flex-wrap: wrap; /* Allow wrapping */
            margin-left: 400px; /* Add left margin to move right */
        }
        .btn {
            white-space: nowrap;
        }
        .matter {
            position: absolute;
            top: -180px; /* Adjust to move higher */
            left: 52%; /* Adjust to move more to the left */
            transform: translate(-50%, -50%); /* Adjust to center */
            width: 64%; /* Adjust width to cover more area */
            height: 180%; /* Adjust height to be taller */
            max-height: 120%; /* Ensure it does not exceed the container's height */
            font-family: 'kanit', sans-serif;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background: #FDD998;
            z-index: -1; /* Place behind other elements */
        }
    </style>
    <script src="function.js"></script>
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        window.onload = function() {
            const section = getQueryParam('section');
            document.getElementById('section-display').innerText = section;
            
            const radios = document.querySelectorAll('input[name="section"]');
            radios.forEach(radio => {
                if (radio.value !== section) {
                    radio.disabled = true;
                } else {
                    radio.checked = true;
                }
            });
        }


        function handleRadioChange1(event) {
            document.getElementById('section-display').innerText = event.target.value;
        }
    </script>
</head>
<body>

<form id="form1" action="index3.php" method="post">
    <div id="Section" class="Section d-flex flex-column justify-content-end vh-2000 p-8 mt-5">
    <div class="mb-2">
        <input type="radio" class="btn-check" id="Section1" name="section" value="section_1" <?php echo $checkSec1; ?> onclick="SelectSec()" onchange="handleRadioChange1(event)">
        <label for="Section1" class="btn btn-secondary btn-custom">Section 1</label>
    </div>
    <div class="mb-2">
        <input type="radio" class="btn-check" id="Section2" name="section" value="section_2" <?php echo $checkSec2; ?> onclick="SelectSec()" onchange="handleRadioChange1(event)">
        <label for="Section2" class="btn btn-secondary btn-custom">Section 2</label>
    </div>
    <div class="mb-2">
        <input type="radio" class="btn-check" id="Section3" name="section" value="section_3" <?php echo $checkSec3; ?> onclick="SelectSec()" onchange="handleRadioChange1(event)">
        <label for="Section3" class="btn btn-secondary btn-custom">Section 3</label>
    </div>
</div>
    
    <div class="container-custom" id="ShowSec1" style="display:<?php echo $showSec1; ?>">
   <h2 class = "h2">เลือกวิชา</h2> 
    <div class = "matter"></div>
    <div class="d-flex mb-2 ">
        <div class="mr-2 ">
        <input type="radio" class="btn-check" id="ดนตรีไทย_Sec1" name="category" value="ดนตรีไทย" <?php echo $checkC1S1; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีไทย', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีไทย_Sec1">ดนตรีไทย</label><br></div>

        <div class="mr-2">
            <input type="radio" class="btn-check" id="ดนตรีสากล_Sec1" name="category" value="ดนตรีสากล" <?php echo $checkC2S1; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีสากล', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีสากล_Sec1">ดนตรีสากล</label><br></div>

        <div class="mr-2">
            <input type="radio" class="btn-check" id="พละศึกษา_Sec1" name="category" value="พละศึกษา" <?php echo $checkC3S1; ?> onclick="formSubmit()" <?php if (in_array('พละศึกษา', $disabled_values1)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="พละศึกษา_Sec1">พละศึกษา</label><br></div>

        <div class="mr-2"><input type="radio" class="btn-check" id="ศิลปะ_Sec1" name="category" value="ศิลปะ" <?php echo $checkC4S1; ?> onclick="formSubmit()" <?php if (in_array('ศิลปะ', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ศิลปะ_Sec1">ศิลปะ</label><br></div>
        </div>
    </div>
    </div>
    
    <div class="container-custom" id="ShowSec2" style="display:<?php echo $showSec2; ?>">
    <h2 class = "h2">เลือกวิชา</h2>
    <div class = "matter"></div>
    <div class="d-flex mb-2">
        <div class="mr-2">
        <input type="radio" class="btn-check" id="ดนตรีไทย_Sec2" name="category" value="ดนตรีไทย" <?php echo $checkC1S2; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีไทย', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีไทย_Sec2">ดนตรีไทย</label><br></div>

        <div class="mr-2">
        <input type="radio" class="btn-check" id="ดนตรีสากล_Sec2" name="category" value="ดนตรีสากล" <?php echo $checkC2S2; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีสากล', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีสากล_Sec2">ดนตรีสากล</label><br></div>

        <div class="mr-2">
        <input type="radio" class="btn-check" id="พละศึกษา_Sec2" name="category" value="พละศึกษา" <?php echo $checkC3S2; ?> onclick="formSubmit()" <?php if (in_array('พละศึกษา', $disabled_values1)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="พละศึกษา_Sec2">พละศึกษา</label><br></div>
        
        <div class="mr-2">
        <input type="radio" class="btn-check" id="ศิลปะ_Sec2" name="category" value="ศิลปะ" <?php echo $checkC4S2; ?> onclick="formSubmit()" <?php if (in_array('ศิลปะ', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ศิลปะ_Sec2">ศิลปะ</label><br></div>
        </div>
    </div>
    </div>

    <div class="container-custom" id="ShowSec3" style="display:<?php echo $showSec3; ?>">
    <h2 class = "h2">เลือกวิชา</h2>
    <div class = "matter"></div>
    <div class="d-flex mb-2">
        <div class="mr-2">
        <input type="radio" class="btn-check" id="ดนตรีไทย_Sec3" name="category" value="ดนตรีไทย" <?php echo $checkC1S3; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีไทย', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีไทย_Sec3">ดนตรีไทย</label><br></div>

        <div class="mr-2">
        <input type="radio" class="btn-check" id="ดนตรีสากล_Sec3" name="category" value="ดนตรีสากล" <?php echo $checkC2S3; ?> onclick="formSubmit()" <?php if (in_array('ดนตรีสากล', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ดนตรีสากล_Sec3">ดนตรีสากล</label><br></div>

        <div class="mr-2">
        <input type="radio" class="btn-check" id="พละศึกษา_Sec3" name="category" value="พละศึกษา" <?php echo $checkC3S3; ?> onclick="formSubmit()" <?php if (in_array('พละศึกษา', $disabled_values1)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="พละศึกษา_Sec3">พละศึกษา</label><br></div>

        <div class="mr-2 radiospace">
        <input type="radio" class="btn-check" id="ศิลปะ_Sec3" name="category" value="ศิลปะ" <?php echo $checkC4S3; ?> onclick="formSubmit()" <?php if (in_array('ศิลปะ', $disabled_values)) echo 'disabled'; ?>>
        <label class="btn btn-secondary category-btn special-btn align-with-matter" for="ศิลปะ_Sec3">ศิลปะ</label><br></div>
        </div>
    </div>
    </div>

    <div id="sub" class = "subject-container">
        <?php
      if (!empty($section) && !empty($category)) {
        $con = mysqli_connect("localhost", "root", "", "regis");
    
        if ($con === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    
        // Fetch data from the first table
        $sql1 = "SELECT subject_name FROM subject WHERE $section = '1' AND subject_group = '$category'";
        $result1 = mysqli_query($con, $sql1);
        $table1_subjects = [];
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $table1_subjects[] = $row['subject_name'];
            }
        }
    
        // Fetch data from the second table
        $sql2 = "SELECT subject_name FROM register_info";
        $result2 = mysqli_query($con, $sql2);
        $table2_subjects = [];
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $table2_subjects[] = $row['subject_name'];
            }
        }
        
        // Find differing values
        $diff_values = array_diff($table1_subjects, $table2_subjects);

        
         // Debugging: Print the differing values array (for testing purposes)
         // show result 
         /*
         echo '<pre>';
         print_r($table2_subjects);
         echo '</pre>';

         echo '<pre>';
         print_r($diff_values);
         echo '</pre>';
        */
        // Check if there are differing values
        if (!empty($diff_values)) {
            foreach ($diff_values as $sec2) {
                ?>
                <label class="btn btn-warning subject-btn ">
                    <input type="radio" class="btn-check" name="subject" value="<?= htmlspecialchars($sec2); ?>" <?php if (isset($subject) && $subject == $sec2) { echo "checked"; } ?> onclick="formSubmit()" />
                    <?= htmlspecialchars($sec2); ?>
                </label><br/>
                <?php
            }
        } else {
            echo "No record found";
        }
      }        
        ?>
    </div>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['section'])) {
        $section3 = $_POST['section'];
    }
    if(isset($_POST['category'])) {
        $submatter3 = $_POST['category'];
    }
    if(isset($_POST['subject'])) {
        $sub3 = $_POST['subject'];
    }
}

?>
<form action="insert2.php" method="post">
    <input type="hidden" name="section" value="<?php  echo $section3; ?>">
    <input type="hidden" name="category" value="<?php echo $submatter3; ?>">
    <input type="hidden" name="subject" value="<?php echo $sub3; ?>">
    <input type="hidden" name="student" value="<?php echo $student; ?>">
    <div>
        <input type="submit" class="submit">
    </div>
</form>
</body>
<div class="top-left">
        <div class="img">
            <img src="<?php echo $_SESSION['user_image']; ?>" width="50" />
        </div>
        <div class="name">
            <?php echo $student_id; ?>
        </div>
    </div>
</html>

