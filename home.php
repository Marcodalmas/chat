<?php

	include_once 'dbConnection.php';
	session_start();
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	$frasetta=$_SESSION['frasetta'];
	$foto=$_SESSION['foto'];
	
	if (isset($_REQUEST['chat'])) {
		header('Location: chat.php');
			exit();
	}
	if (isset($_REQUEST['notify'])) {
		header('Location: notify.php');
			exit();
	}
	if (isset($_REQUEST['profile'])) {
		header('Location: profile.php');
			exit();
	}


 ?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="gestoreTime.js" type="text/javascript"></script>

	<style type="text/css">
		.footer {
	   position: fixed;
	   padding: 5px 10px;
	   left: 1%;
	   bottom: 0;
	   width: 100%;
	   background-color: orange;
	   color: white;
	   text-align: center;
		}

		.header {
		  position: absolute;
		  width: 95%;
		  padding: 20px;
		  margin: 20px;
		  background-color: black;
		}
		body{
			width: 40%;
			background-color: #111;
			color: white;
			text-align: center;
			overflow-x: hidden;
		}
		.chat-popup {
		  display: none;
		  position: fixed;
		  bottom: 500;
		  right: 15px;
		  border: 3px solid #f1f1f1;
		  z-index: 9;
		}

		.post {
			border: 2px solid rgb(128,128,128);
			border-radius: 10px;
			background-color: white;
			padding: 5px;
			margin: 4px;
			color: black;
		}

		.container-post {
			position: relative;
			top: 200px;
			width: 65%;
			left: 20%;
		}
		/* barra di scroll */
		div.scrollmenu {
		  background-color: black;
		  overflow: auto;
		  white-space: nowrap;
		   overflow-x: : hidden;
		  
		}

		div.scrollmenu a {
		  display: inline-block;
		  color: white;
		  text-align: center;
		  padding: 3%;
		  text-decoration: none;
		}

		div.scrollmenu a:hover {
		  background-color: #777;
		}

		/* larghezza della barra */
		div.scrollmenu::-webkit-scrollbar {
		  width: 1em;
		}
		 
		div.scrollmenu::-webkit-scrollbar-track {
		  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		
		/* colore e dimensione */
		div.scrollmenu::-webkit-scrollbar-thumb {
		  background-color: darkgrey;
		  outline: 5px solid orange;

		}
		/* fine barra di scroll */
	

	</style>

	<title>Home</title>
</head>
<body class="container-fluid	 justify-content-center" onload="updateTime()" onmousemove="updateTime()">

	<div class="header row m-3 p-3" id="myHeader">
		<!-- Foto profilo
			  Nickname-->
        <?php 
        echo "<img src=\"$foto\" class=\"rounded-circle p-2 m-2\" width=\"150\" height=\"150\">";
        
        echo "<div class=\"col\">
                <h2>Benvenuto/a $nick!</h2>
                <div>$frasetta</div>
            </div>";
        ?>
        <div role="form">            
            <br><br>
            <form action="logout.php" class="justify-content-end flex-row-reverse">
                <button class="btn btn-danger  justify-content-end">LOGOUT</button>
            </form>
				
			<br>

            <button class="btn btn-warning justify-content-end" onclick="openForm('myForm')"><i class="fa fa-gears"></i></button>

            <div class="chat-popup" id="myForm">
			    <h1>Impostazioni</h1>
				    <div role="form">
					    <form action="user_blocked.php" class="form-container"><br>
					    	<button class="btn btn-warning" type="submit" onclick="openForm('block')">Utenti bloccati</button>
					    </form>
					    <br>
					    <br>
					    <button type="button" class="btn btn-danger" onclick="closeForm('myForm')">Close</button>
					</div>
        	</div>
            
            
        </div>
    </div>
    <!-- POST -->
	<div class="scrollmenu">
	    <div class="col overflow-auto justify-content-center p-3 container-post">

	        <?php
	            $query = "SELECT *
	                      FROM post as p 
	                      WHERE p.uid IN (SELECT a.uid_a
	                                      FROM amicizie AS a
	                                      JOIN utenti AS u ON a.uid_a = u.uid
	                                      WHERE a.uid_da = $id)";

	            $stmt = $pdo->query($query);
	            
	            foreach($stmt as $post){
					echo "<div class='post row centered d-flex justify-content-center'>";
					echo "<div class='col'>";
					//nickname dell'utente
	                $query2 = "SELECT uid, nickname, foto FROM utenti WHERE uid = $post[uid]";
	                $stmt2 = $pdo->query($query2);
	                $friend = $stmt2->fetch();

					if($friend['foto']==1)
						$foto_friend = "$friend[uid].png";
					else
						$foto_friend = "0.png";

					echo "<div class='row'><img src='foto/$foto_friend' class='p-2 m-2 rounded-circle' width='60' height='60'>
						  <b>$friend[nickname]</b>
						  <br></div>";
	                    
	                if($post['foto'])
						echo "<div class='row'><img src='post/$post[pid].png' class='p-2 m-2' width='200' height='200'>
							  <br></div>";

	                if($post['commento'] != NULL)
						echo $post['commento']."<br>";
						
					if($post['likes'] == NULL)
						$likes = 0;
					else	
						$likes = $post['likes'];
					
					echo "<br><div class='row' id='$post[pid]'>
							<div class='col-5'><i>$likes likes</i></div>
						  <button class='btn btn-danger d-flex justify-content-end' onclick='like($post[pid])'><i class='fa fa-heart'></i></button>
						  <br></div>";




					echo "</div></div>";
	            }
	        ?>
	        
	    </div>
	</div>


    <!--sotto-->


    <form>
        <div class="footer row">
            <div class="col-4">
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="profile"><i class="fa fa-address-book"></i></button></p>
            </div>
            <div class="col-4">
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="notify"><i class="fa fa-bell"></i></button></p>
            </div>
            <div class="col-4" >
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="chat"><i class="fa fa-comments"></i></button></p>
            </div>
        </div>
    </form>
	
</body>
</html>


<script>
	function openForm(identificatore) {
	  document.getElementById(identificatore).style.display = "block";
	}

	function closeForm(identificatore) {
	  document.getElementById(identificatore).style.display = "none";
	}

	function like(pid){

		$.ajax({
			url: "like.php",
			method: "post",
			data: {'pid': pid},
			dataType: "html",
			success: function(data){
				$('#'+pid).html(data);
			}
		});
	}



</script>