<?php 

	include_once 'utils.php';
	include_once 'dbConnection.php';

	session_start();
	$id = $_SESSION['id'];
	
	if(isset($_REQUEST['dest']) && isset($_REQUEST['mex'])){

		/*$sql=" SELECT u.uid
				FROM utenti AS u
				WHERE u.nickname=? ";

		$stmt = $pdo -> prepare($sql);
		$nickname=$_REQUEST['dest'];
		$stmt -> execute([$nickname]);
		

		foreach ($stmt as $row) {
		 $destid = $row['uid'];
		}*/
		
		//usa funzione

		$destid = id_from_nick($_REQUEST['dest'], $pdo);

		//fine uso funzione

	  	//in base al risultato dell' id (trovato o no)
	  	if($destid!=0){

			$mex=$_REQUEST['mex'];

			$sql2=" insert INTO messaggi (testo,e_uid,e_quando,r_uid)
					VALUES (?,?,CURRENT_DATE(),?) ";

			$stmt2 = $pdo -> prepare($sql2);

			$stmt2 -> execute([$mex,$id,$destid]);

			header('Location: chat.php?successo=1');
			exit();

	  	}
	  	else{
			header('Location: chat.php?successo=0');
			exit();
	  	}
	  	//fine parte con risultato funzione


		/*$mex=$_REQUEST['mex'];

		$sql2=" insert INTO messaggi (testo,e_uid,e_quando,r_uid)
				VALUES (?,?,CURRENT_DATE(),?) ";
		$stmt2 = $pdo -> prepare($sql2);
		$stmt2 -> execute([$mex,$id,$destid]);*/
	}
	//header('Location: chat.php?successo=1');
	//exit();
	
 ?>