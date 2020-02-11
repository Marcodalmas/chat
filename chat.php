<?php 

	include_once 'dbConnection.php';
	
	$nowId = 0;

	session_start();

	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	
	if (isset($_GET['successo'])) {
			if ($_GET['successo']!=0) {
				echo '<div class="alert alert-success">
  					<strong>Success!</strong> messaggio inviato
					</div>';
			}
			else{
				echo '<div class="alert alert-danger">
  					<strong>Errore!</strong> messaggio non inviato (controlla il nickname)
					</div>';
			}
		}

	

	
	

 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
		body {
		  font-family: Arial;
		  color: white;
		}

		.split {
		  height: 100%;
		  width: 50%;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  overflow-x: hidden;
		  padding-top: 20px;
		  direction: ltr;
		}

		.left {
		width: 30%;
		  left: 0;
		  background-color: black;
		}

		.right {
		  width: 70%;
		  right: 0;
		  background-color: orange;

		}

		.centered {
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  text-align: center;
		}

		.centered img {
		  width: 150px;
		  border-radius: 50%;
		}
		.header {
		  width: 105%;
		  padding: 10px 16px;
		  background: #111;
		  color: #f1f1f1;
		   overflow-y: hidden;

		}
		div.scrollmenu {
		  background-color: black;
		  overflow: auto;
		  white-space: nowrap;
		  height: 11%;
		   overflow-y: hidden;
		  
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

		div.scrollmenu::-webkit-scrollbar {
		  width: 1em;
		}
		 
		div.scrollmenu::-webkit-scrollbar-track {
		  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		 
		div.scrollmenu::-webkit-scrollbar-thumb {
		  background-color: darkgrey;
		  outline: 1px solid slategrey;
		}

		
	</style>


	<title>chat</title>
</head>
<body>

	<div class="split left">
	<h2>Info(foto profilo notifiche ecc)ooooooooo</h2>
	  <div class="btn-group-vertical centered">
	    	<!--<?php
				foreach ($stmt as $row) {
					echo "<button class=\"btn-success row p-4 m-4 \" onclick=\"view($row[uid]);\" >$row[nickname]</button>";
					
				}
	    	?>
	    	-->
	  </div>
	</div>
   
	<div class="split right">
		<div class="scrollmenu">
			<?php
				$sql="SELECT uid, nickname
				  	  FROM amicizie AS a
				      JOIN utenti AS u ON a.uid_a = u.uid
				      WHERE a.uid_da = $id";

					$stmt = $pdo->query($sql);
					foreach ($stmt as $row) {
						echo "<a href=home>$row[nickname]</a>";
					}
			 ?>
		<div id="chat" class="centered">
	    	<p>storico chat</p>
	    	<h1>chat</h1>
	  	</div>
	</div>
	<!--
	<form method= 'post' action="inviamsg.php">
		nickname destinatario:<br>
 		<input type="text" name="dest"><br>
 		messaggio:<br>
  		<input type="text" name="mex"><br>
  		<input type="submit" value="Submit">
	</form>-->
</body>
</html>

<script> 

				function view($id){
					var element = document.getElementById('chat');
				}
				$( ".main" ).wrap( "<div class='scroll'></div>" );


				var mysql = require('mysql');

				var con = mysql.createConnection({
				  host: "localhost",
				  user: "yourusername",
				  password: "yourpassword"
				});

				con.connect(function(err) {
				  if (err) throw err;
				  console.log("Connected!");
				});
</script>

