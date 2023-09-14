<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['SID'] == null) header("location: /");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LMS</title>
	<style type="text/css">
		.LMS-content-outer-div{
			width: fit-content;
			margin: 0 auto;
		}
		.content{
			height: 300px;
			background-color: seagreen;
			margin: 20px;
			width: 300px;
			float: left;
			cursor: pointer;
			border-radius: 5px;

		}
		.content div{
			background-color: red;
			height: 20%;
			width: 100%;
			color: dodgerblue;
			padding:4px 0;
			text-align: center;
			line-height: 25px;
			font-size: 1.2em;
			background-color: rgba(65, 105, 225, 0.2);
			border-radius: 7px;
			font-weight: bold;
		}
		.content img{
			width: 100%;
			opacity: 0.7;
			border-radius: 5px;
		}
		.content img:hover{
			opacity: 0.3;
			transition-duration: 0.5s;
		}
		.navigation h{
			text-align: left;
		}
		.left_container{
			background-color: rgba(0, 0, 0, 0.09); 
			width: 50%;
			float: left;
		}
		.right_container{
			width: 50%;
			float: left;
		}

		/* form css start */
		.inputs-field{
			margin: 20px;
			display: block;
			width: max-content;
			margin-left: auto;
			margin-right: auto;
			box-shadow: 2px 2px 15px black;
			padding: 20px;
		}
		.file-div{
			border: 2px solid var(--gray);
			height: 50px;
			width: 100%;
		}
		.file-div div{
			float: left;
		}
		.file-div .div1{
			height: 100%;
			width: 50px;
			border:2px solid var(--gray);
			display: flex;
			padding: 2.5%;
			text-align: center;
			align-items: center;
		}
		.file-div .div2{
			height: 100%;
			width: calc(100% - 50px);
			border: 2px solid var(--gray);
			text-align: center;
			font-size: 1.2em;
			font-weight: 700;
			color: var(--green);
		}
		.inputs-field textarea{
			margin: 10px 0;
			background-color: var(--dark);
			border: 1px solid var(--gray);
			color: var(--light);
		}
        input[type=file]{
        	display: none;
        }
        label{
        	cursor:pointer;
        	color: var(--light);
        }
        /* form css end*/
	</style>
	<?php
		include("nav.php");
		$studentconn = mysqli_connect("db", "kali", "kali", "Student");
		if ($_POST['Submit']) {

			//-------------------------- Get Data ----------------------------------//
    		$LMS_id = getValue($_POST['LMS_ID']);
    		$file_tmp = $_FILES['LMS']['tmp_name'];
    		$dir = "/Assign_LMS/";
    		$sql = "SELECT ID d from LMS_student ORDER BY ID DESC LIMIT 1";
			$file_id = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['d'];
			if($file_id == null ) $file_id = 0;
    		$file_extantion = strtolower(pathinfo(basename($_FILES['LMS']['name']),PATHINFO_EXTENSION));
			$target_file = $dir .$file_id.".".$file_extantion;

			//-------------------------- varyfication -----------------------------//
    		if (empty($_FILES['LMS'])) {
    			echo "<div class='fail'>please select file</div>";
    		}
    		else if($file_extantion != "ppt" && $file_extantion != "pdf" && !$file_extantion && $file_extantion != "jpg" && $file_extantion != "png" && $file_extantion != "jpeg"){
    			echo "<div class='fail'>file type is not allowed</div>";
    		}
    		else if($_FILES["LMS"]["size"] > 20000000) {
    			echo "<div class='fail'>file is biger then 20MB</div>";
    		}
    		else if (file_exists($target_file)) {
    			echo "<div class='fail'>file is already exists</div>";
			}
			else{
				$sql = "INSERT INTO LMS_student (LMS_ID ,SID, comment, Assign_file) VALUES (".$LMS_id.",".$_SESSION['SID'].",'".$_POST['comment']."','".$target_file."');";
				if (move_uploaded_file($file_tmp,"../Assign_LMS/".$file_id.".".$file_extantion) && mysqli_query($studentconn, $sql)) {
    				echo "
    					<script>
    						alert(\"Assignment sucsessfully uploaded\");
    						window.location.href = '/StudentPanal/LMS.php';
    					</script>
    				";
				}
				else{
    				echo "<div class='fail'>something went wrong</div>";
				}
			}
			
		}
		else if(isset($_GET['Upload']) && isset($_GET['id']) && isset($_GET['SID'])) {
			 
			//-------------------------- Get Data ----------------------------------//
			$LMS_id = getValue($_GET['id']);
			$SUBID = getValue($_GET['SID']);
			$sql = "SELECT name from subject WHERE SUBID = ".$SUBID.";";
			$subject_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['name'];

			//----------------------------- echo Nav -------------------------------//
			
			navigationDiv($subject_name . " - Assignment");

			//--------------------------- echo form ------------------------------//
			echo "
				<form method='post' enctype='multipart/form-data'>
					<input type='hidden' value='".$_GET['id']."' name='LMS_ID'>
					<div class='inputs-field'>
						<div class='file-div'>
							<div class='div1' title='Upload LMS'>
								<label for='inputTag'>
							        <input id='inputTag' type='file' name='LMS' required>
							        <i class='fa fa-file fa-2x'></i>
							    </label>
							</div>
							<div class='div2'>
								<span id='imageName'></span>
							</div>
						</div><br>
						<textarea placeholder='Comment' cols='50' rows='10' title=\"Comment show in student's LMS\" name='comment'></textarea><br>
						<input type='submit' name='Submit' class='inputs btn'>
					</div>
				</form>
			";
			//-------------------------------- echo script -------------------------//
			echo "
				<script>
			        let input = document.getElementById(\"inputTag\");
			        let imageName = document.getElementById(\"imageName\")
			        input.addEventListener(\"change\", ()=>{
			            let inputImage = document.querySelector(\"input[type=file]\").files[0];
			            imageName.innerText = inputImage.name;
			        })
				</script>
			";
		}

		else if (isset($_GET['SID']) && !isset($_GET['Upload'])) {

			//------------------------------ Get Data ----------------------------------//
			$SUBID = getValue($_GET['SID']);
			$sql = "SELECT name from subject WHERE SUBID = ".$SUBID.";";
			$subject_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['name'];

			//------------------------------- echo nav --------------------------------//
			
			navigationDiv($subject_name);

			//------------------------- left div for lms content ---------------------//
			$sql = "SELECT ID, LMS_file, title, comment, view, FID, date from subject_LMS where SUBID =".$SUBID." AND is_assign='false';";
			$result = mysqli_query($studentconn, $sql);
			echo "
				<div class='left_container'>
					<div class='sucsess'>Content
				</div>
			";
			while($row = mysqli_fetch_assoc($result)) {
			$sql = "SELECT first_name from faculty where FID =".$row['FID'].";";
			$first_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['first_name'];
			echo "
				<div class='lms_main'>
					<div class='lms_contain'>
						<div class='lms_contain1'>
							<div class='lms_title'><div title='Title'>".$row['title']."</div></div>
							<div class='faculty'>uploaded by - ".$first_name."<br>on - ".$row['date']."</div>
							<div class='comment' title='Comment'>".$row['comment']."</div>
						</div>
						<div class='lms_contain2'>
							<div><a title='Downloads' href='GetLMS.php?ID=".base64_encode(base64_encode($row['ID']))."' target='_blank'><i class='fa fa-download fa-2x'></i></a></div>
							<div title='view'><i class='fa fa-eye'></i> ".$row['view']."</div>
						</div>
					</div>
				</div>
				";
			}
			echo "</div>";

			//-------------------------- right div for lms assignment -------------------------//
			$sql = "SELECT ID,LMS_file, title, comment, view, FID, date, end_date from subject_LMS where SUBID =".$SUBID." AND is_assign='true';";
			$result = mysqli_query($studentconn, $sql);
			// echo $result;
			// if ($result ) {
			// 	echo "<div class='fail'>No content found</div>";
			// }
			echo "
				<div class='right_container'>
					<div class='sucsess'>Assignment
				</div>
			";	
			while($row = mysqli_fetch_assoc($result)) {
			$LMS_id = base64_encode(base64_encode($row['ID']));

			echo "
			<div class='lms_main'>
				<div class='lms_contain'>
					<div class='lms_contain1'>
						<div class='lms_title'><div title='Title'>".$row['title']."</div></div>
					";
			$sql = "SELECT first_name from faculty where FID =".$row['FID'].";";
			$first_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['first_name'];
			$sql2 = "
				SELECT submittion_date FROM LMS_student 
				WHERE SID = ".$_SESSION['SID']."
				AND LMS_ID=".$row['ID'].";";
			$sql2_result = mysqli_fetch_assoc(mysqli_query($studentconn, $sql2))['submittion_date'];
			echo "
						<div class='faculty'>uploaded by - ".$first_name."<br>on ".$row['date']." to ".$row['end_date']."</div>
						<div style='float:left;' class='comment' title='Comment'>".$row['comment']."</div>
				";
			if ($sql2_result) { //if assignnment is alrady uploded
					echo "
							<div class='input_div' title='Assignment uploaded'>
								<a><i class='fa fa-check fa-lg'></i></a>
							</div>
						";
			}
			else{
				echo "
							<div class='input_div' title='Upload Assignment'>
								<a href='LMS.php?Upload=Assignment&id=".$LMS_id."&SID=".$_GET['SID']."'><i class='fa fa-upload fa-lg'></i></a>
							</div>
				";
			}	
					echo "
					</div>
					<div class='lms_contain2'>
						<div><a title='Downloads' href='GetLMS.php?ID=".base64_encode(base64_encode($row['ID']))."' target='_blank'><i class='fa fa-download fa-2x'></i></a></div>
						<div title='view'><i class='fa fa-eye'></i> ".$row['view']."</div>
					</div>
				</div>
			</div>
				";
			}
			echo "</div>";
		}
		else {

			//--------------------------- Get Data ------------------------------//

			$sql = "SELECT sem from student where SID =".$_SESSION['SID'].";";
			$sem = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['sem'];
			$sql = "SELECT SUBID,subject_code,name,img from subject where sem=".$sem.";";
			$result = mysqli_query($studentconn, $sql);

			//---------------------------- Echo Nav --------------------------------//
			
			navigationDiv("LMS (Lerning Management System)");

			//-------------------------- Echo all Subject --------------------------//
			echo "<div class=\"LMS-content-outer-div\">";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<div class='content'>
					<img src='".$row['img']."' onclick=\"window.location.href='LMS.php?SID=".base64_encode(base64_encode($row['SUBID']))."';\">
					<div>".$row['subject_code']."<br>".$row['name']."</div>
				</div>\n\t";
			}
			echo "</div>";		
		}
		mysqli_close($studentconn);
	?>
</body>
</html>