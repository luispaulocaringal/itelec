<?php
	function action($action, $reqID){
		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		$query = null;
		
		if($action=="Accept"){
			$query = "UPDATE schedule SET status = 'reserved' WHERE reqID =".$reqID;
			include 'log.php';
			logAction("accept");
			header("Location:admin.php");
		}
		else if($action=="Decline"||$action=="Cancel"){
			$query = "DELETE FROM schedule WHERE reqID =".$reqID;
			include 'log.php';
			logAction($action);
			header("Location:admin.php");
		}
		
		$stmt = $connect->prepare($query);

		$stmt->execute();
	}
?>