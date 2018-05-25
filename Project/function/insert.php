<?php
	function request($profName,$section,$subject,$roomNumber,$startTime,$date,$day,$duration,$rfr){
		include 'log.php';
		include 'loadClass.php';
		include 'loadPending.php';
		include 'loadReserved.php'; 

		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		
		$endTime = date("H:i:s",strtotime("+".$duration." minutes",strtotime($startTime)));
		
		$query = "INSERT INTO schedule(profName,section,subject,roomNumber,startTime,endTime,date,day,duration,rfr,status) VALUES ('".$profName."','".$section."','".$subject."',".$roomNumber.",'".$startTime."','".$endTime."','".$date."','".$day."',".$duration.",'".$rfr."','pending')";
		$stmt = $connect->prepare($query);


		$stmt->execute();

		logAction("request");
		
		session_destroy();
		
		echo '<script type="text/javascript">'; 
		echo 'alert("Request sent!");'; 
		echo 'window.location.href = "index.php"';
		echo '</script>';
	}
?>