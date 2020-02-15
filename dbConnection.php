<?php
try {
		$pdo= new pdo("mysql:host=localhost;dbname=id12500325_chat",'root','');
	} catch (pdoException $e) {
		echo"fail";
	}

	function lista_amici_ultimo_accesso($uid, $pdo){
	 $query = "
		 SELECT * 
		 FROM login_details 
		 WHERE uid = '$uid' 
		 ORDER BY last_a DESC 
		 LIMIT 1
		";

		 $stmt = $pdo->prepare($query);
		 $stmt->execute();
		 $result = $stmt->fetchAll();
		 foreach($result as $row)
		 {
		  return $row['last_a'];
		 }
}

?>