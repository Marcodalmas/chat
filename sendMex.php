<?php 

	include_once 'dbConnection.php';

	session_start();

	$id = $_SESSION['id'];
	$testo = $_REQUEST['testo'];
	$idA = $_REQUEST['idA'];

	$query = 'INSERT INTO messaggi(testo, e_uid, e_quando, r_uid)
			  VALUES (?,?,CURRENT_TIMESTAMP,?)';

	$stmt = $pdo->prepare($query);

	$stmt->execute([$testo,$id,$idA]);