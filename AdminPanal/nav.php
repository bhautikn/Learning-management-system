<?php
	error_reporting(0);
	session_start();
	if ($_SESSION['user_name']==null || $_SESSION['FID']==null) header("location: /");

	$user_name = $_SESSION['user_name'];
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$sql_quary = "SELECT * from faculty where FID =".$_SESSION['FID'].";";
	$user_name_result = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary));

	$avatar_link = $user_name_result['avatar'];
	mysqli_close($studentconn);
	if ($_GET['logout']) {
		session_destroy();
		echo "<script> window.location='/' </script>";
	}
	//---------------------------------- functions --------------------------------//
	function getValue(string $value)
	{
		$value = base64_decode(base64_decode($value));
		if(!is_numeric( $value ))
			return null;
		return $value; 
	}
	//-----------------------------------------------------------------------------//
	
?>
	<style type="text/css">
		.nav-item-icon::before{
			color: white;
			padding-right: 5px !important;
		}
		.other-icon::before{
			color: var(--light);
			padding-right: 5px;
		}
		.imgAvatar{
			border-radius: 50%;
			height: 80px;
			border: 5px solid rgba(25, 95, 93, 1.0);
			transition-duration: 0.15s;
		}
		.profile{
			position: absolute;
			right: 0;
			top: 0;
			padding-right: 5px;
		}
		.profile ul{
			list-style-type: none;
			margin: 0;
			padding: 0;
			position: absolute;
			display: none;
			box-shadow: 2px 2px 20px black;
			background-color: var(--dark);
			color: var(--gray);
			width: max-content;
			z-index:200;
			top: 0px;
		}
		.profile li{
			padding: 10px;
			margin: 10px 0 ;
			text-align: center;
			cursor: pointer;
			font-size: 0.99em;
		}
		.profile li:last-child:hover{
			background-color: darkred;
		}
		.profile li:hover{
			background-color: seagreen;
			color: white;
		}
		.profile:hover ul{
			display: block;
			animation-name: myani;
			animation-duration: 0.4s;
			animation-fill-mode: forwards;;
		}
		@keyframes myani{
			from{
				top: 70px;
				right: 10px;
				opacity: 0;
			}
			to{
				right: 10px;
				top: 85px;
				opacity: 1;
			}
		}
		.imgAvatar:hover{
			border: 5px solid green;
		}
		.panal{
/*			background-color: rgba(25, 95, 93, 1.0);*/
			background-image: linear-gradient(to left,rgba(25, 95, 93, 1.0) 20%,seagreen);
			box-shadow: 2px 2px 15px black;
		}
		body{
			margin: 0 0;
		}
		.nav{
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		.nav-item{
			float: left;
			padding: 15px;
			font-weight: 700;
			transition-duration: 0.5s;
		}
		.nav-item:hover{
			background-color: gray;
		}
		a{
			text-decoration: none;
			color: white;
			padding: 15px;
			cursor: pointer;
			font-size: 1.15em;
		}
		.LMS-drop:hover .LMS-drop-ul{
			display: block;
		}
		.LMS-drop-ul{
			display: none;
			position: absolute;
			margin-top: 15px;
			background-color: rgba(25, 95, 93, 1.0);
			box-shadow: 2px 2px 10px black;
			text-align: center;
			padding: 10px 0;
			z-index: 200;
			transition-duration: 0.5s;
		}
		.LMS-drop-ul li{
			list-style-type: none;
			display: block;
			padding: 10px;
			margin: 2px;
			cursor: pointer;
		}
		.LMS-drop-ul li:hover{
			background-color: gray;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script src="https://kit.fontawesome.com/9b0f98a31a.js" crossorigin="anonymous"></script>
	<!-- <script src="https://use.fontawesome.com/3a2eaf6206.js"></script> -->
	<script type="text/javascript" src="/script.js"></script>

</head>
<body>
	<div class="panal">
		<ul class="nav">
			<li class="nav-item"><a href="/AdminPanal/"><i class="fa fa-home nav-item-icon"></i> Home</a></li>
			<li class="nav-item"><a href="add_stu.php"><i class="fa fa-user-plus nav-item-icon"></i> Add Sudent</a></li>
			<li class="nav-item"><a href="addAttandance.php"><i class="fa fa-file-text nav-item-icon"></i> Add Attandance</a></li>
			<li class="nav-item LMS-drop"><a><i class="fa fa-book nav-item-icon"></i> LMS <i class="fa fa-caret-down"></i></a>
				<ul class="LMS-drop-ul">
					<li><a href="addLMS.php"><i class="fa fa-plus nav-item-icon"></i> Add LMS</a></li>
					<li><a href="LMSshow.php"><i class="fa fa-eye nav-item-icon"></i> View LMS</a></li>
				</ul>
			</li>
		</ul>
		<div class="profile">
			<img class="imgAvatar" src="<?php echo $avatar_link ?>">
			<ul>
				<li onclick="themeChange();"><i class="fa fa-sun other-icon"></i> theme</li>
				<li onclick="window.location.href='profile.php';"><i class="fa fa-user other-icon"></i>My Profile</li>
				<li onclick="window.location.href='ChangePasswd.php';"><i class="fa fa-edit other-icon"></i>Change Password</li>
				<li onclick="window.location.href='index.php?logout=true';"><i class="fa fa-sign-out other-icon"></i>Logout</li>
			</ul>
		</div>
	</div>