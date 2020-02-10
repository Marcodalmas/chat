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



 ?>