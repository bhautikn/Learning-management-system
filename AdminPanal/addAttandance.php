<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>attandance</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<style type="text/css">
		.text{
			color: var(--light) !important;
		}
		.inputs{
			width: 100% !important;
		}
		input[type=submit]{
			width: auto	;
		}
		.sucsess{
			margin: 8px 0 !important;
			width: 100% !important;
			border-radius: 5px !important;
			text-align: left !important;
			background-color: seagreen !important;
		}
		.fail{
			margin: 8px 0 !important;
			width: 100% !important;
			border-radius: 5px !important;
			text-align: left !important;
		}
		table{
			margin: 20px 5px;
		}
	</style>
	<?php include("nav.php"); ?>
	<form method="post">
		<table >
			<tr>
				<td><span class="text">Present Rollno: </span></td>
				<td>
					<input class="inputs" type="text" name="Rollno">
				</td>
				<td><input class="btn inputs" type="submit" name="submit" value="Submit" style="width: max-content;"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
	if ($_POST['submit']) {
		$attconn = mysqli_connect("db", "kali", "kali", "Student");
	    for ($i=0; $i < count(preg_split("/\,/", $_POST['Rollno'])); $i++) { 
	    	$value = preg_split("/\,/", $_POST['Rollno'])[$i];
	    	$sql = "UPDATE attandance SET status='P' WHERE SID=". $value ." AND DATE = CURDATE();";
	    	try {
	    		if(mysqli_query($attconn, $sql)){
				echo "<div class='sucsess'>Present Rollno: ".$value."</div>";
			}
	    	} catch (Exception $e) {
				echo "<div class='fail'>duplicate Rollno: ".$value."</div>";	
	    	}
	    }
	    mysqli_close($attconn);
	}
?>