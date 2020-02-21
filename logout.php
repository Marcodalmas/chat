<?php
	
	include_once 'dbConnection.php';
    session_start();

    $id = $_SESSION['id'];

    $stmt = $pdo->prepare('DELETE FROM activity 
		  				   WHERE uid = ?');

    $stmt->execute([$id]);

    $_SESSION = [];

    session_destroy();

    if(isset($_GET['sess']) && $_GET['sess']=='scaduta')
        $sess = 'scaduta';
    else    
        $sess = '';
    header('Location: login.php?sess='.$sess);

    exit();