<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Attandance</title>
	<style type="text/css">
		.att_title{
			background-color: seagreen;
			margin: 20px 20px 0px 20px;
			padding: 10px;
			color: white;
			width: max-content;
			border-radius:10px 10px 0px 0px;
			box-shadow: 2px 2px 20px black;
			font-weight: 700;
		}
		.attpr{
			background-color: rgba(80, 70, 80, 1.0);

			height: 6vh;
			margin: 0px 20px 10px 20px;
			padding: 2vh;
			box-shadow: 2px 2px 15px black;
		}
		.attpr>div>div{
			background-color: seagreen;
			height: 2vh;
			border-radius: 20px;
		}
		.attpr>div{
			background-color: white;
			height: 100%;
			border-radius: 20px;
		}
		table{
			margin: 20px;
			padding: 0px !important;
			border-collapse: collapse;
			background-color: var(--dark);
		}
		tr{
			border-color: var(--light);
			color: var(--light);
			font-weight: 700;
		}
	</style>
	<?php include("nav.php");?>
	<?php
		navigationDiv("Attandance");
		$studentconn = mysqli_connect("db", "kali", "kali", "Student");
		$sql_quary = "SELECT GETPR('".$_SESSION['SID']."') AS PR;";
		$pr = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary))['PR'];
		if ($pr!=null) echo "<div class='att_title'>Your attandance is: ".$pr."%</div>";
		else echo "<div class='att_title'>Your attandance is: 0.00%</div>";
		echo "
			<div class='attpr'>
				<div><div style=width:".$pr."%;></div></div>
			</div>
		";
		$sql_quary = "SELECT DATE,DAYNAME(DATE) day,status from attandance where SID=".$_SESSION['SID'].";";
		$result = mysqli_query($studentconn, $sql_quary);
		echo "<table cellpadding='20' border='1' width=35%>
			<tr>
			<th>Date</th>
			<th>day name</th>
			<th>P/A</th>
			</tr>
		";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr align='center'><td>". $row['DATE']. "</td>";
			echo "<td>". $row['day']. "</td>";
			if (trim($row['status'])=='P') {
				echo "<td style='background-color:green'>". $row['status']. "</td></tr>";
			}
			else
				echo "<td style='background-color:red'>". $row['status']. "</td></tr>";
			}
			echo "</table>";
		mysqli_close($studentconn);
	?>
</body>
</html>