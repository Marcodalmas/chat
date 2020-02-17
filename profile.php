<?php
	include_once 'dbConnection.php';
	include_once 'utils.php';
	session_start();
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	$frasetta=$_SESSION['frasetta'];
	$foto=$_SESSION['foto'];
	

	if($frasetta == ""){
		$frasetta = "Hey there, I'm using whatsapp";
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
			width: 41.5%;
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
		

		tr{
			

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
       		echo "<button type='button' style='width:25%;' class='btn btn-success' onclick='change_foto()'>Modifica</button><br>";
       		?>
       		<br>
			<table class="">
				<tr>
					<td><input type="text" id='nuovoStatus' name="status" value="<?php echo $frasetta;?>"></td>
				</tr>
       			<tr>	
					<td><input type="text" id='nuovaNick' name="nick" value="<?php echo $nick;?>"></td>
				</tr>
       			<tr>
       				<td><button type="submit" style="width: 60%; text-align: middle;"  name="change" class="btn btn-success">Modifica</button></td>
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