<?php

	$dbhost = "localhost";
	$dbuser = "issuetracker";
	$dbpass = "Gxj6E4JjXPpKPw5f";
	$dbname = "issuetracker";
	
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_errno()) {
		die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ").");	
    }

    mysqli_set_charset($connection, "utf8");
?>