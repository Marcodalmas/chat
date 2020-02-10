<?php
try {
		$pdo= new pdo("mysql:host=localhost; dbname=chat",'root','');
	} catch (pdoException $e) {
		echo"fail";
	}