<?php
	function login($username,$password){
		$conn = new mysqli("localhost", "root", "root", "itelec");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM admin";
		$result = $conn->query($sql);
		foreach($result as $value){
			if($value["username"]==$username && $value["password"]==$password){
				$_SESSION["loggedin"] = "Logged-in"; 
				echo '<script type="text/javascript">'; 
				echo 'alert("Login Successful");'; 
				echo 'window.location.href = "admin.php";';
				echo '</script>';	
			}
			else{
				echo '<script type="text/javascript">'; 
				echo 'alert("Incorrect Username or Password");'; 
				echo 'window.location.href = "index.php";';
				echo '</script>';		
			}
		}
	}
?>