<?php 

	include_once 'utils.php';
	include_once 'dbConnection.php';

	if (isset($_REQUEST['registrati'])) {
		header('Location: registrati.php');
			exit();
	}


	if (isset($_REQUEST['nick']) && isset($_REQUEST['pass'])) {

			$log=login($_REQUEST['nick'],$_REQUEST['pass'],$pdo);

		if ($log != 0) {



			session_start();
			$id = id_from_nick($_REQUEST['nick'],$pdo);
			$_SESSION['id']= $id;
			$_SESSION['nick']=$_REQUEST['nick'];
			$_SESSION['frasetta']=$log['frasetta'];

			$query = "INSERT INTO login_details (uid)
					  VALUES (?)";

			$stmt = $pdo -> prepare($query);

			$stmt -> execute([$id]); 

			$_SESSION['logdid'] = $pdo->lastInsertId();

			if($log['foto'] == 1){
			    $_SESSION['foto']="foto/$id.png";
			}
			else
			    $_SESSION['foto']="foto/0.png";
		
			header('Location: home.php');
			exit();
		}
		else{
			echo '<div class="alert alert-danger">
	  			<strong>Errore!</strong> utente o password errata
				</div>';
		}

		
	}
	if(isset($_REQUEST['successo'])) {
		if($_REQUEST['successo']==1) {
			echo '<script>window.alert("ACCOUNT CREATO CON SUCCESSO!");</script>';
		}
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style type="text/css">
		body, html {
		  height: 100%;
		}
		*{
		  box-sizing: border-box;
		}

		.bg-img {
		  /* The image used */
		  background-image: url("https://www.ilbrevetto.news/wp-content/uploads/2019/10/cropped-sky-tg-24.jpg");

		  /* Control the height of the image */
		  min-height: 100%;

		  /* Center and scale the image nicely */
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;
		  position: relative;
		}

		/* Add styles to the form container */
		.container {
		  position: absolute;
		  right: 37.5%;
		  margin: 25px;
		  max-width: 25%;
		  padding: 20px;
		  background-color: black;
		  top: 25%;
		  border-radius: 6px;
		  color: white;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  border: none;
		  background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus {
		  background-color: #ddd;
		  outline: none;
		}

		/* Set a style for the submit button */
		.btn {
		  background-color: orange;
		  color: black;
		  padding: 16px 20px;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  opacity: 0.9;
		}

		.btn:hover {
		  opacity: 1;
		}
		div {
		  resize: both;
		  overflow: auto;
		}

	</style>

	<title>chat</title>
</head>
<body>

	<!--<form method= 'post' action="login.php">
		nickname:<br>
 		<input type="text" name="nick"><br>
 		password:<br>
  		<input type="password" name="pass"><br>
  		<input type="submit" value="Submit">
  	</form><br><br><br><br>

  		<form method= 'post' action="registrati.php">
  			<input type="submit" value="registrati">
  		</form>-->

	 <div class="bg-img">
	  <form method= 'post' action="login.php" class="container">
	    <h1>Login</h1>

	    <label for="nickname"><b>Nickname</b></label>
	    <input type="text" placeholder="Enter nickname" name="nick" required>

	    <label for="psw"><b>Password</b></label>
	    <input type="password" placeholder="Enter Password" name="pass" required>

	    <button type="submit" class="btn">Login</button><br><br>
	    <a href="registrati.php" class="text-right">Registrati</a>
	  </form>
	</div>

</body>
</html>