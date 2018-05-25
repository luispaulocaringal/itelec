<?php
	function loadSchedule($room,$date,$day){
		
		include 'loadClass.php';
		include 'loadReserved.php';
		include 'loadPending.php';
		
		$class = loadClass($room,$day);
		$pending = loadPending($room,$date);
		$reserved = loadReserved($room,$date);
		
		$status = array("07:00:00"=>null,
						"07:30:00"=>null,
						"08:00:00"=>null,
						"08:30:00"=>null,
						"09:00:00"=>null,
						"09:30:00"=>null,
						"10:00:00"=>null,
						"10:30:00"=>null,
						"11:00:00"=>null,
						"11:30:00"=>null,
						"12:00:00"=>null,
						"12:30:00"=>null,
						"13:00:00"=>null,
						"13:30:00"=>null,
						"14:00:00"=>null,
						"14:30:00"=>null,
						"15:00:00"=>null,
						"15:30:00"=>null,
						"16:00:00"=>null,
						"16:30:00"=>null,
						"17:00:00"=>null,
						"17:30:00"=>null,
						"18:00:00"=>null,
						"18:30:00"=>null,
						"19:00:00"=>null,
						"19:30:00"=>null,
						"20:00:00"=>null,
						"20:30:00"=>null);
		
		$profName = array("07:00:00"=>null,
						"07:30:00"=>null,
						"08:00:00"=>null,
						"08:30:00"=>null,
						"09:00:00"=>null,
						"09:30:00"=>null,
						"10:00:00"=>null,
						"10:30:00"=>null,
						"11:00:00"=>null,
						"11:30:00"=>null,
						"12:00:00"=>null,
						"12:30:00"=>null,
						"13:00:00"=>null,
						"13:30:00"=>null,
						"14:00:00"=>null,
						"14:30:00"=>null,
						"15:00:00"=>null,
						"15:30:00"=>null,
						"16:00:00"=>null,
						"16:30:00"=>null,
						"17:00:00"=>null,
						"17:30:00"=>null,
						"18:00:00"=>null,
						"18:30:00"=>null,
						"19:00:00"=>null,
						"19:30:00"=>null,
						"20:00:00"=>null,
						"20:30:00"=>null);
		
		$subject = array("07:00:00"=>"<font color='#27AE60'>Available</font>",
						"07:30:00"=>"<font color='#27AE60'>Available</font>",
						"08:00:00"=>"<font color='#27AE60'>Available</font>",
						"08:30:00"=>"<font color='#27AE60'>Available</font>",
						"09:00:00"=>"<font color='#27AE60'>Available</font>",
						"09:30:00"=>"<font color='#27AE60'>Available</font>",
						"10:00:00"=>"<font color='#27AE60'>Available</font>",
						"10:30:00"=>"<font color='#27AE60'>Available</font>",
						"11:00:00"=>"<font color='#27AE60'>Available</font>",
						"11:30:00"=>"<font color='#27AE60'>Available</font>",
						"12:00:00"=>"<font color='#27AE60'>Available</font>",
						"12:30:00"=>"<font color='#27AE60'>Available</font>",
						"13:00:00"=>"<font color='#27AE60'>Available</font>",
						"13:30:00"=>"<font color='#27AE60'>Available</font>",
						"14:00:00"=>"<font color='#27AE60'>Available</font>",
						"14:30:00"=>"<font color='#27AE60'>Available</font>",
						"15:00:00"=>"<font color='#27AE60'>Available</font>",
						"15:30:00"=>"<font color='#27AE60'>Available</font>",
						"16:00:00"=>"<font color='#27AE60'>Available</font>",
						"16:30:00"=>"<font color='#27AE60'>Available</font>",
						"17:00:00"=>"<font color='#27AE60'>Available</font>",
						"17:30:00"=>"<font color='#27AE60'>Available</font>",
						"18:00:00"=>"<font color='#27AE60'>Available</font>",
						"18:30:00"=>"<font color='#27AE60'>Available</font>",
						"19:00:00"=>"<font color='#27AE60'>Available</font>",
						"19:30:00"=>"<font color='#27AE60'>Available</font>",
						"20:00:00"=>"<font color='#27AE60'>Available</font>",
						"20:30:00"=>"<font color='#27AE60'>Available</font>");
						
	foreach($class as $val){
		for($time = strtotime($val["startTime"]);$time<=strtotime("-30 minutes",strtotime($val["endTime"]));$time = strtotime("+30 minutes",$time)){
			$status[date("H:i:s",$time)] = "class";
			$subject[date("H:i:s",$time)] = $val["subject"];
			$profName[date("H:i:s",$time)] = " - ".$val["profName"];
		}
	}
	foreach($pending as $val){
		for($time = strtotime($val["startTime"]);$time<=strtotime("-30 minutes",strtotime($val["endTime"]));$time = strtotime("+30 minutes",$time)){
			$status[date("H:i:s",$time)] = "pending";
			$subject[date("H:i:s",$time)] = "pending";
		}
	}
	foreach($reserved as $val){
		for($time = strtotime($val["startTime"]);$time<=strtotime("-30 minutes",strtotime($val["endTime"]));$time = strtotime("+30 minutes",$time)){
			$status[date("H:i:s",$time)] = "reserved";
			$subject[date("H:i:s",$time)] = $val["subject"];
			$profName[date("H:i:s",$time)] = " - ".$val["profName"];
		}
	}
		$content = "
					<form method='POST' action='form.php'>
						<table align='center'>
							<tr>
								<th class='time'>Time</th>
								<th>Status</th>
								<th class='info'>Info</th>
							</tr>
							<tr>
								<td class='time' rowspan='2'>07:00 am</td>
								<td class='hour'></td>
								<td class='info hour'></td>
							</tr>
							<tr>
								<td class='".$status["07:00:00"]."'><input type='submit' class='field' name='time' value='07:00:00'></td>
								<td class='info'>".$subject["07:00:00"]." ".$profName["07:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>08:00 am</td>
								<td class='".$status["07:30:00"]." hour'><input type='submit' class='field' name='time' value='07:30:00'></td>
								<td class='info hour'>".$subject["07:30:00"]." ".$profName["07:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["08:00:00"]."'><input type='submit' class='field' name='time' value='08:00:00'></td>
								<td class='info'>".$subject["08:00:00"]." ".$profName["08:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>09:00 am</td>
								<td class='".$status["08:30:00"]." hour'><input type='submit' class='field' name='time' value='08:30:00'></td>
								<td class='info hour'>".$subject["08:30:00"]." ".$profName["08:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["09:00:00"]."'><input type='submit' class='field' name='time' value='09:00:00'></td>
								<td class='info'>".$subject["09:00:00"]." ".$profName["09:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>10:00 am</td>
								<td class='".$status["09:30:00"]." hour'><input type='submit' class='field' name='time' value='09:30:00'></td>
								<td class='info hour'>".$subject["09:30:00"]." ".$profName["09:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["10:00:00"]."'><input type='submit' class='field' name='time' value='10:00:00'></td>
								<td class='info'>".$subject["10:00:00"]." ".$profName["10:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>11:00 am</td>
								<td class='".$status["10:30:00"]." hour'><input type='submit' class='field' name='time' value='10:30:00'></td>
								<td class='info hour'>".$subject["10:30:00"]." ".$profName["10:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["11:00:00"]."'><input type='submit' class='field' name='time' value='11:00:00'></td>
								<td class='info'>".$subject["11:00:00"]." ".$profName["11:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>12:00 nn</td>
								<td class='".$status["11:30:00"]." hour'><input type='submit' class='field' name='time' value='11:30:00'></td>
								<td class='info hour'>".$subject["11:30:00"]." ".$profName["11:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["12:00:00"]."'><input type='submit' class='field' name='time' value='12:00:00'></td>
								<td class='info'>".$subject["12:00:00"]." ".$profName["12:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>01:00 pm</td>
								<td class='".$status["12:30:00"]." hour'><input type='submit' class='field' name='time' value='12:30:00'></td>
								<td class='info hour'>".$subject["12:30:00"]." ".$profName["12:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["13:00:00"]."'><input type='submit' class='field' name='time' value='13:00:00'></td>
								<td class='info'>".$subject["13:00:00"]." ".$profName["13:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>02:00 pm</td>
								<td class='".$status["13:30:00"]." hour'><input type='submit' class='field' name='time' value='13:30:00'></td>
								<td class='info hour'>".$subject["13:30:00"]." ".$profName["13:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["14:00:00"]."'><input type='submit' class='field' name='time' value='14:00:00'></td>
								<td class='info'>".$subject["14:00:00"]." ".$profName["14:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>03:00 pm</td>
								<td class='".$status["14:30:00"]." hour'><input type='submit' class='field' name='time' value='14:30:00'></td>
								<td class='info hour'>".$subject["14:30:00"]." ".$profName["14:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["15:00:00"]."'><input type='submit' class='field' name='time' value='15:00:00'></td>
								<td class='info'>".$subject["15:00:00"]." ".$profName["15:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>04:00 pm</td>
								<td class='".$status["15:30:00"]." hour'><input type='submit' class='field' name='time' value='15:30:00'></td>
								<td class='info hour'>".$subject["15:30:00"]." ".$profName["15:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["16:00:00"]."'><input type='submit' class='field' name='time' value='16:00:00'></td>
								<td class='info'>".$subject["16:00:00"]." ".$profName["16:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>05:00 pm</td>
								<td class='".$status["16:30:00"]." hour'><input type='submit' class='field' name='time' value='16:30:00'></td>
								<td class='info hour'>".$subject["16:30:00"]." ".$profName["16:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["17:00:00"]."'><input type='submit' class='field' name='time' value='17:00:00'></td>
								<td class='info'>".$subject["17:00:00"]." ".$profName["17:00:00"]."</td>
							</tr>
							<tr>
								<td class='time'  rowspan='2'>06:00 pm</td>
								<td class='".$status["17:30:00"]." hour'><input type='submit' class='field' name='time' value='17:30:00'></td>
								<td class='info hour'>".$subject["17:30:00"]." ".$profName["17:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["18:00:00"]."'><input type='submit' class='field' name='time' value='18:00:00'></td>
								<td class='info'>".$subject["18:00:00"]." ".$profName["18:00:00"]."</td>
							</tr>
							<tr>
								<td class='time' rowspan='2'>07:00 pm</td>
								<td class='".$status["18:30:00"]." hour'><input type='submit' class='field' name='time' value='18:30:00'></td>
								<td class='info hour'>".$subject["18:30:00"]." ".$profName["18:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["19:00:00"]."'><input type='submit' class='field' name='time' value='19:00:00'></td>
								<td class='info'>".$subject["19:00:00"]." ".$profName["19:00:00"]."</td>
							</tr>
							<tr>
								<td class='time' rowspan='2'>08:00 pm</td>
								<td class='".$status["19:30:00"]." hour'><input type='submit' class='field' name='time' value='19:30:00'></td>
								<td class='info hour'>".$subject["19:30:00"]." ".$profName["19:30:00"]."</td>
							</tr>
							<tr>
								<td class='".$status["20:00:00"]."'><input type='submit' class='field' name='time' value='20:00:00'></td>
								<td class='info'>".$subject["20:00:00"]." ".$profName["20:00:00"]."</td>
							</tr>
							<tr>
								<td class='time' rowspan='2'>09:00 pm</td>
								<td class='".$status["20:30:00"]." hour'><input type='submit' class='field' name='time' value='20:30:00'></td>
								<td class='info hour'>".$subject["20:30:00"]." ".$profName["20:30:00"]."</td>
							</tr>
							<tr>
								<td style='border-bottom:none'></td>
								<td style='border-bottom:none' class='info'></td>
							</tr>
						</table>
					</form>";
		echo $content;
	}
?>