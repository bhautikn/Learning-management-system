<?php
	error_reporting(0);
	//---------------------------------- functions --------------------------------//
	function getValue(string $value)
	{
		$value = base64_decode(base64_decode($value));
		if(!is_numeric( $value ))
			return null;
		return $value; 
	}
	function navigationDiv(string $value){
		echo "
			<div class='navigation'>
				<h2 style='margin:0;'>
					<span>
						<a onclick=\"history.go(-1)\">
							<i class='fa fa-arrow-left'></i>
						</a>
					</span>
					<span class='text'>
						$value
					</span>
				</h2>
			</div>
		";
	}
	//-----------------------------------------------------------------------------//
	session_start();		
	if ($_SESSION['user_name']==null || $_SESSION['SID'] == null) echo "<script> window.location='/' </script>";
	$user_name = $_SESSION['user_name'];
	$studentconn = mysqli_connect("db", "kali", "kali", "Student");

	$sql_quary = "SELECT avatar from student WHERE SID = ".$_SESSION['SID'].";";
	$user_name_result = mysqli_fetch_assoc(mysqli_query($studentconn, $sql_quary));
	$avatar_link = $user_name_result['avatar'];
	mysqli_close($studentconn);
	if ($_GET['logout']) {
		session_destroy();
		echo "<script> window.location='/' </script>";
	}
?>
<script type="text/javascript" src="/script.js"></script>
<style type="text/css">
		.nav-item-icon::before{
			color: white;
			padding-right: 5px;
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
			z-index: 210;
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
			animation-fill-mode: forwards;
			z-index: 200;
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
		/*#loader{
			position: fixed;
			width: 100%;
			height: 100vh;
			background: #21242d url('https://cssauthor.com/wp-content/uploads/2018/06/Bouncy-Preloader.gif') no-repeat center;
			z-index: 999;
			display: block;
		}*/	
	</style>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script src="https://kit.fontawesome.com/9b0f98a31a.js" crossorigin="anonymous"></script>
	
</head>
<body>
	<!-- <div id="loader"></div> -->
	<div class="panal">
		<ul class="nav">
			<li class="nav-item"><a href="/StudentPanal/"><i class="fa fa-home nav-item-icon"></i>Home</a></li>
			<li class="nav-item"><a href="LMS.php"><i class="fa fa-book nav-item-icon"></i>LMS</a></li>
			<li class="nav-item"><a href="Attandance.php"><i class="fa-solid fa-file-text nav-item-icon"></i>Attandance</a></li>
			<li class="nav-item"><a href="TimeTable.php"><i class="fas fa-hourglass-end nav-item-icon"></i>Time Table</a></li>

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
	<!-- <script type="text/javascript" defer>
		loader = document.getElementById('loader');
		setTimeout(f, 100);
		function f(){
			loader.style.display = "none";
		}

	</script> -->