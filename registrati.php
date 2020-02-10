<?php 
	
	include_once 'utils.php';
	$email_check='';
	$nick_check='';

	try {
		$pdo= new pdo("mysql:host=localhost; dbname=chat",'root','');
	} catch (pdoException $e) {
		echo"fail";
	}
	
	if (isset($_REQUEST['email'])) {
		$email = $_REQUEST['email'];
		$email_check = email_check($email,$pdo);
	}
	if (isset($_REQUEST['nick'])) {
		$nick = $_REQUEST['nick'];
		$nick_check = nick_check($nick,$pdo);
	}
	if (isset($_REQUEST['pass'])) {
		$pass = $_REQUEST['pass'];
	}

	if (isset($pass)&& isset($nick_check) && isset($email_check)) {
		
	
		if ($email_check==1 && $nick_check==1) {
			echo '<div class="alert alert-danger">
		  			<strong>Errore!</strong> email e password già registrati
					</div>';
		}
		elseif ($email_check==1) {
			echo '<div class="alert alert-danger">
		  			<strong>Errore!</strong> email già registrata
					</div>';
		}
		elseif ($nick_check==1) {
			echo '<div class="alert alert-danger">
		  			<strong>Errore!</strong> nickname già registrato
					</div>';
		}
		elseif (!isset($pass)) {
			echo '<div class="alert alert-danger">
		  			<strong>Errore!</strong> inserire una password valida
					</div>';
		}
		else{
			
			$sql=" insert INTO utenti (email,nickname,password_hash)
						VALUES (?,?,?) ";

			$stmt = $pdo -> prepare($sql);

			$stmt -> execute([$email,$nick,$pass]);


			header('Location: login.php?successo=2');
				exit();
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
		  top: 20%;
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

	<title>registrati</title>
</head>
<body>

	<!--<form method= 'post' action="registrati.php">
		email:<br>
		<input type="email" name="email" ><br>
		nickname:<br>
 		<input type="text" name="nick"><br>
 		password:<br>
  		<input type="password" name="pass" minlength="5"><br>
  		<input type="submit" value="Submit">
  	</form>-->


  	<div class="bg-img">
	  <form method= 'post' action="registrati.php" class="container">
	    <h1>Registrati</h1>

	    <label for="email"><b>Email</b></label>
	    <input type="email" placeholder="Enter Email" name="email" required>

	    <label for="nickname"><b>Nickname</b></label>
	    <input type="text" placeholder="Enter Email" name="nick" required>

	    <label for="psw"><b>Password</b></label>
	    <input type="password" placeholder="Enter Password" name="pass" required>

	    <button type="submit" class="btn">Registrati</button><br><br>
	  </form>
	</div>


</body>
</html>