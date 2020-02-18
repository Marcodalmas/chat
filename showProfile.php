<?php 
	include_once 'dbConnection.php';
	include_once 'utils.php';
	$nick='facco';
	$id=id_from_nick($nick,$pdo);
	$frasetta=frasetta($id,$pdo);





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
	</style>
	<title></title>
</head>
<body>
	
    <div class="row">
		<?php 
	        echo "<img src=\"$id\" class=\"rounded-circle p-2 m-2\" width=\"200\" height=\"200\">";
	        
	        echo "<div class=\"col\">
	                <h2>$nick</h2>
	                <div>$frasetta</div>
	            </div>";
	        ?>
	    <button type="submit" class="btn btn-success fa fa-unlock"></button>
	    <button type="submit" class="btn btn-danger fa fa-unlock-alt"></button>
	    <button type="submit" class="btn btn-success fa fa-user-plus"></button>
	    <button type="submit" class="btn btn-danger fa fa-user-times"></button>
	</div>

	<div class="row">
		<div class="footer">
		<form action="chat.php" class="container">
			<button style="width: 75%" type="submit" name="back" class="btn btn-danger"><i style="" class="fa fa-arrow-left"></i></button>
		</form>
	</div>
	  
	</div>




	

</body>
</html>
