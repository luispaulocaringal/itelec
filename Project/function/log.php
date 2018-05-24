<?php
	function logAction($log){
		$logs = array("login"=>"[IT001]-Logged in as administrator.",
					"logout"=>"[IT002]-Administrator account logged out.",
					"request"=>"[IT003]-New schedule request.",
					"accept"=>"[IT004]-Accepted request for reservation",
					"Decline"=>"[IT005]-Declined request for reservation",
					"Cancel"=>"[IT006]-Request for reservation cancelled"
					);
		
		
		$log_file = "log_file.txt";
		$handle = fopen($log_file, 'a') or die('Cannot open file:  '.$log_file);
		
		$data = "\r\n".$logs[$log]."[".date("Y-m-d")."][".date("h:i:sa")."]";
		fwrite($handle, $data);
		
		fclose($handle);
	}
?>