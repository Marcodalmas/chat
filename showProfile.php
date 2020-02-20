<?php 
	include_once 'dbConnection.php';
	include_once 'utils.php';
	$nickA=$_REQUEST['utente'];
	$idA=id_from_nick($nickA,$pdo);
	$frasetta=frasetta($idA,$pdo);
	session_start();
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<title></title>
</head>
<body>
	
    <div class="row">
		<?php 
	        echo "<img src=\"$idA\" class=\"rounded-circle p-2 m-2\" width=\"200\" height=\"200\">";
	        
	        echo "<div class=\"col\">
	                <h2>$nickA</h2>
	                <div>$frasetta</div>
	            </div>";
	        if (friend($id,$idA,$pdo)) {
	        	//se è friend bottone togli amicizia
	        	echo "<button type='submit' class='btn btn-danger fa fa-user-times' onclick='addFriend($id,$idA,$pdo)'> </button>";
	        }
	        else{
	        	//se non è friend pulsante dai amicizia
	        	echo "<button type='submit' class='btn btn-success fa fa-user-plus' onclick='remFriend($idA)'> </button>";
	        }

	        if (is_blocked($id,$idA,$pdo)) {
	        	//se è bloccato pulsante sbloccato
	        	echo "<button type='submit' class='btn btn-success fa fa-unlock'onclick='removeBlocked($pdo, $idA, $id)'> </button>";
	        }
	        else{
	        	//se non è bloccato pulsante per il block
	        	echo "<button type='submit' class='btn btn-danger fa fa-unlock-alt'onclick='addBlocked($pdo, $idA, $id)'> </button>";
	        }
	        ?>
	    
	    <h1> </h1>
	</div>
	
		<div class="row scrollmenu">
			
			<div class="footer">
				<form action="chat.php" class="container">
					<button style="width: 75%" type="submit" name="back" class="btn btn-danger"><i style="" class="fa fa-arrow-left"></i></button>
				</form>
			</div>
		</div>
</body>
</html>
<script type="text/javascript">

</script>
