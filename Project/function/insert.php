<?php
	function request($profName,$section,$subject,$roomNumber,$startTime,$date,$day,$duration,$rfr){
		include 'log.php';
		include 'loadClass.php';
		include 'loadPending.php';
		include 'loadReserved.php'; 

		$connect = new PDO('mysql:host=localhost;dbname=itelec','root','root');
		
		$endTime = date("H:i:s",strtotime("+".$duration." minutes",strtotime($startTime)));
			
		$class = loadClass($roomNumber,$day);
		//$pending = loadPending($roomNumber,$date);
		//$reserved = loadReserved($roomNumber,$date);
		$boolean = false;
		foreach($class as $val){
			if(strtotime($endTime)>strtotime($val["startTime"])&&strtotime($endTime)<=strtotime($val["endTime"])){
				echo "hello";
				$boolean = true;		
				echo '<script type="text/javascript">'; 
				echo 'alert("Classes are scheduled during those periods!");'; 
				echo 'window.location.href = "schedule.php"';
				echo '</script>';
				break;
			}
		}
		if($boolean == false){		
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
	}
?>