<?php
	session_start();
	if(!isset($_SESSION["loggedin"])){
		header("Location:index.php");
	}
	include 'function/action.php';
	include 'function/backup.php';
	$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
	$query = "SELECT * FROM schedule";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
	$data = array();
	foreach($result as $row){
		$data[] = array(
			'ID' => $row["reqID"],
			'profName'   => $row["profName"],
			'section'   => $row["section"],
			'subject'   => $row["subject"],
			'roomNumber'   => $row["roomNumber"],
			'startTime'   => $row["startTime"],
			'endTime'   => $row["endTime"],
			'date'   => $row["date"],
			'day'   => $row["day"],
			'duration'   => $row["duration"],
			'rfr'   => $row["rfr"],
			'status' => $row["status"]
		);
	}
	if(isset($_POST["action"])){
		action($_POST["action"],$_POST["reqID"]);
	}
	if(isset($_POST["backup"])){
		backup();
	}
?>
<!DOCTYPE html>
<html>
	<head>
	    <title>Admin | Classroom Reservation System</title>
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	    <link rel="stylesheet" type="text/css" href="css/admin.css">
        <link rel="stylesheet" href="css/bootstrap2.min.css">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/animate.css">
        <meta charset="utf-8">
  	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <style>
			.right_col{
				background-color: #f0efe9;	
				border-bottom: solid 10px #fff;	
				}
			.leftie
			{
				border-bottom: solid 10px #fff;	
			}
			body{
				background: url(img/bg1.jpg);
				background-size: 100%;
				width: 100%;
				height: auto;	
				}
			.space
			{
				padding-bottom:30px;
			}
			.buddy
			{
				width: 70px;
				text-align: center;
				font-size: 17px;	
			}
			.buddyz
			{
				width: 200px;
				font-size: 17px;
				text-align: center;
			}
			.h20
			{
				font-family: Oswald !important;	
			}
			.container {
				width: 1200px;
				height:auto;
				background-color: #FFF;
				margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
				border: 14px solid #fff;
				box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.50), 0 16px 20px 0 rgba(0, 0, 0, 0.19);
			}
			.cr
			{
				font-family: oswald;
				font-size: 50px;
				padding-left:30px;
			}
			.cr2
			{
				padding-left:30px;
				font-size: 18px;
			}
			#table_co
			{
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;	
			}
			#table_co td, #table_co tr 
			{
				/*border: 1px solid #ddd;*/
				padding: 8px;
			}
			
			#table_co tr:nth-child(even){background-color: #f2f2f2;}
			
			#table_co tr:hover {background-color: #ddd;}
			
			#table_co th 
			{
				padding-top: 12px;
				padding-bottom: 12px;
				text-align: center;
				background-color: #424242;
				color: white;
				border: 1px solid #ddd;
			}
			.ustlogo
			{
				padding-right:50px;
			}
			.y
			{
				width: 260px !important;
				height: 270px !important;
				padding-top:15px;	
				padding-bottom: 13px;
				padding-left:3px;
			}
			.bg {
				background-image: url("img/bg1.jpg");

				/* Full height */
				height: 100%; 

				/* Center and scale the image nicely */
				background-attachment: fixed;
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			}
			h3{
				font-family:Trajan PRO;
				font-weight:bold;
			}
			.logout{
				float:right;
				width:140px;
				height:40px;
				border:2px solid #922B21;
				background-color:#922B21;
				border-radius:4px;
				color:white;
				font-family:Trajan PRO;
			}
			.logout:hover{
				transition:.1s;
				color:#922B21;;
				background-color:white;
			}
		</style>
    	<script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>  
			jQuery(document).ready(function($) {
				$('#myCarousel').carousel({
						interval: 5000
				});
				$('#carousel-text').html($('#slide-content-0').html());
				//Handles the carousel thumbnails
			   $('[id^=carousel-selector-]').click( function(){
					var id = this.id.substr(this.id.lastIndexOf("-") + 1);
					var id = parseInt(id);
					$('#myCarousel').carousel(id);
				});
				// When the carousel slides, auto update the text
				$('#myCarousel').on('slid.bs.carousel', function (e) {
						 var id = $('.item.active').data('slide-number');
						$('#carousel-text').html($('#slide-content-'+id).html());
				});
			}); 	
		</script>
	</head>
	<body class="bg">
		<div class="container">
			<div class="main_container">
				<div class="row">
					<div class="col-md-3 left_col leftie">		
                    	<div id="carousel" class="carousel slide" data-ride="carousel" >
			                <div class="carousel-inner">
                    			<div class="item active">
                        			<img src="img/bg4.jpg" class="y" alt="First Slide" >
                    			</div>
                    			<div class="item">
                        			<img src="img/1.jpg" class="y" alt="First Slide" >
                    			</div>
                			</div>
                        </div>
					</div>
                    <div class="col-md-9 right_col"><br>
                    	<img src="img/ustlogo.png" width="775" height="71" class="ustlogo"><br>
						<h2 class="cr"> CLASSROOM RESERVATIONS</h2>
						<small class="cr2"> Accept/Decline room reservations.</small><br>
						<div class="col-lg-2" style="float:right">
						<form method="POST" action="index.php">
							<button type="submit" name="logout" class="logout">Logout</button>
						</form>
						</div>
						<div class="col-md-2" style="float:right">
						<form method="POST">
							<button type="submit" name="backup" class="logout">Backup</button>
						</form>
						</div>
					</div><br><br>
                	<?php	
							echo "<h3>Reservation Request/s</h3>";
							echo "<br class='space'>";
							echo "<table align='center' class='table' id='table_co'>";
              echo "<tr>
              <th class='headr'>ID</th>
              <th class='headr'>Professor Name</th>
              <th class='headr'>Subject</th>
              <th class='headr'>Section</th>
              <th class='headr'>Room</th>
              <th class='headr'>Start Time</th>
              <th class='headr'>End Time</th>
              <th class='headr'>Date</th>
              <th class='headr'>Day</th>
              <th class='headr'>Reason for Reserving</th>
              <th class='headr'>Status</th>
              <th class='headr'>Action</th>
              </tr>";
  
						foreach($data as $value){
							if($value["status"]=="pending"){
								$content = "<tr>
												<td class='buddy'>".$value["ID"]."</td>
												<td class='buddy'>".$value["profName"]."</td>
												<td class='buddy'>".$value["subject"]."</td>
												<td class='buddy'>".$value["section"]."</td>
												<td class='buddy'>".$value["roomNumber"]."</td>
												<td class='buddy'>".$value["startTime"]."</td>
												<td class='buddy'>".$value["endTime"]."</td>
												<td class='buddy'>".$value["date"]."</td>
												<td class='buddy'>".$value["day"]."</td>
												<td class='buddy'>".$value["rfr"]."</td>
												<td class='buddy'>".$value["status"]."</td>
												<td class='buddyz'><form method='POST'><button type='submit'  name='action' value='Accept' class='btn btn-info'>Accept</button>&nbsp;<button type='submit' name='action' value='Decline' class='btn btn-danger'>Decline</button><br><input type='hidden' value='".$value["ID"]."'name='reqID'></form></td>
											</tr>";
								echo $content;
							}
						}		     
	echo "</table>";
							echo "<h3>Approved Reservation/s</h3>";
						echo "<table align='center' class='table' id='table_co'>";
              echo "<tr>
                <th class='headr'>ID</th>
                <th class='headr'>Professor Name</th>
                <th class='headr'>Subject</th>
                <th class='headr'>Section</th>
                <th class='headr'>Room</th>
                <th class='headr'>Start Time</th>
                <th class='headr'>End Time</th>
                <th class='headr'>Date</th>
                <th class='headr'>Day</th>
                <th class='headr'>Reason for Reserving</th>
                <th class='headr'>Status</th>
                <th class='headr'>Action</th>
              </tr>";
						unset($value);
						echo "<br><br>";
						foreach($data as $value){
							if($value["status"]=="reserved"){
								$content = "<tr>
												<td class='buddy'>".$value["ID"]."</td>
												<td class='buddy'>".$value["profName"]."</td>
												<td class='buddy'>".$value["subject"]."</td>
												<td class='buddy'>".$value["section"]."</td>
												<td class='buddy'>".$value["roomNumber"]."</td>
												<td class='buddy'>".$value["startTime"]."</td>
												<td class='buddy'>".$value["endTime"]."</td>
												<td class='buddy'>".$value["date"]."</td>
												<td class='buddy'>".$value["day"]."</td>
												<td class='buddy'>".$value["rfr"]."</td>
												<td class='buddy'>".$value["status"]."</td>
												<td class='buddy'>
													<form method='POST'>
														<button type='submit' name='action' value='Cancel' class='btn btn-danger'>Cancel</button>
														<input type='hidden' value='".$value["ID"]."' name='reqID'>
													</form>
												</td>
											</tr>";
								echo $content;	
							}
						}
						echo "</table>";
					?>
			</div>
        </div>
	</div><br><br><br>
</body>
</html>