<?php
	
	include_once 'dbConnection.php';
    session_start();

    $id = $_SESSION['id'];

    $stmt = $pdo->prepare('DELETE FROM activity 
		  				   WHERE uid = ?');

    $stmt->execute([$id]);

    $_SESSION = [];

    session_destroy();

    header('Location: login.php');

    exit();