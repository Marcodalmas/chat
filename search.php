<?php

    include_once 'dbConnection.php';

    $nick = $_REQUEST['nick']??'';
    $query = "SELECT uid, nickname, foto
              FROM utenti 
              WHERE nickname LIKE ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%".$nick."%"]);

    foreach($stmt as $user){

        echo '<div onclick="showProfile()">
                <input type="submit" value="'.$user['nickname'].'">
                </div>';
    }