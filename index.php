<?php 
	error_reporting(0);
	session_start();
	ob_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<script src="https://www.google.com/recaptcha/api.js?render=6LcCvcElAAAAAM9zbGICpMtPMRhZqwBVG8PLsw3L"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script src="/script.js"></script>
	<style type="text/css">
		.red_div{
			width: 1.7%;
			height: 100vh;
			position: absolute;
			top: 0;
			left: 5%;
			background-color: var(--red);
		}
		.blue_div{
			width: 1.7%;
			height: 100vh;
			position: absolute;
			top: 0;
			left: 7%;
			background-color:var(--green);
		}
		.theme{
			position: absolute;
			top:10px;
			padding: 10px;
			right: 10px;
			background-color: var(--gray);
			color: var(--dark);
			height: 40px;
			border-radius: 10px;
		}
		.button{
			background-color: var(--green) !important;
			width: 70%;
		}
		.button:hover{background: grey !important;}
	</style><link rel="stylesheet" type="text/css" href="/style.css">
</head>

<body>
	<h1 class="title">Login</h1>
	<form method="post">
		<table align="center" cellpadding="10">
			<tr>
				<td><label class="fonts" for="text">User Name:</label></td>
				<td><input class="inputs" placeholder="User Name" type="text" name="user_name" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="password">Password:</label></td>
				<td><input class="inputs" placeholder="Password" type="password" name="password" required> </td>
			</tr>
			<tr align="center">
				<td colspan="2">
					<input class="inputs btn" type="submit" name="Submit" value="Submit">
				</td>
			</tr>
			<tr>
				<td><a href="#" style="color: gray;" onclick="this.innerHTML='Never Forget your Password'">forget password?</a></td>
			</tr>
		</table>
	</form>
	<div class="red_div"></div>
	<div class="blue_div"></div>
	<div style="clear: both;"></div>
	<button class="btn theme" onclick="themeChange();">Change Theme</button>
</body>
</html>
<?php
	if ($_POST['Submit']) {
	    $studentconn = mysqli_connect("db", "kali", "kali", "Student")  or die ("could not connect to mysql");
	    $user_name = preg_split("/\s/", trim($_POST['user_name']))[0];
	    $user_name = str_replace("'", '', $user_name);
	    $password = md5(trim($_POST['password']));

	    $sql = "SELECT password FROM credintial WHERE user_name='".$user_name."';";
	    try {
	    	$database_pass = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['password'];
	    	if (strcmp($password,$database_pass)==0) {
				echo "<div class=sucsess>Login Sucsessfully</div>";

				$_SESSION['user_name'] = $user_name;
				$sql = "SELECT isadmin FROM credintial WHERE user_name='".$user_name."';";
	    		$isadmin = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['isadmin'];
				if (strcmp($isadmin,'true')==0) {
					$sql = "SELECT FID FROM faculty,credintial
					WHERE faculty.credintial_id=credintial.credintial_id
					AND credintial.user_name = '".$user_name."';";
	    			$id = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['FID'];
	    			$_SESSION['FID'] = $id;
					echo "<script> window.location='/AdminPanal/' </script>";
				}
				else{
		    		$sql = "SELECT SID FROM student,credintial
		    		WHERE student.credintial_id=credintial.credintial_id
		    		AND credintial.user_name = '".$user_name."';";

		    		$id = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['SID'];
		    		$_SESSION['SID'] = $id;
					echo "<script> window.location='/StudentPanal/' </script>";
				}
		    }
		    else{ 
		    	echo "<div class=fail>Wrong username or password</div>";
		    }
	    } catch (Exception $e) {
		    echo "<div class=fail>Wrong username or password</div>";
	    }
		finally{
			mysqli_close($studentconn);
		}
	}
?>