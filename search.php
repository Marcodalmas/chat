<?php

    include_once 'dbConnection.php';

    $nick = $_REQUEST['nick']??'';
    $query = "SELECT uid, nickname, foto
              FROM utenti 
              WHERE nickname LIKE ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%".$nick."%"]);

    foreach($stmt as $user){

        echo "<a href=showProfile.php?$user[nickname]>$user[nickname]</a><br>";
    }
?>

