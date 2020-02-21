<?php 

	include_once 'dbConnection.php';
    include_once 'utils.php';

	session_start();
	$idDa=$_SESSION['id'];
	$nickDa=$_SESSION['nick'];
	$idA=$_REQUEST['id'];
	$nick=nick_from_id($idA,$pdo);

	//codice action add 112 azione di gestione amicizie(1) richiesta di aggiunta(1) (2 è la richiesta che potra terminare in 0 o 1)

	//codice action rem 122 azione di gestione amicizie(1) richiesta di rimozione(1) (2 è la richiesta che potra terminare in 0 o 1)

	if ($_REQUEST['action']=='add') {
		$sql="INSERT INTO amicizie (uid_da,uid_a)
			  VALUES (?,?) ";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([$idDa,$idA]);

		print_r($stmt);

		if ($stmt > 0) {
			header("Location: showProfile.php?utente=$nick&action=11");
				exit();
		}
		else{
			header("Location: showProfile.php?utente=$nick&action=10");
				exit();
		}

	}

	if ($_REQUEST['action']=='rem') {
		$sql="DELETE from amicizie 
			  where uid_da = ? and uid_a = ?";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([$idDa,$idA]);

		print_r($stmt->fetchAll());

		if ($stmt > 0) {
			header("Location: showProfile.php?utente=$nick&action=11");
				exit();
		}
		else{
			header("Location: showProfile.php?utente=$nick&action=11");
				exit();
		}
	}

	if ($_REQUEST['action']=='block') {
		
		addBlocked($pdo,$idDa,$idA);
		header("Location: showProfile.php?utente=$nick&action=11");
		exit();
	}

	if ($_REQUEST['action']=='rblock') {
		
		removeBlocked($pdo,$idDa,$idA);
		header("Location: showProfile.php?utente=$nick&action=11");
		exit();
	}
?>
