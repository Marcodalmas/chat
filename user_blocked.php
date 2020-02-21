<?php 
	
	include_once 'dbConnection.php';
	include_once 'utils.php';
	session_start();	
	
		$uid = $_SESSION['id'];
		$user ="";
		
?>
	
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="gestoreTime.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/yourcode.js"></script>
	<script src="Script/jquery.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>

	<style type="text/css">
		.footer {
	   position: fixed;
	   padding: 5px 10px;
	   left: 1%;
	   bottom: 0;
	   width: 100%;
	   background-color: orange;
	   color: white;
	   text-align: center;
		}

		.header {
		    position: fixed;
		    width: 95%;
		  padding: 20px;
		  margin: 20px;
		  background-color: black;
		}
		body{
			position: relative;
			
			width: 40%;
			background-color: #111;
			color: white;
			text-align: center;
			overflow-x: hidden;
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
	<title>UTENTI BLOCCATI</title>
</head>
<body class="container pt-3" onload="updateTime()" onmousemove="updateTime()">
	
		<h1>UTENTI BLOCCATI</h1>

		<div id="tab" class="container pt-3">
			
		</div>
		<div style="margin-left:35%">
			<form action="home.php" class="container">
				<button type="submit" class="btn btn-danger">BACK</button>
			</form>
		</div>

		


</body>
</html>

<script>

	function update() {
	        var uid = <?php echo $uid?>;
	        $.ajax({
	            type: "POST",
	            url: "switchBlocked.php",
	            data: {'uid': uid},
				dataType: "html",
	            success: function(data) {
	            	$('#tab').html(data);
	            }
	        });
    	}

    $(document).ready(update);
    	
    function back(){
    	$.ajax({
            type: "POST",
            url: "home.php",
            data: {},
			dataType: "html",
            success: function() {
            	console.log('return');
            }
        });
    }

    function remove(uid,id){
    	$.ajax({
            type: "POST",
            url: "switchBlocked.php",
            data: {'uid': uid, 'id': id},
			dataType: "html",
            success: function(data) {
            	console.log('bella');
				update();
            }
        });
    }

</script>