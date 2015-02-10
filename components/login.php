<?php
	
	session_start();
	
	include("database.php");
	
	if(isset($_POST['username'])) {
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM user WHERE username = '". $username ."' AND password ='". $password ."' LIMIT 1";
		
		$result = mysqli_query($connection, $sql);
		
		if(mysqli_num_rows($result) == 1){
			
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			
			$sql_user_id = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
			$result_user_id = mysqli_query($connection, $sql_user_id);
			
			$user_id = mysqli_fetch_array($result_user_id, MYSQLI_BOTH);
			
			$_SESSION['user_id'] = $user_id["id"];
			
			header("Location: ../home.php");
			exit();
			
		} else {
			echo "Invalid login information!";
			
		}
	}
?>