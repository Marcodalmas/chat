<?php
try {
		$pdo= new pdo("mysql:host=localhost;dbname=id12500325_chat",'root','');
	} catch (pdoException $e) {
		echo"fail";
	}

	function lista_amici_ultimo_accesso($id, $pdo)
{
 $query = "
 SELECT * FROM login_details 
 WHERE uid = '$id' 
 ORDER BY last_a DESC 
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_a'];
 }
}

?>