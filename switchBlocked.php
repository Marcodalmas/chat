<?php
	include_once 'dbConnection.php';
	include_once 'utils.php';

	$uid = $_POST['uid']??'0';
	$id = $_POST['id']??'0';


	echo "<style type='text/css'>
		body {
		  font-family: Arial;
		  color: white;
		}
		td {
		  width 100px;
		}
		</style>";




	if($id == '0'){
		//aggiornamento tabella
		$stmt = user_blocked($pdo, $uid);
		echo "<div  class='col-md-offset-5'";
		echo "<table>";
		foreach ($stmt as $user) {
			echo "<tr>";
			$foto =$user['foto'];
			$idb = id_from_nick($user['nickname'], $pdo);
			if ($foto==0) {	 
				echo "<td><img src=\"foto/0.png\" class=\"p-2 m-2\" width=\"50\" height=\"50\"></td><td>".$user['nickname']."</td>";
			}
			else{
				echo "<td><img src=\"foto/$idb.png\" class=\"p-2 m-2\" width=\"50\" height=\"50\"></td><td>".$user['nickname']."</td>";
			}
			echo "<td><button type='button' onclick='remove($uid,$idb);'class='btn btn-success' style='margin-left:10px;'><i class='fa fa-unlock'></i></button></td><br></tr>";
		}
		echo "</table></div>";
	}
	else{
		//rimuovo
		removeBlocked($pdo, $uid, $id);
	}

