<?php
	
	session_start();
	include 'function/login.php';
	if(isset($_POST["Login"])){
		login($_POST["uname"],$_POST["pword"]);
	}
	if(isset($_POST["submit"])){
		$status = "pending";
		include "function/insert.php";
		request($_POST["profName"],$_POST["section"],$_POST["subject"],$_POST["roomNumber"],$_POST["startTime"],$_POST["date"],$_SESSION["day"],$_POST["duration"],$_POST["rfr"]);
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
		<style>.modal-header, h4, .close {
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
			<div class="contain">
				<center><h1 class="rrf">Room Reservation Form</h1>
				<form method="POST">
					<table>
						<tr>
							<td>Name of Professor</td>
							<td><input type="text" name="profName" required="true" class="field" value="Luis Caringal"></td>
						</tr>
						<tr>
							<td>Section</td>
							<td><input type="text" name="section" required="true" class="field" value="3IT-I"></td>
						</tr>
						<tr>
							<td>Subject</td>
							<td><input class="field" type="text" name="subject" value="ICS 114"></td>
						</tr>
						<tr>
							<td>Room Number</td>
							<td><input class="field" type="text" name="roomNumber" value="<?php echo $_SESSION["roomNumber"];?>"></td>
						</tr>
						<tr>
							<td>Date</td>
							<td><input class="field" type="text" name="date" value="<?php echo $_SESSION["date"];?>"></td>
						</tr>
						<tr>
							<td>Start Time (24hr format)</td>
							<td><input class="field" type="text" name="startTime" value="<?php echo $_POST["time"];?>"></td>
						</tr>
						<tr>
							<td>Duration (Minutes)</td>
							<td>
								<select name="duration">
									<?php
										if($_SESSION["time"]=="19:30:00"){
											echo "<option value='60'>30 mins</option><option value='60'>60 mins</option><option value='90'>90 mins</option>";
										}
										else if($_SESSION["time"]=="20:00:00"){
											echo "<option value='60'>30 mins</option><option value=;90'>60 mins</option>";
										}
										else if($_SESSION["time"]=="20:30:00"){
											echo "<option value='30'>30 mins</option>";
										}
										else{
											echo "<option value='30'>30 mins</option><option value='60'>60 mins</option><option value='90'>90 mins</option><option value='120'>120 mins</option>";
										}
									?>
								</select>
							</td>
						</tr>
					</table><br>
					<label>Reason for Reservation</label><br>
					<textarea name ="rfr" placeholder="Enter reason of reserving.." required="true">Make Up Class</textarea><br><br>
					<input class="button" type="submit" name="submit" value="Submit"/><br><br>
				</form></center>
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
