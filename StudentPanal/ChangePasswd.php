<?php
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['SID'] == null) header("location: /");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
	<?php include("nav.php"); ?>
	<?php navigationDiv("Changed Password") ?>
	<h2 class="title">Change Password</h2>
	<form method="post">
		<table align="center" cellpadding="10">
			<tr>
				<td><label class="fonts" for="password">Currunt Password:</label></td>
				<td><input class="inputs" placeholder="Currunt Password" type="password" name="cur_password" required></td>
			</tr>
			<tr>
				<td><label class="fonts" for="password">Password:</label></td>
				<td><input class="inputs" placeholder="Password" type="password" name="password" required> </td>
			</tr>
			<tr>
				<td><label class="fonts" for="password">Retype Password:</label></td>
				<td><input class="inputs" placeholder="Re Password" type="password" name="re_password" required> </td>
			</tr>
			<tr align="center">
				<td colspan="2">
					<input class="inputs btn" type="submit" name="Submit" value="Submit">
				</td>	
			</tr>
		</table>

	</form>
<?php
	if ($_POST['Submit']){

		if (empty($_POST['password']) || empty($_POST['re_password']) || empty($_POST['cur_password'])) {
			echo "<div class='fail'>Fill all Detail</div>";
		}
		else if (strcmp($_POST['password'],$_POST['re_password'])!=0) {
			echo "<div class='fail'>password is not match</div>";
		}
		else{
			$studentconn = mysqli_connect("db", "kali", "kali", "Student");
			$sql_quary = "SELECT password FROM credintial WHERE user_name = '".$_SESSION['user_name']."';";
			// echo $sql_quary;
			$database_pass = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary))['password'];
			if (strcmp(md5($_POST['cur_password']),$database_pass)==0) {
				$sql_quary = "UPDATE credintial SET password = '".md5($_POST['password'])."' WHERE user_name = '".$_SESSION['user_name']."';";
				if (mysqli_query($studentconn, $sql_quary)) {
					echo "<div class='sucsess'>password sucsessfully changed</div>";
				}
			}
			else{
				echo "<div class='fail'>password is not match for ".$_SESSION['user_name']."</div>";
			}
			mysqli_close($studentconn);
		}
	} 
?>
</body>
</html>
