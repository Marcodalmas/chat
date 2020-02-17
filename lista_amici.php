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
			
			$stato='<i class="fa fa-user" style="background-color:green"></i>';

		}
		else{

			$stato='<i class="fa fa-user" style="background-color:red"></i>';

		}

		if($row['foto'] == 1){
			echo "<button type='button' class='btn btn-primary friends start_chat'  onclick='view($row[uid_a])'>
									<img src='foto/$id.png' class='img'>"
									;
									echo "$stato";
									echo "$row[nickname]</button><br>";
		}
		else{
			echo "<button type='button' class='btn btn-primary friends start_chat'  onclick='view($row[uid_a])'>
							<img src='foto/0.png' class='img'>";
							echo "$stato";
							echo "$row[nickname]</button><br>";
		}
	}
	echo "</div>";



 ?>