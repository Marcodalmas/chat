<?php

    include_once 'dbConnection.php';
    session_start();
    $pid = $_REQUEST['pid'];
    $uid = $_SESSION['id'];


    //prelevo totale dei like

    $totLike = 'SELECT COUNT(*) AS n
                FROM likes
                WHERE pid = ?';
    $stmt = $pdo->prepare($totLike);
    $stmt->execute([$pid]);      
    
    $totLike = $stmt->fetch();
    $likes = $totLike['n']+1;

    //aggiorno tab post
    $query = 'UPDATE post
              SET likes = ?
              WHERE pid = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$likes,$pid]);



    //inserisco in tab likes
    $query = 'INSERT INTO likes(uid,pid)
              VALUES (?,?)';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$uid,$pid]);
    

    echo "<div class='col-5'><i>$likes likes</i></div>
          <button class='btn btn-danger d-flex justify-content-end' onclick='like($pid,$likes)'><i class='fa fa-heart'></i></button><br>";