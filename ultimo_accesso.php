<?php

	include_once 'dbConnection.php';

	session_start();

	$logdid = $_SESSION['logdid'];

	$query="UPDATE login_details
	set last_a = CURRENT_TIMESTAMP
	where logdid = ?" ;

	$stmt -> $pdo -> prepare($query);

	$stmt -> exeute([$logdid]);



 ?>