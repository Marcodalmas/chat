<?php 
	include_once 'dbConnection.php';
	session_start();

	$uid_da=$_SESSION['id']??0;
	$uid_a=$_REQUEST['idA']??0;

	$query = 'SELECT m.e_uid, m.testo, m.e_quando
			  FROM messaggi AS m
			  WHERE (m.e_uid = ? AND m.r_uid = ?) OR (m.e_uid = ? AND m.r_uid = ?)
			  ORDER BY m.e_quando DESC ';

	$stmt = $pdo -> prepare($query);
	$stmt -> execute([$uid_da,$uid_a,$uid_a,$uid_da]);


	foreach ($stmt as $mex) {

		if ($mex['e_uid']==$uid_da) {
			//dx io mittente
			echo"<div class='containerC'>";
			echo"<p>$mex[testo]<p>";
			echo"<span class='time-right'>$mex[e_quando]</span>";
			echo"</div>";
		}
		else{
			//sx ricevente
			echo"<div class='containerC darker'>";
			echo"<p>$mex[testo]<p>";
			echo"<span class='time-left'>$mex[e_quando]</span>";
			echo"</div>";
		}
	}

	echo "<div class='footer row'>
        	<input type='text' id='messaggio' placeholder='Inserire messaggio'>
        	<button onclick='sendMessage($uid_a)'><i class='fa fa-send'></i></button>
          </div>";
?>
