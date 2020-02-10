<?php
try {
		$pdo= new pdo("mysql:host=localhost;dbname=id12500325_chat",'root','');
	} catch (pdoException $e) {
		echo"fail";
	}