<?php 
	include_once 'dbConnection.php';
	session_start();

	$uid_da=$_SESSION['id']??0;
	$uid_a=$_REQUEST['idA']??0;

	$query = 'SELECT * 
			  FROM (SELECT m.e_uid AS e_uid, m.testo AS testo, m.e_quando AS e_quando
					FROM messaggi AS m
					WHERE (m.e_uid = ? AND m.r_uid = ?) OR (m.e_uid = ? AND m.r_uid = ?)
					ORDER BY m.e_quando DESC
					LIMIT 50) AS t
			  ORDER BY t.e_quando';

	$stmt = $pdo -> prepare($query);
	$stmt -> execute([$uid_da,$uid_a,$uid_a,$uid_da]);
	echo '<div class="row"><div class="col">';
	echo "<input type='hidden' id='idA' value='$uid_a'>";
	foreach ($stmt as $mex) :
		$classeCSS = $mex['e_uid']==$uid_da ? 'containerM' : 'containerD';?>
		<div class='<?=$classeCSS?>'>
		<p style='color: black;'><?=$mex['testo']?><p>
		<span class='time-left'><?=$mex['e_quando']?></span>
		</div>
	<?php endforeach; ?>
	</div></div>