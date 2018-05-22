<?php
	session_start();
	include 'function/login.php';
	if(isset($_POST["Login"])){
		login($_POST["uname"],$_POST["pword"]);
	}
	if(isset($_SESSION["currentMonth"]) && isset($_SESSION["currentYear"]) && isset($_SESSION["currentDate"])&& isset($_SESSION["date"])){
		unset($_SESSION["currentMonth"]);
		unset($_SESSION["currentYear"]);
		unset($_SESSION["currentDate"]);
		unset($_SESSION["date"]);
	}
	if(isset($_SESSION["day"])){
		unset($_SESSION["day"]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Calendar | Classroom Reservation System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			.date{
				border:2px solid #922B21;
				border-radius:4px;
				background-color:white;
			}
			.date:hover{
				color:white;
				background-color:#922B21;
				transition:.1s;
			}
			div#calendar{
			  margin:0px auto;
			  padding:0px;
			  width: 604px;
			  font-family:Trajan PRO;
			  border: 2px solid #922B21;
			}		 
			div#calendar div.box{
				position:relative;
				top:0px;
				left:0px;
				width:100%;
				height:40px;
				background-color:   #922B21 ; 
				border:2px solid #922B21;
			}			 
			div#calendar div.header{
				line-height:40px;  
				vertical-align:middle;
				position:absolute;
				left:11px;
				top:0px;
				width:582px;
				height:40px;   
				text-align:center;
			}			 
			div#calendar div.header a.prev,div#calendar div.header a.next{ 
				position:absolute;
				top:0px;   
				height: 17px;
				display:block;
				cursor:pointer;
				text-decoration:none;
				color:#FFF;
			}		 
			div#calendar div.header span.title{
				color:#FFF;
				font-size:18px;
			}		 
			div#calendar div.header a.prev{
				left:0px;
			}			 
			div#calendar div.header a.next{
				right:0px;
			}
			div#calendar div.box-content{
				border-top:none;
			}			 
			div#calendar ul.label{
				float:left;
				margin: 0px;
				padding: 0px;
				margin-top:5px;
				margin-left: 5px;
			}			 
			div#calendar ul.label li{
				margin:0px;
				padding:0px;
				margin-right:5px;  
				float:left;
				list-style-type:none;
				width:80px;
				height:40px;
				line-height:40px;
				vertical-align:middle;
				text-align:center;
				color:#000;
				font-size: 15px;
				background-color: transparent;
			}						 
			div#calendar ul.dates{
				float:left;
				margin: 0px;
				padding: 0px;
				margin-left: 5px;
				margin-bottom: 5px;
			}			 
			/** overall width = width+padding-right**/
			div#calendar ul.dates li{
				margin:0px;
				padding:0px;
				margin-right:5px;
				margin-top: 5px;
				line-height:80px;
				vertical-align:middle;
				float:left;
				list-style-type:none;
				width:80px;
				height:80px;
				font-size:25px;
				background-color: #DDD;
				color:#000;
				text-align:center; 
			}		 
			:focus{
				outline:none;
			}			 
			div.clear{
				clear:both;
			}  
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
				font-family:Trajan PRO;
			}
			.bg {
				background-image: url("img/bg1.jpg");

				/* Full height */
				height: 100%; 

				/* Center and scale the image nicely */
				background-position: center;
				
				background-attachment: fixed;
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
				font-family:arial;
			}
			.hover{
				transition:.1s;
			}
			.disabled{
				pointer-events:none;
				background-color:#922B21;
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
		</style>
	</head>
	<body class="bg">
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
				<div class="row"><center><h1 style="font-weight:bold;">Calendar</h1></center><br>
					<?php
						include 'function/createCalendar.php';		
						$calendar = new Calendar();
						echo $calendar->show();
					?>
				</div><br><br>
			</div><br><br>
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
	</body>
</html>
