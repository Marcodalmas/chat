<?php 

	include_once 'dbConnection.php';
	include_once 'utils.php';
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

		if (if_online($row['uid_a'],$pdo)) {
			
			$stato='<i style="background-color:green"></i>';

		}
		else{

			$stato='<i style="background-color:red"></i>';

		}

		echo "<button type='button' class='btn btn-primary friends start_chat'  onclick='view($row[uid_a])'>";

		if($row['foto'] == 1){
			echo "<img src='foto/$id.png' class='img rounded-circle'>";
		}
		else{
			echo "<img src='foto/0.png' class='img rounded-circle'>";
		}
		echo "&nbsp;".$stato;
		echo "$row[nickname]</button><br>";
	}
	echo "</div>";



 ?>