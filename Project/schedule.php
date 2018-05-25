<?php
	session_start();
	
	include 'function/login.php';
	include 'function/load.php';
	include 'function/functions.php';
	
	if(isset($_POST["Login"])){
		login($_POST["uname"],$_POST["pword"]);
	}
	if(!isset($_SESSION["currentMonth"]) && !isset($_SESSION["currentYear"]) && !isset($_SESSION["currentDate"])){
		$_SESSION["currentMonth"] = $_POST["currentMonth"];
		$_SESSION["currentYear"] = $_POST["currentYear"];
		if($_POST["currentDate"]<10){
			$_SESSION["currentDate"] = "0".$_POST["currentDate"];
		}
		else{
			$_SESSION["currentDate"] = $_POST["currentDate"];
		}
	}
	if(isset($_SESSION["time"]) || isset($_SESSION["roomNumber"])){
		unset($_SESSION["time"]);
		unset($_SESSION["roomNumber"]);
	}
	if(isset($_SESSION["date"])){
		unset($_SESSION["date"]);
	}
	$_SESSION["date"] = getCurrentDate();
	$day = getWeekday($_SESSION["date"]);
	$_SESSION["day"] = getDay($day);
	if($_SESSION["day"]=="Sunday"){
		echo '<script type="text/javascript">'; 
		echo 'alert("No Classes on Sundays");'; 
		echo 'window.location.href = "calendar.php";';
		echo '</script>';	
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Schedule | Classroom Reservation System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			.modal-header, h4, .close {
				background-color: #5cb85c;
				color:white !important;
				text-align: center;
				font-size: 30px;
			}
			.modal-footer {
				background-color: #f9f9f9;
			}
			body, html{
				height: 100%;
				margin: 0;
			}
			.bg {
				background-image: url("img/bg1.jpg");

				/* Full height */
				height: 100%; 

				/* Center and scale the image nicely */
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				
				background-attachment: fixed;
				font-family:Trajan PRO;
			}
			.navi {
				border-radius: 0px;
				border: none;
				padding: 0px;
				font-size: 14px;
				background-color: #922B21;
				font-family: Trajan PRO;	
			}
			.color {
				color: white;
			}
			.modal-header {
				background-color: #922B21;
			}
			.modal-content {
				background-color: #ECF0F1;
			}
			.h3 {
				font-family: Trajan PRO;
				font-size: 20px;
			}
			.up {
				font-family: Trajan PRO;
				font-size: 16px;
			}
			.buttonlogin {
				border-radius: 4px;
				border: 2px solid #922B21;
				color: white;
				padding: 5px 5px;
				font-size: 15px;
				cursor: pointer;
				background-color: #922B21;
				font-family: Trajan PRO;
				height:30px;
				width:100px;
			}
			.buttonlogin1 {
				border-radius: 4px;
				border: 2px solid #797D7F;
				color: white;
				padding: 5px 5px;
				font-size: 15px;
				cursor: pointer;
				background-color: #797D7F;
				font-family: Trajan PRO;
				height:30px;
				width:100px;
			}
			.buttonlogin:hover{
				transition:.1s;
				border: 2px solid #922B21;
				color: #922B21;
				background-color:white;
				cursor:pointer;
			}
			.buttonlogin1:hover{
				transition:.1s;
				border: 2px solid #797D7F;
				color: #797D7F;
				background-color:white;
				cursor:pointer;
			}
			.unselectable {
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				cursor: default;
			}
			.loginInput{
				border-radius:4px;
				width:250px;
				height:30px;
				border: 2px solid #922B21;
				text-align:center;
				font-family:arial;
			}
			.hover{
				transition:.1s;
			}
			.contain {
				width: 1200px;
				height:auto;
				background-color: #FFF;
				margin: auto; /* the auto value on the sides, coupled with the width, centers the layout */
				border: 14px solid #fff;
				margin-top:20px;
				box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.50), 0 16px 20px 0 rgba(0, 0, 0, 0.19);
			}
			.custombtn{
				margin-top:13px;
				width:140px;
				height:40px;
				border:2px solid #922B21;
				background-color:#922B21;
				border-radius:4px;
				color:white;
			}
			.custombtn:hover{
				transition:.1s;
				color:#922B21;;
				background-color:white;
			}
			td,th{
				width:175px;
				height:25px;
				text-align:center;
			}
			td{
				border-bottom:1px solid black;
			}
			.field{
				width:175px;
				color:transparent;
				border:none;
				height:24px;
				background-color:transparent;
			}
			.field:hover{
				background-color:#ddd;
				transition:0.1s;
			}
			.class{
				background-color:grey;
				pointer-events:none;
			}
			.pending{
				background-color:#F39C12;
				pointer-events:none;
			}
			.reserved{
				background-color:#27AE60;
				pointer-events:none;
			}
			.time{
				width:75px;
				border-bottom:none;
				font-weight:bold;
			}
			.info{
				width:225px;
			}
			.hour{
				border-bottom:2px solid #922B21;
			}
		</style>
	</head>
	<body class = "bg">
		<div>
			<nav class="navi"  role="navigation">                             
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class="active hover"><a href="index.php" class=" hover color unselectable">Home</a></li>
							<li class="hover"><a href="calendar.php" class="hover color unselectable">Calendar</a></li>
							<li><img src="img/ustlogo2.png" height="45"></li>
						</ul>
					   <ul class="nav navbar-nav navbar-right">
						   <li class="hover"><a data-toggle="modal" data-target="#loginModal" class="hover color unselectable">Login as Admin</a></li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="contain">
				<div class="row">
					<div class="col-lg-3" style="border-right:2px solid black">
						<center>
							<form method="POST">
								<h3 style="font-weight:bold;">Rooms</h3>
								<input class="custombtn" type="submit" name="room" value="314"> 
								<input class="custombtn" type="submit" name="room" value="45"> 
								<input class="custombtn" type="submit" name="room" value="46"> 
								<input class="custombtn" type="submit" name="room" value="47"> 
								<input class="custombtn" type="submit" name="room" value="48"> 
								<input class="custombtn" type="submit" name="room" value="49"> 
								<input class="custombtn" type="submit" name="room" value="52"> 
								<input class="custombtn" type="submit" name="room" value="53"> 
								<input class="custombtn" type="submit" name="room" value="54">
								<h3 style="font-weight:bold;">Laboratory</h3> 
								<input class="custombtn" type="submit" name="room" value="1"> 
								<input class="custombtn" type="submit" name="room" value="2"> 
								<input class="custombtn" type="submit" name="room" value="3"> 
								<input class="custombtn" type="submit" name="room" value="4"> 
								<input class="custombtn" type="submit" name="room" value="Netlab"> 
								<input class="custombtn" type="submit" name="room" value="IT Lab">
							</form>
						</center><br>
					</div>
					<div class="col-lg-9">
						<div class="row">
							<div class="col-sm-12">
								<center><h2 style="font-weight:bold;"><?php echo $_SESSION["date"]?> : <?php echo $_SESSION["day"]?></h2></center>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<?php
									if(isset($_POST["room"])){
										echo "<center><h3>Schedule for Room ".$_POST["room"]."</h3></center><br>";
										$_SESSION["roomNumber"] = $_POST["room"];
										loadSchedule($_SESSION["roomNumber"],$_SESSION["date"],$_SESSION["day"]);
									}
								?>
							</div>
							<div class="col-md-3">
								<center><h3>Legend</h3></center>
								<div style='background-color:grey'><h5 style='text-align:center;color:white;'>Class</h5></div>
								<div style='background-color:#F39C12'><h5 style='text-align:center;color:white;'>Pending</h5></div>
								<div style='background-color:#27AE60'><h5 style='text-align:center;color:white;'>Reserved</h5></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="loginModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"> &times;</button>
							<h3 class="h3 unselectable">Login as Administrator</h3>
						</div><br>
						<div class="modal-body">
							<form class="form-inline" method="POST"><center>
								<div class="form-group">
									<label class="up unselectable"><b>Username</b></label><br>
									<input class="loginInput" type="text" name="uname" id = "uname" size = "20" autofocus required><br>
								</div>
								<br><br>
								<div class="form-group">  
									<label class="up unselectable"><b>Password</b></label><br>
									<input class="loginInput" type="password" name="pword" id = "pword" size = "20" required><br>
								</div>
								<br><br><br>
								<button type="submit" name="Login" class="buttonlogin">Login</button>
								<button type="button" class="buttonlogin1" data-dismiss="modal">Cancel</button><br>                
							</form></center>
						</div><br><br>
						<!--
						<div class="modal-footer">
							<div style="padding:10px"></div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
