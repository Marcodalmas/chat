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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="gestoreTime.js" type="text/javascript"></script>
	<script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">

		body {
		  font-family: Arial;
		  color: white;
		}

		/* divisione pagina */
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

		/* divisione sx */
		.left {
		width: 30%;
		  left: 0;
		  background-color: black;
		}

		/* divisione dx */
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

		/* header fisso in alto */
		.header {
		  
		  position: fixed;
		  width: 101%;
		  top: 0px;
		  padding: 10px;
		  background: black;
		  color: #f1f1f1;
		  overflow-x: hidden;

		}

		/* footer fisso in basso */
		.foot{
		  position: fixed;
		  width: 101%;
		  bottom: 0px;
		  padding: 10px 16px;
		  background: black;
		  color: #f1f1f1;
		  overflow-x: hidden;

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

		.friends{
			background-color: black;
			border: 1px solid white; 
			height: 40px;
		}
		
		.img{
			width: 20px;
			height: 20px;
		}

		/* Chat containers */
		.containerM {
		  border: 2px solid #dedede;
		  background-color: rgb(255,128,0);
		  border-radius: 15px 0px 15px 15px;
		  padding: 10px;
		  margin: 10px 0;
		  width: 49%;
		  position: relative;
		  left: 49%;
		}

		.containerD {
		  border: 2px solid rgb(255,128,0);
		  background-color: #f1f1f1;
		  border-radius: 0px 15px 15px 15px;
		  padding: 10px;
		  margin: 10px 0;
		  width: 49%;
		}

		/* Clear floats */
		.containerM::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		/* Clear floats */
		.containerD::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		/* Style time text */
		.time-right {
		  float: right;
		  color: black;
		}

		/* Style time text */
		.time-left {
		  float: left;
		  color: black;
		}

		.footer {
		   position: fixed;
		   padding: 5px 10px;
		   left: 1%;
		   bottom: 0;
		   width: 30%;
		   background-color: black;
		   color: white;
		   text-align: center;
		}

		#messaggio {
			border: 2px solid black;
			background-color: #f1f1f1;
			border-radius: 10px;
			padding: 8px;
			margin: 0px 10px 0px 10px
		}

		#interfaccia {
			position: relative;
			padding: 6%;
		}


	</style>

	<title>chat</title>
</head>
<body onload="updateTime()" onmousemove="updateTime()">

	<div class="split left scrollmenu">
		<div class="row fixed">
			<input type="text" id="search" placeHolder="Search" class="btn btn-light " style="padding-left: 5%">
			<button id="searchBtn" onclick="search()" class="btn btn-light"><i class="fa fa-search"></i></button></div>
			<div role="form" style="padding-top: 10%">  
				<div class="footer">
				<form action="home.php" class="container">
					<button style="width: 75%" type="submit" name="back" class="btn btn-danger"><i style="" class="fa fa-arrow-left"></i></button>
				</form>
			</div>
       	<div class="chat-popup" id="myForm"></div> 
    	</div> 
    	<div id="lista_amici" style="padding-top: 30px"></div>	
	</div>

<!------------->

	<div class="split right">
		<div class="header" id="info_contatto">		</div>
		<div id="interfaccia">		</div>
		<div class="foot">
			<div class="row">
				<input type="text" id="messaggio" placeholder="Inserire messaggio" width="45%">
				<button class="btn btn-link" onclick="sendMessage();"><i class="fa fa-send"></i></button>
			</div>
		</div>
	</div>

</body>
</html>

<script>

			var popup = 'none';

			$( ".main" ).wrap( "<div class='scroll'></div>" );
			
			function search(){
				var elem = $('#search').val();
				$.ajax({
					url: "search.php",
					method: "post",
					data: {'nick': elem},
					dataType: "html",
					success: function(data){
						$('#myForm').html(data);
					}
				});
				change();
			}

			//FOR POP-UP
			function change() {
				if(popup == 'none')
					popup = 'block';
				else
					popup = 'none';
				document.getElementById("searchUser").style.display = popup;
			}
			
			function lista_amici(){
				$.ajax({
					url: "lista_amici.php",
					method: "post",
					success: function(data){
						$('#lista_amici').html(data);
					}
				});
			}

			function ultimo_accesso(){
				$.ajax({
					url:"ultimo_accesso.php",
					success: function(){

					}
				});
			}

			var idLast = 0;
			var chatAtt;
			var maxY = window.innerHeight;

			function view(idA){

				//cambio chat
				if(idA !=idLast){
					clearInterval(chatAtt);

					idLast = idA;
					chatAtt = setInterval(function(){
								view(idLast);
							  }, 2000);
					
					$.ajax({
						url: "info_contatto.php",
						method: "post",
						data: {'idA': idLast},
						success: function(data){
							$('#info_contatto').html(data);
						}
					});
					window.scrollTo(0, window.innerHeight);
				}

				if(idLast != ""){
					$.ajax({
									url: "getChat.php",
									method: "post",
									data: {'idA': idLast},
									success: function(data){
										$('#interfaccia').html(data);
									}
								});
				}   
			}


			function sendMessage(){
				var idA = document.getElementById('idA').value;
				var text = document.getElementById('messaggio').value;
				if(text != "" && idA != ""){
					$.ajax({
						url: "sendMex.php",
						method: "post",
						data: {'idA': idA, 'testo': text},
						success: function(data){
				
						}
					});
					document.getElementById('messaggio').value = "";
				}
			}

			$(document).ready(function(){
				lista_amici();
				setInterval(function(){
					lista_amici();
					ultimo_accesso();
				}, 5000);
				
			});




</script>


