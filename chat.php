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
	<script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
			position: fixed;
		  width: 101%;
		  top: 0px;
		  padding: 10px 16px;
		  background: black;
		  color: #f1f1f1;
		  overflow-x: hidden;

		}
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
		.containerC {
		  border: 2px solid #dedede;
		  background-color: #f1f1f1;
		  border-radius: 5px;
		  padding: 10px;
		  margin: 10px 0;
		}

		/* Darker chat container */
		.darker {
		  border-color: #ccc;
		  background-color: #ddd;
		}

		/* Clear floats */
		.containerC::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		/* Style images */
		.containerC img {
		  float: left;
		  max-width: 60px;
		  width: 100%;
		  margin-right: 20px;
		  border-radius: 50%;
		}

		/* Style the right image */
		.container img.right {
		  float: right;
		  margin-left: 20px;
		  margin-right:0;
		}

		/* Style time text */
		.time-right {
		  float: right;
		  color: #aaa;
		}

		/* Style time text */
		.time-left {
		  float: left;
		  color: #999;
		}

		.footer {
	   position: fixed;
	   padding: 5px 10px;
	   left: 1%;
	   bottom: 0;
	   width: 101%;
	   background-color: black;
	   color: white;
	   text-align: center;
	   padding-left: 40%;
		}

	</style>


	<title>chat</title>
</head>
<body>

	<div class="split left">
		<div class="header">
			<input type="text" id="search" placeHolder="Search" class="btn btn-light">
			<button id="searchBtn" onclick="search()" class="btn btn-light"><i class="fa fa-search"></i></button>
			<div role="form">  
         		<div class="chat-popup" id="myForm"></div> 
    		</div>
		</div>
		<div class="scrollmenu">
			<div id="lista_amici"></div>
		</div> 
	</div>


	<div class="split right">
		<div class="header">
			<h1>info contatto</h1>
		</div>
	    <div id="interfaccia" style="padding: 5%"></div>

	</div>


</body>
</html>

<script>

			var popup = 'none';

			function view($id){
				var element = document.getElementById('chat');
			}
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

			function view(idA){
                
				$.ajax({
					url: "getChat.php",
					method: "post",
					data: {'idA': idA},
					success: function(data){
						$('#interfaccia').html(data);
					}
				});
				setInterval(function(){
					view(idA);
				}, 2000);
			}

			function sendMessage(idA){
				var text = document.getElementById('messaggio').value;
				$.ajax({
					url: "sendMex.php",
					method: "post",
					data: {'idA': idA, 'testo': text},
					success: function(data){
						view(idA);
					}
				});
			}

			$(document).ready(function(){
				lista_amici();
				setInterval(function(){
					lista_amici();
					ultimo_accesso();
				}, 5000);
			});




</script>


