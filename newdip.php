<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
include 'inc/conf.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit();
}

echo '<div class="img"><img src="' . $_SESSION["user_image"] . '" width="50" /></div>';
echo '<div class="name">' . $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname'];
$email = $_SESSION['user_email'];
$student_id = $_SESSION['student_id'] = preg_replace('/\D/', '', $email);
echo "<br>".$student_id;   
echo '<br><div class="signout-container"><a href="signout.php" class="signout-button"><b>Sign out</b></a></div></div>';
echo "</div>";
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections with Forms</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .user-info {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #ffffff;
            text-align: center;
        }
        .user-info .img img {
            border-radius: 50%;
        }
        .signout-container {
            margin-top: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .signout-button {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #d9534f;
            color: #ffffff;
            text-decoration: none;
        }
        .section {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .section h2 {
            margin: 0;
            font-size: 1.5em;
        }
        .section p {
            margin: 5px 0;
        }
        .section img {
            width: 40px;
            height: 40px;
        }
        .section button {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #ffffff;
            color: #505050;
        }
        .section-registered {
            background-color: #85A392;
            color: #ffffff;
        }
        .section-unregistered {
            background-color: #D9D9D9;
            color: #000000;
        }
        .section-registered h2,
        .section-registered p,
        .section-unregistered h2,
        .section-unregistered p {
            color: inherit;
        }
        
    </style>
</head>
<body>
<?php
include 'connect.php';

$sections = ['section_1', 'section_2', 'section_3'];
$data = [];
foreach ($sections as $section) {
    $sql = "SELECT * FROM register_info WHERE section = '$section' AND student_id = '$student_id'" ;
    $result = mysqli_query($conn, $sql);
    $data[$section] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
}

mysqli_close($conn);
?>
    <div class="section <?php echo !empty($data['section_1']) ? 'section-registered' : 'section-unregistered'; ?>">
        <div>
            <h2>Section 1</h2>
            <p>
                <?php 
                if (!empty($data['section_1'])) {
                    echo $data['section_1'][0]['subject_matter'] . "<br>" . $data['section_1'][0]['subject_name'];
                } else {
                    echo "ยังไม่ได้ลงทะเบียน";
                }
                ?>
            </p>
        </div>
        <button onclick="goToForm('section_1', '<?php echo !empty($data['section_1']) ? 'update' : 'new'; ?>')">เปลี่ยน</button>
    </div>
    <div class="section <?php echo !empty($data['section_2']) ? 'section-registered' : 'section-unregistered'; ?>">
        <div>
            <h2>Section 2</h2>
            <p>
                <?php 
                if (!empty($data['section_2'])) {
                    echo $data['section_2'][0]['subject_matter'] . "<br>" . $data['section_2'][0]['subject_name'];
                } else {
                    echo "ยังไม่ได้ลงทะเบียน";
                }
                ?>
            </p>
        </div>
        <button onclick="goToForm('section_2', '<?php echo !empty($data['section_2']) ? 'update' : 'new'; ?>')">เปลี่ยน</button>
    </div>
    <div class="section <?php echo !empty($data['section_3']) ? 'section-registered' : 'section-unregistered'; ?>">
        <div>
            <h2>Section 3</h2>
            <p>
                <?php 
                if (!empty($data['section_3'])) {
                    echo $data['section_3'][0]['subject_matter'] . "<br>" . $data['section_3'][0]['subject_name'];
                } else {
                    echo "ยังไม่ได้ลงทะเบียน";
                }
                ?>
            </p>
        </div>
        <button onclick="goToForm('section_3', '<?php echo !empty($data['section_3']) ? 'update' : 'new'; ?>')">เปลี่ยน</button>
    </div>
    <script>
        function goToForm(section, action) {
            location.href = 'index3.php?section=' + section + '&action=' + action;
        }
    </script>
</body>
</html>
