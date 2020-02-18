<?php
	include_once 'dbConnection.php';
	include_once 'utils.php';
	session_start();
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	$frasetta=$_SESSION['frasetta'];
	$foto=$_SESSION['foto'];
	
	$foto1="<button type='submit' name='cambio' style='width:20%;' class='btn btn-success'>Modifica</button><br>";


	if($frasetta == ""){
		$frasetta = "Hey there, I'm using whatsapp";
	}

	if (isset($_REQUEST['cambio'])) {
		$foto1="<input type='file' style='margin-left:40%;' name='foto' accept='image/png'><br><br>
				<table>
					<tr>
						<td style='width:1.5%;'><button type='submit' name='elimina' style='width:80%;' class='btn btn-danger'>Elimina foto</button></td>
						<td style='width:5%;'><button type='submit' name='salva' style='width:37.5%;' class='btn btn-success'>OK</button></td>
					</tr>";
	}

	if (isset($_REQUEST['salva'])){

		if($_FILES['foto']['size'] != 0)
            $foto=1;

        if($foto == 1){
			$_FILES['foto']['name'] = $id.'.png';
			$target_Path = "foto/";
	        $target_Path = $target_Path.basename($_FILES['foto']['name']);
	        move_uploaded_file( $_FILES['foto']['tmp_name'], $target_Path );

	        $_SESSION['foto']="foto/$id.png";
	    }
	}

	if (isset($_REQUEST['elimina'])){
			$foto = 'foto/0.png';
			$_SESSION['foto'] = $foto;
		}

	if (isset($_REQUEST['change'])){
		
		change_nick_status($pdo, $id, $_REQUEST['nick'], $_REQUEST['status']);
		
		$_SESSION['frasetta']= $_REQUEST['status'];
		$_SESSION['nick'] = $_REQUEST['nick'];
		header("Location: home.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script> -->
	<style type="text/css">
		.footer {
	  		position: fixed;
	   		padding: 5px 10px;
	   		left: 1%;
	   		bottom: 0;
	  		width: 100%;
	   		background-color: black;
	   		color: white;
	   		text-align: center;
		}

		.header {
		 	position: fixed;
		    width: 100%;		  	
		  	background-color: black;
		}
		body{
			position: absolute;
			width: 10%;
			background-color: black;
			color: white;
			text-align: center;
			overflow-x: hidden;
		}

		table {
			position: relative;
			margin-left: 37.5%;
			width: 30%;
		  	border: 1px solid black;
		  	background-color: black;
		}	

		td {
			position: relative;
			width: 20%;
			text-align: left;		
		}

		input {
			width: 60%;
		}
		

		tr, td{
				

		}

		.chat-popup {
	  		display: none;
		  	position: fixed;
		 	bottom: 500;
		  	right: 15px;
		  	border: 3px solid #f1f1f1;
		 	z-index: 9;
		}

	</style>

	<title>profile</title>
</head>
<body class="">
	<div class="header">
		<h1>IL MIO PROFILO</h1>
       	<form action="" method="GET">
       		<?php 
       		echo "<img src=\"$foto\" class=\"rounded-circle p-2 m-2\" width=\"100\" height=\"100\"><br>";
       		echo $foto1;
       		?>
       		<br>
       	</form>
       	<form>	
	       	<table class="">
					<tr>
						<td>Status:<br><input type="text" id='nuovoStatus' name="status" value="<?php echo $frasetta;?>"></td>
					</tr>
	       			<tr>	
						<td>Nickname:<br><input type="text" id='nuovaNick' name="nick" value="<?php echo $nick;?>"></td>
					</tr>
					<tr>	
						<td>Password:<br><input type="password"  name="oldpwd" placeholder="Vecchia password"></td>
					</tr>
					<tr>	
						<td><input type="password" name="newpwd" placeholder="Nuova password"></td>
					</tr>
					<tr>	
						<td><input type="password"  name="confpwd" placeholder="Conferma password"></td>
					</tr>
	       			<tr>
	       				<td><button type="submit" style="width: 60%; margin-top: 1.5%; text-align: middle;"  name="change" class="btn btn-success">Modifica</button></td>
	       			</tr>
				</table>
       	</form>
			
	</div>
	<br>
	<div class="footer">
		<form action="home.php" class="container">
			<button style="width: 75%" type="submit" name="back" class="btn btn-danger"><i style="" class="fa fa-arrow-left"></i></button>
		</form>
	</div>

	<script type="text/javascript">
		
	</script>
	

</body>
</html>