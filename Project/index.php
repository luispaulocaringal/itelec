<?php
	session_start();
	include 'function/login.php';
	if(isset($_POST["Login"])){
		login($_POST["uname"],$_POST["pword"]);
	}
	if(isset($_POST["logout"])){
		include 'function/log.php';
		logAction("logout");
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home | Classroom Reservation System</title>
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
			}
			.hover{
				transition:.1s;
			}
		</style>
	</head>
	<body>
		<div class = "bg">
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
