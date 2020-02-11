<?php 
	include_once 'dbConnection.php';
	session_start();
	$id=$_SESSION['id'];
	$nick=$_SESSION['nick'];
	$frasetta=$_SESSION['frasetta'];
	$foto=$_SESSION['foto'];
	
	if (isset($_REQUEST['chat'])) {
		header('Location: chat.php');
			exit();
	}
	if (isset($_REQUEST['notify'])) {
		header('Location: notify.php');
			exit();
	}
	if (isset($_REQUEST['profile'])) {
		header('Location: profile.php');
			exit();
	}
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
			position: fixed;
			
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



	
	<title>Home</title>
</head>
<body class="container pt-3">

	<div class="header row m-3 p-3" id="myHeader">
		<!-- Foto profilo
			  Nickname-->
        <?php 
        echo "<img src=\"$foto\" class=\"rounded-circle p-2 m-2\" width=\"150\" height=\"150\">";
        
        echo "<div class=\"col\">
                <h2>Benvenuto $nick!</h2>
                <div>$frasetta</div>
            </div>";
        ?>
        <div role="form">            
            <br><br>
            <form action="logout.php" class="justify-content-end flex-row-reverse">
                <button class="btn btn-danger  justify-content-end">LOGOUT</button>
            </form>
			
			<br>

            <button class="btn btn-warning  justify-content-end" onclick="openForm()"><i class="fa fa-gears"></i></button>

            <div class="chat-popup" id="myForm">
			  <form action="/action_page.php" class="form-container">
			    <h1>Impostazioni</h1>

			    <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>
			  </form>
        	</div>
            
            
    </div>
</div>
    <!-- POST -->

    <div class="col" style="top: 300px">

        <?php
            $query = "SELECT *
                        FROM post as p 
                        WHERE p.uid IN (SELECT a.uid_a
                                    FROM amicizie AS a
                                    JOIN utenti AS u ON a.uid_a = u.uid
                                    WHERE a.uid_da = $id)";

            $stmt = $pdo->query($query);
            
            foreach($stmt as $post){

                $query2 = "SELECT nickname FROM utenti WHERE uid = $post[uid]";
                $stmt2 = $pdo->query($query2);

                $nicKFriend = $stmt2->fetch();

                echo $nicKFriend['nickname'];
                    
                if($post['foto'])
                    echo "<img src=\"post/$id.png\" class=\"p-2 m-2\" width=\"200\" height=\"200\">";

                if($post['commento'] != NULL)
                    echo $post['commento'];
            }
        ?>
        
    </div>

    <!--sotto-->
    <form>
        <div class="footer row">
            <div class="col-4">
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="profile"><i class="fa fa-address-book"></i></button></p>
            </div>
            <div class="col-4">
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="notify"><i class="fa fa-bell"></i></button></p>
            </div>
            <div class="col-4" >
                <p><button class="btn col-md-12 col-sm-12 col-xs-12" name="chat"><i class="fa fa-comments"></i></button></p>
            </div>
        </div>
    </form>
	
</body>
</html>
<script>
	function openForm() {
	  document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
	  document.getElementById("myForm").style.display = "none";
	}





</script>