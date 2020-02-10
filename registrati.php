<?php 
	
	include_once 'utils.php';
	include_once 'dbConnection.php';

	$email_check='';
	$nick_check='';
	
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

	if (isset($pass) && isset($nick_check) && isset($email_check)) {
			
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
		else if (!isset($pass)|| !($pass === $_REQUEST['pass1'] )) {
			echo '<div class="alert alert-danger">
		  			<strong>Errore!</strong> inserire una password valida
					</div>';
		}
		else{
			$foto=0;
            $frasetta = $_REQUEST['frasetta']??'';

			if($_FILES['foto']['size'] != 0)
                $foto=1;
            
			$sql="INSERT INTO utenti (email,nickname,password_hash,frasetta,foto)
				  VALUES (?,?,?,?,?) ";

			$stmt = $pdo->prepare($sql);

			$stmt->execute([$email,$nick,$pass,$frasetta,$foto]);

            //prendere l'id per rinominare la foto

            if($foto == 1){
                $id = '';
                $query = "SELECT uid FROM utenti WHERE nickname = '$nick'";
                $stmt2 = $pdo->query($query);
                foreach($stmt2 as $row){$id = $row['uid'];}
                $_FILES['foto']['name'] = $id.'.png';

                $target_Path = "foto/";
                $target_Path = $target_Path.basename($_FILES['foto']['name']);
                move_uploaded_file( $_FILES['foto']['tmp_name'], $target_Path );
            }
            
			header('Location: login.php?successo=1');
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
		input {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  border: none;
		  background: #f1f1f1;
		}

		input:focus {
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

	<title>Registrati</title>
</head>
<body onload="samepwd()">

  	<div class="bg-img">
	  <form method= 'post' action="registrati.php" class="container" enctype="multipart/form-data">
	    <h1>Registrati</h1>

	    <label for="email"><b>Email</b></label>
	    <input type="email" placeholder="Enter Email" name="email" required>

	    <label for="nickname"><b>Nickname</b></label>
	    <input type="text" placeholder="Enter Nickname" name="nick" required>

	    <label for="psw"><b>Password</b></label>
	    <input type="password" id="pwd" placeholder="Enter Password" name="pass" required>
	    
	    <label for="psw"><b>Conferma Password</b></label>
	    <input type="password" id="rpwd" placeholder="Enter Password" name="pass1" required>
	   

		<label for="frasetta"><b>Status</b></label>
	    <input type="text" placeholder="Enter Status" name="frasetta">

		<label for="foto"><b>Image(.png)</b></label>
	    <input type="file" name="foto" accept="image/png">

	    <button type="submit" class="btn">Registrati</button><br><br>
	  </form>
	</div>


<script type="text/javascript">
		function samepwd(){
			return document.getElementById('pwd').value === document.getElementById('rpwd').value
		}
		function colore(){
			if (samepwd()== true)
				document.getElementById('rpwd').style="border:2px solid green";
			else
				document.getElementById('rpwd').style="border:2px solid red";
		}
		setInterval('colore()',100);

	</script>



</body>
</html>