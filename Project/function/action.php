<?php
	function action($action, $reqID){
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		$query = null;
		
		if($action=="Accept"){
			$query = "UPDATE schedule SET status = 'reserved' WHERE reqID =".$reqID;
		}
		else if($action=="Decline"||$action=="Cancel"){
			$query = "DELETE FROM schedule WHERE reqID =".$reqID;
		}
		
		$stmt = $connect->prepare($query);

		$stmt->execute();
	}
?>