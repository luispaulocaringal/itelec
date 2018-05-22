<?php
	function getCurrentDate(){
		$date = $_SESSION["currentYear"]."-".$_SESSION["currentMonth"]."-".$_SESSION["currentDate"];
		return $date;
	}
	
	function getWeekday($date){
		return date('w', strtotime($date));
	}
	
	function getDay($date){
		$day = null;	
		switch($date){
			case 1: $day = "Monday";
					break;
			case 2: $day = "Tuesday";
					break;
			case 3: $day = "Wednesday";
					break;
			case 4: $day = "Thursday";
					break;
			case 5: $day = "Friday";
					break;
			case 6: $day = "Saturday";
					break;
			case 0: $day = "Sunday";
					break;
		}
		return $day;
	}
?>