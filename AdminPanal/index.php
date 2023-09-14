<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['FID'] == null) header("location: /");

	$user_name = $_SESSION['user_name'];
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$sql_quary = "SELECT * from faculty WHERE FID = ".$_SESSION['FID'].";";
	$faculty_res = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary));
	$sql_quary = "SELECT  name from subject where SUBID = ".$faculty_res['SUBID'].";";
	$subject_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary))['name'];

	mysqli_close($studentconn);
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dash Bord</title>
	<?php include("nav.php");?>
	<div class="most-outer-div">
		<div class="left-div-img">
			<img src="<?php echo $faculty_res['avatar'];?>">
		</div>
		<div class="right-div-content">
			<div title="Name">Name : <?php echo $faculty_res['first_name'] ." ". $faculty_res['last_name'] ;?></div>
			<div title="Sem">Subject : <?php echo $subject_name;?></div>
			<div title="Mobile No.">Mobile No : <?php echo $faculty_res['mobile_no'];?></div>
			<div title="Email">Email : <?php echo $faculty_res['email'];?></div>
			<div title="Gender">Gender : <?php echo $faculty_res['gender'];?></div>
		</div>
	</div>
</body>
</html>
