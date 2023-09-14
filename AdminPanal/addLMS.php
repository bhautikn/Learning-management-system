<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add LMS</title>
	<style type="text/css">
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
        #Assignment_date_div{
        	display: none;
        }
	</style>
	<?php include("nav.php"); ?>
	<form method="post" enctype="multipart/form-data">
		<div class="inputs-field">
			<div class="file-div">
				<div class="div1" title="Upload LMS">
					<label for="inputTag">
				        <input id="inputTag" type="file" name="LMS" required>
				        <i class="fa fa-file fa-2x"></i>
				    </label>
				</div>
				<div class="div2">
					<span id="imageName"></span>
				</div>
			</div><br>
			<input type="text" class="inputs" name="title" placeholder="title" title="enter title of LMS" required><br><br>
			<textarea placeholder="Comment" cols="50" rows="10" title="Comment show in student's LMS" name="comment"></textarea><br>
			<input type="checkbox" name="assign" id="chkbox"><span class="fonts"> As an Assignment?</span><br><br>
			<div id="Assignment_date_div"><span class="fonts">Last Submit Date : </span><input type="date" name="end_date" id="date_input"><br><br></div>
			<input type="submit" name="Submit" class="inputs btn">
		</div>
	</form>
	<script>
        let input = document.getElementById("inputTag");
        let imageName = document.getElementById("imageName")
        input.addEventListener("change", ()=>{
            let inputImage = document.querySelector("input[type=file]").files[0];
            imageName.innerText = inputImage.name;
        })
        let checkBox = document.getElementById("chkbox");
        checkBox.addEventListener("click", ()=>{
        	let assign_div = document.getElementById("Assignment_date_div");
        	let date_input = document.getElementById("date_input");
        	if (checkBox.checked == true) {
	        	assign_div.style.display = "block";
	        	date_input.setAttribute('required', '');
	        }
	        else {
	        	assign_div.style.display = "none";
	        	date_input.removeAttribute('required');
        	}
        });

    </script>
    <?php
    	if ($_POST['Submit']) {
    		$studentconn = mysqli_connect("db", "kali", "kali", "Student");
    		$sql = "SELECT ID d from subject_LMS ORDER BY ID DESC LIMIT 1";
			$id = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['d'];
			if($id == null ) $id = 0;
			$sql_quary = "SELECT SUBID from faculty WHERE FID=".$_SESSION['FID'].";";
			$SUBID = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary))['SUBID'];
    		$dir = "/LMS/";
    		$file_extantion = strtolower(pathinfo(basename($_FILES['LMS']['name']),PATHINFO_EXTENSION));
    		$file_tmp = $_FILES['LMS']['tmp_name'];
    		$comment = htmlspecialchars($_POST['comment']);
    		$title = htmlspecialchars($_POST['title']);
    		$target_file = $dir .$id.".".$file_extantion;

    		if (empty($_FILES['LMS'])) {
    			echo "<div class='fail'>please select file</div>";
    		}
    		else if (empty($title)) {
    			echo "<div class='fail'>please enter title</div>";
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
				if (isset($_POST['assign'])) {
					if (!isset($_POST['end_date'])) {
    					echo "<div class='fail'>enter last date for assignment</div>";
					}
					else{
						$sql = "INSERT INTO subject_LMS (SUBID,LMS_file, comment, FID, title,is_assign, end_date) VALUES (".$SUBID.",'".$target_file."','".$comment."',".$_SESSION['FID'].",'".$title."','true','".$_POST['end_date']."');";
					}
				}
				else{
					$sql = "INSERT INTO subject_LMS (SUBID,LMS_file, comment, FID, title) VALUES (".$SUBID.",'".$target_file."','".$comment."',".$_SESSION['FID'].",'".$title."');";
				}
				if (move_uploaded_file($file_tmp,"../LMS/".$id.".".$file_extantion) && mysqli_query($studentconn, $sql)) {
    				echo "<div class='sucsess'>file is uploaded sucsessfully</div>";
				}
				else{
    				echo "<div class='fail'>something went wrong</div>";
				}
			}
			mysqli_close($studentconn);
    	}
	?>
</body>
</html>
