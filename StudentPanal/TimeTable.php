<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time Table</title>
	<style type="text/css">
		table{ 
			padding:5px !important;
			border: none !important;
		}
		td,th{
			border: 1px solid var(--gray);
			text-align: center;
			padding: 10px;
			color: var(--gray);
		}
		td:first-child,th{ background-color:rgba(0, 0, 0, 0.2); }
		.table-break{ background-color: rgba(0, 0, 0, 0.2); }
		.table-lab{ background-color: rgba(0, 0, 0, 0.1	); }
	</style>
	<?php 
		include("nav.php");
		navigationDiv("Time Table");
	?>
	<table align="center" cellspacing="0">
		<tr>
			<th >Time Slot</th>
			<th>Monday<br>
				24-04-2023
		</th>
			<th>Tuesday
			<br>25-04-2023
		</th>
			<th>Wednesday
			<br>26-04-2023
		</th>
			<th>Thursday
			<br>27-04-2023
		</th>
			<th>Friday
			<br>28-04-2023
		</th>
			<th>Saturday
			<br>29-04-2023
		</th>
		</tr>
	
			<tr>
			<td>07:45 AM
			<br>to
			<br>08:40 AM
		</td>
		<td>
			<b>2101CS202 - FE
			<br>(Lecture)
		</b>
			<br>{KDV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS201 - DBMS-I
			<br>(Lecture)
		</b>
			<br>{NRV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS202 - FE
			<br>(Lecture)
		</b>
			<br>{KDV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS203 - OOP
			<br>(Lecture)
		</b>
			<br>{AVB}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS201 - DBMS-I
			<br>(Lecture)
		</b>
			<br>{NRV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
		</td>
		</tr>
			<tr>
				<td>08:40 AM
				<br>to
			<br>09:35 AM
		</td>
		<td>
			<b>2101CS201 - DBMS-I
			<br>(Lecture)
		</b>
			<br>{NRV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS203 - OOP
			<br>(Lecture)
		</b>
			<br>{AVB}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS203 - OOP
			<br>(Lecture)
			</b>
			<br>{AVB}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS203 - OOP
			<br>(Lecture)
		</b>
			<br>{AVB}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
			<b>2101CS202 - FE
			<br>(Lecture)
		</b>
			<br>{KDV}
			<br>[Auditorium - AUD-1]
			<br>
		</td>
		<td>
		</td>
		</tr>
			<tr>
				<td>09:35 AM
				<br>to
			<br>09:50 AM
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
	</tr>
		<tr>
			<td>09:50 AM
			<br>to
		<br>10:40 AM
	</td>
		<td>
			<b>2101HS101 - CE
			<br>(Lecture)
	</b>
		<br>{RBM}
		<br>[Class - A-310]
		<br>
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101HS201 - MAT-II
			<br>(Tutorial)
	</b>
		<br>{DHZ}
		<br>[Class - A-309]
		<br>
	</td>
		<td>
			<b>2101HS201 - MAT-II
			<br>(Lecture)
	</b>
		<br>{DBJ}
		<br>[Class - A-307]
		<br>
	</td>
		<td>
			<b>2101HS201 - MAT-II
			<br>(Lecture)
	</b>
		<br>{DBJ}
		<br>[Class - A-307]
		<br>
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101CS203 - OOP
			<br>(Lab)
	</b>
		<br>{VJK}
		<br>[Lab - C-304-I]
		<br>
	</td>
		<td>
		</td>
	</tr>
		<tr>
			<td>10:40 AM
			<br>to
		<br>11:30 AM
	</td>
		<td>
			<b>2101HS101 - CE
			<br>(Lecture)
	</b>
		<br>{BSM}
		<br>[Class - A-310]
		<br>
	</td>
		<td>
			<b>Co-Curricular Activities
		</b>
		<br>{KMD}
		<br>
	</td>
		<td>
			<b>2101HS201 - MAT-II
			<br>(Lecture)
	</b>
		<br>{DBJ}
		<br>[Class - A-307]
		<br>
	</td>
		<td>
		</td>
	</tr>
		<tr>
			<td>11:30 AM
			<br>to
		<br>12:10 PM
	</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
		<td class="table-break">Break
		</td>
	</tr>
		<tr>
			<td>12:10 PM
			<br>to
		<br>01:00 PM
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101HS101 - CE
			<br>(Lab)
	</b>
		<br>{RBM}
		<br>[Class - A-316]
		<br>
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101CS103 - OAT
			<br>(Lab)
	</b>
		<br>{KJJ}
		<br>[Lab - A-207(2)]
		<br>
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101CS201 - DBMS-I
			<br>(Lab)
	</b>
		<br>{MRF}
		<br>[Lab - C-307]
		<br>
	</td>
		<td rowspan="2" class="table-lab">Batch-2
			<br>
		<b>2101CS202 - FE
			<br>(Lab)
	</b>
		<br>{BDJ}
		<br>[Lab - E-306]
		<br>
	</td>
		<td>
			<b>2101HS201 - MAT-II
			<br>(Lecture)
	</b>
		<br>{KMD}
		<br>[Class - A-312]
		<br>
	</td>
	<td>
	</td>
	</tr>
		<tr>
			<td>01:00 PM
			<br>to
		<br>01:50 PM
	</td>
		<td>
			<b>Co-Curricular Activities
		</b>
		<br>{KMD}
		<br>
	</td>
	<td>
	</td>
	</tr>
	</table>
</body>
</html>