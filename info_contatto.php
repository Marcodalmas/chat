<?php

    include_once 'dbConnection.php';
    include_once 'utils.php';
	$uid_a=$_REQUEST['idA']??0;

	$query = 'SELECT * FROM utenti WHERE uid = ?';

	$stmt = $pdo -> prepare($query);
	$stmt -> execute([$uid_a]);

    $user = $stmt->fetch();

    if($user['foto']==0)
        echo "<img src='foto/0.png' class='rounded-circle p-2' width='80' height='80'>";
    else    
        echo "<img src='foto/$user[uid].png'>";
    echo "<div class='col'><h1>$user[nickname]</h1>";

    $act = if_online($uid_a, $pdo);
    
    if($act == 0)
        echo '<i>Offline</i>';
    else
        echo '<i>Online</i>';
    echo '</div>';