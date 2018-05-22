<?php
	function loadReserved($room,$date){
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		$data = array();
		$query = "SELECT * FROM schedule WHERE roomNumber = '".$room."' AND date = '".$date."' AND status = 'reserved'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		
		return $result;	
	}
?>