<?php 

	include_once 'dbConnection.php';

	session_start();

	$logdid = $_SESSION['logdid'];
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	$sql="SELECT a.uid_a, (SELECT nickname 
					FROM utenti 
					WHERE uid = a.uid_a) AS nickname, (SELECT foto
																  FROM utenti 
																  WHERE uid = a.uid_a) AS foto
			FROM utenti AS u
			JOIN amicizie AS a ON u.uid = a.uid_da
			WHERE u.uid = ?";

	$stmt = $pdo->prepare($sql);

	$stmt->execute([$id]);
	echo"<div class='btn-group-vertical' style='width: 99%'>";

	foreach ($stmt as $row) {
		$stato='';
		$current_timestamp= strtotime(date('Y-m-d H:i:s'). '-10 second');
		$current_timestamp= date('Y-m-d H:i:s',  $current_timestamp);
		$utente_last_a= lista_amici_ultimo_accesso($row['uid_a'],$pdo);

		if ($utente_last_a > $current_timestamp) {
			
			$stato='<span class="label label-success">Online</span>';

		}
		else{

			$stato='<span class="label label-danger">Offline</span>';

		}

		if($row['foto'] == 1){
			echo "<button type='button' class='btn btn-primary friends start_chat'  data-a_uid='$row[uid_a]'>
									<img src='foto/$id.png' class='img'>";
									echo "$stato";
									echo ";$row[nickname]</button><br>";
		}
		else{
			echo "<button type='button' class='btn btn-primary friends start_chat'  data-a_uid='$row[uid_a]'>
							<img src='foto/0.png' class='img'>";
							echo "$stato";
							echo ";$row[nickname]</button><br>";
		}
	}
	echo "</div>";



 ?>