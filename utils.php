<?php 


	function id_from_nick($nick, $pdo){
		$sql=" SELECT u.uid
				FROM utenti AS u
				WHERE u.nickname=? ";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$nick]);

		$id=0;
		
		foreach ($stmt as $row) {
			$id = $row['uid'];
		}

		if($id>0){
			return $id;
		}
		else{
			return 0;
		}
	}

	function nick_from_id($id, $pdo){
		$sql=" SELECT u.nickname
				FROM utenti AS u
				WHERE u.uid=? ";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$id]);
		
		foreach ($stmt as $row) {
			$nick = $row['nickname'];
		}

		if($id>0){
			return $nick;
		}
		else{
			return 0;
		}
	}

	
	function login($nick, $pass, $pdo){
		$sql="SELECT u.frasetta, u.foto
			  FROM utenti as u
			  where u.password_hash=? and u.nickname = ?";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$pass, $nick]);
	
		return $stmt->fetch();
		
	}


	function email_check($email,$pdo){
		$sql="SELECT 1
			  FROM utenti as u
			  where u.email=?";
		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$email]);
		$ris=0;	
		foreach ($stmt as $row) {
			$ris = $row[1];
		}

		if($ris==1){
			return $ris;
		}
		else{
			return 0;
		}
	}


	function nick_check($nick,$pdo){
		$sql="SELECT 1
			  FROM utenti as u
			  where u.nickname=?";
		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$nick]);
		$ris=0;
		foreach ($stmt as $row) {
			$ris = $row[1];
		}

		if($ris==1){
			return $ris;
		}
		else{
			return 0;
		}
	}

	function user_blocked($pdo, $id){

			$stmt = $pdo -> prepare("SELECT b.uid_a,(SELECT nickname
													FROM utenti
													WHERE uid = b.uid_a) AS nickname,
												(SELECT foto
												FROM utenti
												WHERE uid = b.uid_a) AS foto
									FROM utenti AS u
									JOIN Blocked AS b
									ON u.uid = b.uid_da
									WHERE u.uid=?");
			$stmt -> execute([$id]);
			return $stmt;
	}

	function removeBlocked($pdo, $idDa, $idA){

		$sql="DELETE from blocked
			  where uid_da = ? and uid_a = ?";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([$idDa,$idA]);


	}

	function addBlocked($pdo, $idDa, $idA){
		$sql="INSERT INTO blocked (uid_da,uid_a)
			  VALUES (?,?) ";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([$idDa,$idA]);
	}

	function change_nick_status($pdo, $id, $newNick, $newFras){
		
		$query = "UPDATE utenti as u
				  SET u.nickname = ?,
				  	  u.frasetta = ?
				  WHERE u.uid = ?";

		$stmt = $pdo -> prepare($query);

		$stmt -> execute ([$newNick,$newFras,$id]);
	}

	function if_online($uid, $pdo){
		 $query = "
			 SELECT * 
			 FROM activity 
			 WHERE uid = ?
			 ORDER BY last_a DESC 
			 LIMIT 1
			";
 			$stmt = $pdo->prepare($query);
			$stmt->execute([$uid]);

			if($stmt->rowCount() == 1)
		 		return 1;
		 	else 
		 		return 0;
			 
	}

	function lista_amici_ultimo_accesso($uid, $pdo){
		 $query = "
			 SELECT * 
			 FROM activity 
			 WHERE uid = ?
			 ORDER BY last_a DESC 
			 LIMIT 1
			";

			$stmt = $pdo->prepare($query);
		 	$stmt->execute([$uid]);

			if($stmt->rowCount() == 1)
		 		return 1;
		 	else 
		 		return 0;
			 
	}

	function frasetta($id, $pdo){

		$sql=" SELECT u.frasetta
				FROM utenti AS u
				WHERE u.uid=? ";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$id]);

		$frasetta='';
		
		foreach ($stmt as $row) {
			$frasetta = $row['frasetta'];
		}

		return $frasetta;
	}
	function friend($uid_da,$uid_a,$pdo){
		$sql="SELECT 1
			FROM amicizie AS a
			WHERE a.uid_da = ? AND a.uid_a=?";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$uid_da,$uid_a]);

		$ris=0;
		foreach ($stmt as $row) {
			$ris = $row[1];
		}

		if($ris==1){
			return $ris;
		}
		else{
			return 0;
		}
	}

	function is_blocked($uid_da,$uid_a,$pdo){
		$sql="SELECT 1
			FROM Blocked as b
			WHERE b.uid_da = ? AND b.uid_a=?";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$uid_da,$uid_a]);

		$ris=0;
		
		foreach ($stmt as $row) {
			$ris = $row[1];
		}

		if($ris==1){
			return $ris;
		}
		else{
			return 0;
		}
	}



?>