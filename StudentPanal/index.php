<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['SID'] == null) header("location: /");

	$user_name = $_SESSION['user_name'];
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$sql_quary = "SELECT * from student WHERE SID = ".$_SESSION['SID'].";";
	$student_res = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary));
	mysqli_close($studentconn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dash Bord</title>
	<style>
		.notification-field{
			margin: 40px;
			height: 45vh;
			border-radius: 1px solid var(--gray);
			overflow-y: scroll;
		}
		.notification-field .notification-title{
			background-color: rgba(0, 0, 0, 0.3);
			padding: 4px;
			color: var(--light);
			font-weight: bold;
			font-size: 1.2em;
		}
		.notification-outer-div{
			height: 50px;
			border-radius: 10px;
			background-color: rgba(65, 105, 225, 0.2);
			color: dodgerblue;
			font-weight: bold;
			padding: 15px;
			margin: 10px 0;
		}
		.notification-outer-div > div{ float: left; }
		.notification-outer-div .content{ width: 95%; }
		.notification-outer-div .action{ width: 5%; }
		.fa-download, .fa-upload {color: dodgerblue;}
	</style>
	<?php include("nav.php");?>
	<div class="most-outer-div">
		<div class="left-div-img">
			<img src="<?php echo $student_res['avatar'];?>">
		</div>
		<div class="right-div-content">
			<div title="Name">Name : <?php echo $student_res['first_name'] ." ". $student_res['last_name'] ;?></div>
			<div title="Sem">Sem : <?php echo $student_res['sem'] ." - ".$student_res['class'];?></div>
			<div title="Mobile No.">Mobile No : <?php echo $student_res['mobile_no'];?></div>
			<div title="Parent Mo">Parent Mo : <?php echo $student_res['parent_mobile_no'];?></div>
			<div title="Email">Email : <?php echo $student_res['email'];?></div>
			<div title="Gender">Gender : <?php echo $student_res['gender'];?></div>
		</div>
	</div>
	<?php
		$studentconn = mysqli_connect("db", "kali", "kali", "Student");
		$sql_quary = "SELECT ID, FID,LMS_file, subject.SUBID, is_assign,title from subject_LMS inner join subject on subject.SUBID=subject_LMS.SUBID where sem=".$student_res['sem'].";";
		$res = mysqli_query($studentconn, $sql_quary);
		echo "
				<fieldset class=\"notification-field\">
			 		<legend class=\"notification-title\">Notification</legend>
		";
		while ($res1 = mysqli_fetch_assoc($res)) {
			$sql = "SELECT first_name from faculty where FID =".$res1['FID'].";";
			$faculty = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['first_name'];
			$sql2 = "
				SELECT submittion_date FROM LMS_student 
				WHERE SID = ".$_SESSION['SID']."
				AND LMS_ID=".$res1['ID'].";";
			$sql2_result = mysqli_fetch_assoc(mysqli_query($studentconn, $sql2))['submittion_date'];
			if(empty($sql2_result)){
				echo "
						<div class=\"notification-outer-div\">
				 			<div class=\"content\">
				";
				if ($res1['is_assign']=='true') {
					echo "
						$faculty uploaded assignment ". $res1['title'] ."
				 			</div>
				 			<div class=\"action\">
				 				<a title=\"Upload\" href=\"LMS.php?Upload=upload&id=".base64_encode(base64_encode($res1['ID']))."&SID=".base64_encode(base64_encode($res1['SUBID']))."\"><i class=\"fa fa-upload\"></i></a>
					";	
				}
				else{
					echo "
						$faculty uploaded content ". $res1['title'] ."
				 			</div>
				 			<div class=\"action\">
				 				<a title=\"Download\" href=\"".$res1['LMS_file']."\" target=\"_blank\"><i class=\"fa fa-download\"></i></a>
					";
				}
				echo "
				 			</div>
						</div>
				 	";
			}
		}
		echo "
			 	</fieldset>
		";
	?>
</body>
</html>
