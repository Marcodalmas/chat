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
		$foto1="<input type='file' style='margin-left:10%;' name='foto' accept='image/png'><br><br>
				<table style='margin-left:35%;'>
					<tr>
						<td style='width:50%;'><button type='submit' name='elimina' style='' class='btn btn-danger'>Elimina foto</button></td>
						<td style='width:50%;'><button type='submit' name='salva' style='width:100%;' class='btn btn-success'>OK</button></td>
					</tr>
					</table>";
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
		
			if($_REQUEST['newpwd'] === $_REQUEST['confpwd'])
				change_password($pdo, $id, $_REQUEST['oldpwd'], $_REQUEST['confpwd']);
			else
				alert('Errore inserimento password');

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
	<script src="gestoreTime.js" type="text/javascript"></script>
	<!-- <script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script> -->
	<style type="text/css">
		.footer {
	  		position: fixed;
	   		padding: 5px 10px;
	   		left: 0%;
	   		bottom: 0;
	  		width: 100%;
	   		background-color: black;
	   		color: white;
	   		text-align: center;
		}
		html {
		  height: 100%;
		  width: 100%;
		}

		body {
		  text-align: center;
		  color: white;
		  display: table;
		  height: 100%;
		  margin: 0;
		  padding: 0;
		  width: 100%;
		}
	
		/*dividi schermo*/

		/* divisione pagina */
		.split {
		  height: 50%;
		  width: 50%;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  overflow-x: hidden;
		  padding-top: 20px;
		  direction: ltr;
		}

		/* divisione sx */
		.left {
		width: 50%;
		  left: 0;
		  background-color: black;
		}

		/* divisione dx */
		.right {
		  width: 50%;
		  right: 0;
		  background-color: black;
		}

		.row {
		  display: table-row;
		  height: 50%;
		}

		.row:nth-child(1) {
		  background-color: black;
		}

		.row:nth-child(2) {
		  background-color: orange;
		}
		.row:nth-child(3) {
		  background-color: black;
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
	</style>

	<title>profile</title>
</head>
<body onload="updateTime()" onload="samepwd()" onmousemove="updateTime()">

	<div class="row">
		<div class="split left">
	       	<form action="" method="GET">
	       		<h1>IL MIO PROFILO</h1>
	       		<?php 
	       		echo "<img src=\"$foto\" class=\"rounded-circle p-2 m-2\" width=\"100\" height=\"100\"><br>";
	       		echo $foto1;
	       		?>
	       		<br>
	       	</form>
	    </div>
	    <div class="split right">
	       	<form>	
		       	<table style="margin-left: 40%;">
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
							<td><input type="password" id="pwd" name="newpwd" placeholder="Nuova password"></td>
						</tr>
						<tr>	
							<td><input type="password" id="rpwd"  name="confpwd" placeholder="Conferma password"></td>
						</tr>
		       			<tr>
		       				<td><button type="submit" style="width: 60%; margin-top: 1.5%; text-align: middle;"  name="change" class="btn btn-success">Modifica</button></td>
		       			</tr>
					</table>
	       	</form>
				
		</div>
	</div>
	<div class="row">
		<h1></h1>
	</div>

	<div class="row">
		<div class="footer">
			<form action="home.php" class="container">
				<button style="width: 75%" type="submit" name="back" class="btn btn-danger"><i style="" class="fa fa-arrow-left"></i></button>
			</form>
		</div>
	</div>

	


	<script type="text/javascript">
		function samepwd(){
			return document.getElementById('pwd').value === document.getElementById('rpwd').value
		}
		function colore(){
			if(document.getElementById('rpwd').value != ""){
				if (samepwd()== true)
					document.getElementById('rpwd').style="border:2px solid green";
				else
					document.getElementById('rpwd').style="border:2px solid red";
			}
			else
				document.getElementById('rpwd').style="";
		}
		setInterval('colore()',100);

	</script>


</body>
</html>