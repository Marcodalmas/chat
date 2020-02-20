<?php

    include_once 'dbConnection.php';

    $nick = $_REQUEST['nick']??'';
    $query = "SELECT uid, nickname, foto
              FROM utenti 
              WHERE nickname LIKE ?
              limit 10";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%".$nick."%"]);

    foreach($stmt as $user){

        echo "<a href=showProfile.php?utente=$user[nickname]>$user[nickname]</a><br>";
    }
?>

