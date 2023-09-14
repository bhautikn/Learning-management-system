<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['FID']==null) {
			header("location: /");
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>add Student</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script type="text/javascript" src="script.js"></script>
	<style type="text/css">
		input[type=submit]{
			width: 100% !important;
		}
	</style>
	<?php include("nav.php"); ?>
	<h1 class="title">Student Detail</h1>
	<form method="post">
		<table align="center" width="50%" cellpadding="5">
			<tr>
				<td><label class="fonts" for="text">Name:</label></td>
				<td><input class="inputs" placeholder="First Name" type="text" name="first_name" required></td>
				<td><input class="inputs" placeholder="Last Name" type="text" name="last_name" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="select">semester:</label></td>
				<td>
					<select class="inputs" name="sem" required>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">class:</label></td>
				<td><input class="inputs" placeholder="Class Name" type="text" name="class" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Mobile No:</label></td>
				<td><input class="inputs" placeholder="Student Mobile No" type="text" name="s_mobile" required></td>
				<td><input class="inputs" placeholder="Parent Mobile No" type="text" name="p_mobile" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Email Address:</label></td>
				<td><input class="inputs" placeholder="Email" type="email" name="email" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="text">Gender:</label></td>
				<td><input type="radio" name="gender" value="male" checked><span class="fonts">Male</span></td>
				<td><input type="radio" name="gender" value="female"><span class="fonts">Female</span></td>
			</tr>
			<tr style="height: 20px;"><td colspan="3"><hr><td></tr>
			<tr>
				<td><label class="fonts">User Name: </label></td>
				<td><input class="inputs" placeholder="User Name" type="text" name="user_name" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="password">Password: </label></td>
				<td><input class="inputs" placeholder="Password" type="password" name="password" required></td>
			</tr>
			<tr>
				<td><label class="fonts">Repeat Password:</label></td>
				<td><input class="inputs" placeholder="Repeate Password" type="password" name="repassword"> </td>
			</tr>
			<tr style="height: 20px;"></tr>
			<tr align="right">
				<td colspan="3"><input class = "inputs btn" type="submit" name="Submit" placeholder="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
	if ($_POST['Submit']) {

		$studentconn = mysqli_connect("db", "kali", "kali", "Student");

		
		$first_name = trim($_POST['first_name']);
		$last_name = trim($_POST['last_name']);
		$user_name = trim($_POST['user_name']);
		$password = trim($_POST['password']);
		$s_mobile = trim($_POST['s_mobile']);
		$p_mobile = trim($_POST['p_mobile']);
		$email = trim($_POST['email']);
		$gender = trim($_POST['gender']);

	    $user_name_sql = "SELECT COUNT(*) as count FROM credintial WHERE user_name='".$user_name."';";
	    $user_name_result = mysqli_fetch_assoc(mysqli_query($studentconn, $user_name_sql))['count'];

		if (empty($first_name) || empty($last_name) || empty($user_name) || empty($password)) {
			echo "<div class='fail'>Fill all Detail</div>";
		}
		else if (preg_match("/[ -\.+=<>]/", $user_name)) {
			echo "<div class='fail'>Spcial charcter or Space is Not allow User Name</div>";
		}
		else if ($_POST['sem'] > 8 ) {
			echo "<div class='fail'>Enter valid semester</div>";
		}
		else if (strcmp($password,trim($_POST['repassword']))!=0) {
			echo "<div class=fail>password is not match</div>";
		}
	    else if ($user_name_result!=0) {
	    	echo "<div class=fail>Please choose another User Name</div>";
	    }
	    else {

			// insert user_name and password
			$sql = "
				INSERT INTO credintial 
					(
						user_name,
						password,
						isadmin
					)
				VALUES
					(
						'".$user_name."',
						'".md5($password)."',
						'false'
					);
				";
			mysqli_query($studentconn, $sql);
			echo $sql;
			// get id of inserted user_name
			$sql = "SELECT credintial_id FROM credintial WHERE user_name = '$user_name'";
			echo $sql;
			$credintial_id = mysqli_fetch_assoc(mysqli_query($studentconn, $sql))['credintial_id'];

			// insert other detail in student table
			$sql = "
				INSERT INTO student 
					(
						first_name,
						last_name,
						sem,
						class,
						mobile_no,
						parent_mobile_no,
						email,
						gender,
						credintial_id
					)
				
				VALUES 
					(
						'$first_name',
						'$last_name',
						".trim($_POST['sem']).",
						'".trim($_POST['class'])."',
						'$s_mobile',
						'$p_mobile',
						'$email',
						'$gender',
						'$credintial_id'
					);
				";
			
			// give end user feedback
			echo "$sql";
			if (mysqli_query($studentconn, $sql)) {
				echo "<div class=sucsess>Sucsessfully Added Student</div>";
			}
			else{
				echo "<div class=fail>Somathing went Wrong</div>";
			}
		}
		mysqli_close($studentconn);
	}
?>	