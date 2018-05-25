<?php
	function backup(){
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		
		$backup = "CREATE TABLE testing.schedule SELECT * FROM itelec.schedule";
		$stmt = $connect->prepare($backup);
		$stmt->execute();	
		echo '<script type="text/javascript">'; 
		echo 'alert("Backup Successful!");'; 
		echo '</script>';
	}
?>