<?php 


	function id_from_nick($nick, $pdo){
		$sql=" SELECT u.uid
				FROM utenti AS u
				WHERE u.nickname=? ";

		$stmt = $pdo -> prepare($sql);

		$stmt -> execute([$nick]);
		
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

		$stmt -> execute([$nick]);
		
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

			$stmt = $pdo -> prepare("SELECT a.uid_a,(SELECT nickname
													FROM utenti
													WHERE uid = a.uid_a) AS nickname,
												(SELECT foto
												FROM utenti
												WHERE uid = a.uid_a) AS foto
									FROM utenti AS u
									JOIN amicizie AS a
									ON u.uid = a.uid_da
									WHERE u.uid=?
									AND a.sospensione = 'S'");
			$stmt -> execute([$id]);
			return $stmt;
	}

	function removeBlocked($pdo, $uid, $id){

		$query = "UPDATE amicizie
				  SET sospensione = 'N'
				  WHERE uid_da = ? AND uid_a = ?";

		$stmt = $pdo->prepare($query);

		$stmt->execute([$uid,$id]);
	}

	function change_nick_status($pdo, $id, $newNick, $newFras){
		
		$query = "UPDATE utenti as u
				  SET u.nickname = ?,
				  	  u.frasetta = ?
				  WHERE u.uid = ?";

		$stmt = $pdo -> prepare($query);

		$stmt -> execute ([$newNick,$newFras,$id]);
	}


 ?>