<?php
	function loadClass($room,$day){
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		$data = array();
		$query = "SELECT * FROM schedule WHERE roomNumber = '".$room."' AND day = '".$day."' AND status = 'class'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		
		return $result;
	}
?>