<?php
	function backup(){
		include 'log.php';
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		
		$backup = "CREATE TABLE testing.schedule SELECT * FROM itelec.schedule";
		$stmt = $connect->prepare($backup);
		$stmt->execute();	
		logAction("backup");
		echo '<script type="text/javascript">'; 
		echo 'alert("Backup Successful!");'; 
		echo '</script>';
	}
?>