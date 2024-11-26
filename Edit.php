<?php
$checkSec1 = $checkSec2 = $checkSec3 = "";
$showSec1 = $showSec2 = $showSec3 ="none";
$checkC1S1 = $checkC2S1 = $checkC3S1 = $checkC4S1 = "";
$checkC1S2 = $checkC2S2 = $checkC3S2 = $checkC4S2 = "";
$checkC1S3 = $checkC2S3 = $checkC3S3 = $checkC4S3 = "";
$sql = "";

if(!empty($_GET['reg_id'])){
    $reg_id= $_GET['reg_id'];
    echo $reg_id.'get';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["reg_id"])){
        $reg_id= $_POST["reg_id"];
        echo $reg_id.'post';
    }
    if(!empty($_POST["section"])){
        $section= $_POST["section"];
    }
    if(!empty($_POST["category"])){
        $category= $_POST["category"];
    }
    if(!empty($_POST["subject"])){
        $subject= $_POST["subject"];
    }else{
        $subject="";
    }

    //echo $section. $category;

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
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test system of web</title>
	<link rel="stylesheet" href="styles2.css">
    <link rel = "stylesheet" href = "css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="function.js"></script>

</head>
<body>
<form id="form1" action="Edit.php" method="post" >
<input type = "hidden" name ="reg_id" value ="<?php echo $reg_id ;?>">

<div id="Section" class="Section">
    <input type="radio" class="btn-check" id="Section1" name="section" value="section_1" <?php echo $checkSec1; ?> onclick="SelectSec()"  >
    	<label class="btn btn-secondary" for="Section1">Section 1</label>

    <input type="radio"  class="btn-check" id="Section2" name="section" value="section_2" <?php echo $checkSec2; ?> onclick="SelectSec()" >
    	<label class="btn btn-secondary" for="Section2">Section 2</label>

    <input type="radio" id="Section3" name="section" value="section_3" <?php echo $checkSec3; ?> onclick="SelectSec()" >
    	<label for="Section3">Section 3</label>
</div>
	

<div class="ShowSec1" id="ShowSec1" style="display:<?php echo $showSec1; ?>">
    <h2>Select Subject Category For Section 1</h2>
    <input type="radio" class="btn-check" id="ดนตรีไทย_Sec1" name="category" value="ดนตรีไทย" <?php echo $checkC1S1; ?> onclick="formSubmit()">
    	<label   for="Category1_Sec1 ">ดนตรีไทย</label><br>

    <input type="radio" id="ดนตรีสากล_Sec1" name="category" value="ดนตรีสากล" <?php echo $checkC2S1; ?> onclick="formSubmit()">
    	<label  for="Category2_Sec1">ดนตรีสากล</label><br>

    <input type="radio" id="พละศึกษา_Sec1" name="category" value="พละศึกษา" <?php echo $checkC3S1; ?> onclick="formSubmit()">
    	<label  for="Category3_Sec1">พละศึกษา</label><br>

    <input type="radio" id="ศิลปะ_Sec1" name="category" value="ศิลปะ" <?php echo $checkC4S1; ?> onclick="formSubmit()">
    	<label  for="Category4_Sec1">ศิลปะ</label><br>
    <hr>
</div>

<div id="ShowSec2" style="display:<?php echo $showSec2; ?>">
    <h2>Select Subject Category For Section 2</h2>
    <input type="radio" id="ดนตรีไทย_Sec2"  autocomplete="off" name="category" value="ดนตรีไทย" <?php echo $checkC1S2; ?> onclick="formSubmit()">
    	<label  for="Category1_Sec2">ดนตรีไทย</label><br>

    <input type="radio" id="ดนตรีสากล_Sec2"  name="category" value="ดนตรีสากล" <?php echo $checkC2S2; ?> onclick="formSubmit()">
    	<label  for="Category2_Sec2">ดนตรีสากล</label><br>

    <input type="radio" id="พละศึกษา_Sec2" name="category" value="พละศึกษา" <?php echo $checkC3S2; ?> onclick="formSubmit()">
    	<label  for="Category3_Sec2">พละศึกษา</label><br>

    <input type="radio" id="ศิลปะ_Sec2"  autocomplete="off" name="category" value="ศิลปะ" <?php echo $checkC4S2; ?> onclick="formSubmit()">
   	 	<label  for="Category4_Sec2">ศิลปะ</label><br>
    <hr>
</div>

<div id="ShowSec3" style="display:<?php echo $showSec3; ?>">
    <h2>Sele_ct Subject Category For Section 3</h2>
    <input type="radio" id="ดนตรีไทย_Sec3" name="category" value="ดนตรีไทย" <?php echo $checkC1S3; ?> onclick="formSubmit()">
    	<label for="Category1_Sec3">ดนตรีไทย</label><br>

    <input type="radio" id="ดนตรีสากล_Sec3" name="category" value="ดนตรีสากล" <?php echo $checkC2S3; ?> onclick="formSubmit()">
    	<label for="Category2_Sec3">ดนตรีสากล</label><br>

    <input type="radio" id="พละศึกษา_Sec3" name="category" value="พละศึกษา" <?php echo $checkC3S3; ?> onclick="formSubmit()">
    	<label for="Category3_Sec3">พละศึกษา</label><br>

    <input type="radio" id="ศิลปะ_Sec3" name="category" value="ศิลปะ" <?php echo $checkC4S3; ?> onclick="formSubmit()">
    	<label for="Category4_Sec3">ศิลปะ</label><br>
    <hr>
</div>

<div id ="sub">
    <?php
        if(!empty($section) && !empty($category)){
            $con = mysqli_connect("localhost", "root", "", "regis");
            $sql = "SELECT subject_name FROM subject WHERE $section = '1' and subject_group = '$category' ";
          
             //echo $sql; check value
            $query_run = mysqli_query($con, $sql);
			
            if(mysqli_num_rows($query_run) > 0 )
            {
                foreach($query_run as $sec2)
                {
                    ?>
                    <input type="radio" name ="subject" value="<?=$sec2['subject_name'];?>" <?php if($subject == $sec2['subject_name']){echo "checked";} ?> onclick="formSubmit()" /> <?=$sec2['subject_name']; ?> <br/>
                    <?php
                }
            }
            else{
                echo "no record found";
            }

            }
    ?>

</div>
</form>
<form action = "update.php"  method="post" >
    <input type = "hidden" name ="reg_id" value ="<?php echo $reg_id ;?>">
    <input type = "hidden" name ="section" value ="<?php echo $section ;?>">
    <input type = "hidden" name ="category" value ="<?php echo $category ;?>">
    <input type = "hidden" name ="subject" value ="<?php echo $subject; ?>">
    
<div>
    <input type="submit" class = "submit" >       
</div>

</form>



</body>
</html>