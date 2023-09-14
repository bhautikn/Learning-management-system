<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Show LMS</title>
	<script>
		function deleteLMS(id) {
			if(confirm("are you sure to delete")){
				window.location.href='?d='+id;
			}
		}
	</script>
	<style type="text/css">
		.fa-trash-can:hover{
			color: red;
		}
		.fa-arrow-left{
			color: var(--light);
			padding: 20px;
		}
		.fa-arrow-left:hover{
			background-color: seagreen;
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
		.right_container .lms_main:hover{
			cursor: pointer;
			box-shadow: 2px 2px 15px black;
			transform: scale(1.01);
		}
		th, td{
			border:1px solid var(--gray);
			color: var(--light);
			margin: 0;
		}
		tr:hover{
			transition-duration: 0.5s;
			background-color: gray;
		}
		table{
			padding: 0px !important;
			margin: 10px;
		}
	</style>
		<?php 
			include("nav.php");
			$studentconn = mysqli_connect("db", "kali", "kali", "Student");
			if (isset($_GET['LMS_id'])) {
				$LMS_id = getValue($_GET['LMS_id']);
				$sql = "
					SELECT subject.sem 
					FROM subject_LMS 
					inner join subject on 
					subject.SUBID = subject_LMS.SUBID
					AND
					subject_LMS.ID = $LMS_id;";
				$semester =  mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['sem'];
				$sql = "SELECT SID,first_name,last_name FROM student where sem = $semester;";
				$result = mysqli_query($studentconn, $sql);
				echo "
					<table cellpadding=\"20px\" cellspacing=\"0\">
						<tr>
							<th>Roll No.</th>
							<th>Name</th>
							<th>Uploaded on</th>
							<th>Assignment file</th>
							<th>Comment</th>
						</tr>
				";
				while($row = mysqli_fetch_assoc($result)){
				$sql = "SELECT Assign_file, comment, submittion_date FROM LMS_student WHERE LMS_id =".$LMS_id." AND SID =".$row['SID'].";";
				$result2 = mysqli_query($studentconn, $sql);
				$row2 = mysqli_fetch_assoc($result2);
					echo "
						<tr>
							<td>".$row['SID']."</td>
							<td>".$row['first_name']." ".$row['last_name']."</td>
						";
					if ($row2) {
						echo "
							<td>".$row2['submittion_date']."</td>
							<td align='center'><a href=\"".$row2['Assign_file']."\" target='_blank'><i class='fa fa-download fa-lg fonts'></i></a></td>
							<td>".$row2['comment']."</td>
						";
					}
					else{
						echo "
							<td>-</td>
							<td>-</td>
							<td>-</td>
						";
					}
					echo "</tr>";
				}
				echo "</table>";

			}
			else{
				if (isset($_GET['d'])) {
					$ID = getValue($_GET['d']);
					$sql = "SELECT LMS_file FROM subject_LMS WHERE ID=".$ID.";";
					$fileName = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['LMS_file'];
					$path = "/var/www/html" . $fileName;
					unlink($path);
					$sql = "DELETE FROM subject_LMS WHERE ID=".$ID.";";
					$assign_sql = "DELETE FROM LMS_student WHERE LMS_id = ".$ID." And FID=".$_SESSION['FID'].";";
					if(mysqli_query($studentconn, $sql) && mysqli_query($studentconn, $assign_sql)){
						echo "<script defer>alert(\"deleted LMS sucsessfully\")</script>";
					}
					else{
						echo "<script defer>alert(\"somthing went wrong\")</script>";
					}
				}
				//------------------------- left div for lms content ---------------------//
				$sql = "SELECT ID, LMS_file, title, comment, view, FID, date FROM subject_LMS where is_assign='false' AND FID=".$_SESSION['FID'].";";
				$result = mysqli_query($studentconn, $sql);
				echo "<div class='left_container'>
				<div class='sucsess'>Content</div>
				";
				while($row = mysqli_fetch_assoc($result)) {
					echo "
				<div class='lms_main'>
					<div class='lms_contain'>
						<div class='lms_contain1'>
							<div class='lms_title'><div title='Title'>".$row['title']."</div></div>
							<div class='faculty'>uploaded on - ".$row['date']."</div>
							<div class='comment' title='Comment'>".$row['comment']."</div>
						</div>
						<div class='lms_contain2'>
							<div><a onclick='deleteLMS(\"".base64_encode(base64_encode($row['ID']))."\");'><i class='fa fa-trash-can fa-2x'></i></a></div>
							<div title='view'><i class='fa fa-eye'></i> ".$row['view']."</div>
						</div>
					</div>
				</div>
					";
				}
				echo "</div>";

				//-------------------------- right div for lms assignment --------------------------//
				$sql = "SELECT ID,LMS_file, title, comment, view, FID, date, end_date FROM subject_LMS where is_assign='true' AND FID=".$_SESSION['FID'].";";
				$result = mysqli_query($studentconn, $sql);
				echo "<div class='right_container'>
				<div class='sucsess'>Assignment</div>
				";	
				while($row = mysqli_fetch_assoc($result)) {
				$LMS_id = base64_encode(base64_encode($row['ID']));
					echo "
				<div class='lms_main'>
					<div class='lms_contain'>
						<div class='lms_contain1'>
							<div class='lms_title'><div title='Title'>".$row['title']."</div></div>
							<div class='faculty'>uploaded on<br>".$row['date']." - ".$row['end_date']."</div>
							<div style='float:left;' class='comment' title='Comment'>".$row['comment']."</div>
						</div>
						<div class='lms_contain2'>
							<div><a onclick='deleteLMS(\"".base64_encode(base64_encode($row['ID']))."\");'><i class='fa fa-trash-can fa-2x'></i></a></div>
							<div title='view'><a href=\"LMSshow.php?LMS_id=".$LMS_id."\"><i class='fa fa-eye'></i> Deatil</a></div>
						</div>
					</div>
				</div>
					";
				}
				echo "</div>";
			}
			mysqli_close($studentconn);
		?>
</body>
</html>