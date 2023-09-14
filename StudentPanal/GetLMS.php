<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['SID'] == null) header("location: /");
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$ID = base64_decode(base64_decode($_GET['ID']));

	// update view by 1 in database
	$sql = "UPDATE subject_LMS SET view = view+1 WHERE ID = ".$ID.";";
	mysqli_query($studentconn,$sql);

	// get file name by id
	$sql = "SELECT LMS_file from subject_LMS where ID = ".$ID."";
	$result = mysqli_query($studentconn, $sql);
	$file = mysqli_fetch_assoc($result)['LMS_file'];
?>
<!DOCTYPE html>
<html>
<body onload="window.location.href = '<?php echo $file;?>'">
</body>
</html>