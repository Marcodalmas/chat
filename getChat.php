<?php 
	include_once 'dbConnection.php';
	session_start();

	$uid_da=$_SESSION['id']??0;
	$uid_a=$_REQUEST['idA']??0;

	$query = 'SELECT m.e_uid, m.testo, m.e_quando
			  FROM messaggi AS m
			  WHERE (m.e_uid = ? AND m.r_uid = ?) OR (m.e_uid = ? AND m.r_uid = ?)
			  ORDER BY m.e_quando DESC
			  LIMIT 50 ';

	$stmt = $pdo->prepare($query);
	$stmt->execute([$uid_da,$uid_a,$uid_a,$uid_da]);

	$info = 'SELECT * FROM utenti WHERE uid = ?';

	$stmt2 = $pdo->prepare($info);
	$stmt2->execute([$uid_a]);

	echo '<div class="header row"style="padding: 6%">';

	$info_user = $stmt2->fetch();

	if($info_user['foto']==0)
		echo '<img src=\"foto/0.png\" class=\"rounded-circle p-2 m-2\" width=\"80\" height=\"80\">';
	else
		echo '<img src=\"foto/$uid_da.png\" class=\"rounded-circle p-2 m-2\" width=\"80\" height=\"80\">';
	echo '<div class=\"col\">
            <h2>'.$info_user['nickname'].'</h2>
            <div>'.$info_user['frasetta'].'</div>
	      </div></div>';

	echo "<input type='hidden' id='idA' value='$uid_a'>";
	foreach ($stmt as $mex) {

		if ($mex['e_uid']==$uid_da) {
			//dx io mittente
			echo"<div class='containerC'>";
			echo"<p style='color: black;'>$mex[testo]<p>";
			echo"<span class='time-right'>$mex[e_quando]</span>";
			echo"</div>";
		}
		else{
			//sx ricevente
			echo"<div class='containerC darker'>";
			echo"<p style='color: black;'>$mex[testo]<p>";
			echo"<span class='time-left'>$mex[e_quando]</span>";
			echo"</div>";
		}
	}

?>
