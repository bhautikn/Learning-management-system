<?php
	session_start();
	if ($_SESSION['user_name']==null) header("location: /");
	$user_name = $_SESSION['user_name'];
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$sql_quary = "SELECT * from faculty WHERE FID = '".$_SESSION['FID']."';";
	$user_name_result = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary));

	$avatar_link = $user_name_result['avatar'];
	$first_name = $user_name_result['first_name'];
	$last_name = $user_name_result['last_name'];
	$email = $user_name_result['email'];
	$s_mobile = $user_name_result['mobile_no'];
	$p_mobile = $user_name_result['parent_mobile_no'];
	$SUBID = $user_name_result['SUBID'];
	$gender = $user_name_result['gender'];

	$sql_quary = "SELECT name from subject WHERE  SUBID= '".$SUBID."';";
	$subject_name = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary))['name'];
	mysqli_close($studentconn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Profile
	</title>
	<style type="text/css">
		.pro-img{
			height: 20vh;
/*			background-color: seagreen;*/
			margin: 10px 0;
			margin-bottom: 10%;
		}
		.pro-img div input{
			width: 100%;
			height: 100%;
		}
		.pro-img div{
			position: absolute;
			margin: 0 auto;
/*			z-index: -1;*/
/*			background-color: red;*/
			width: 50%;
			height: 20vh;
			left: 25%;
		}
		.pro-img img{
			border-radius: 50%;
			display: block;
			margin: 0 auto;
			z-index: 2;
			transition-duration: 0.8s;
		}
		.pro-img img:hover{
			opacity: 0.5;
		}
		.btn{
			width: 100% !important;
		}
		input[type=text]{
			background-color: lightgray !important;
			color: gray !important;
			cursor: not-allowed;
		}
	</style>
	<?php include("nav.php"); ?>
	<div class="pro-img">
		<!-- <div><input type="file"></div> -->
		<img src="<?php echo $avatar_link;?>">
	</div>
	<form method="post">
		<table align="center" width="50%" cellpadding="5">
			<tr>
				<td><label class="fonts" for="text">Name:</label></td>
				<td><input class="inputs" placeholder="First Name" type="text" name="first_name" value="<?php echo $first_name;?>" disabled></td>
				<td><input class="inputs" placeholder="Last Name" type="text" name="last_name" value="<?php echo $last_name;?>" disabled></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Subject:</label></td>
				<td><input class="inputs" placeholder="Class Name" type="text" name="class" value="<?php echo $subject_name;?>" disabled></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Student Mo. :</label></td>
				<td><input class="inputs" placeholder="Student Mobile No" type="text" name="s_mobile" value="<?php echo $s_mobile;?>" disabled></td>
			</tr>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Email Address:</label></td>
				<td><input class="inputs" placeholder="Email" type="text" name="email" value="<?php echo $email;?>" disabled></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Gender:</label></td>
				<td><input type="text" name="gender" value="<?php echo $gender;?>" class="inputs" disabled> </td>
			</tr>
			<tr align="center">
				<td ><input class = "inputs btn" type="submit" name="Submit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>