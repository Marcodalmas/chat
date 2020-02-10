<?php 
	session_start();
	$_Session=[];
	session_destroy();
	header('Location: login.php');
	exit();




?>