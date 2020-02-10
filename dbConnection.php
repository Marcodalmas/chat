<?php
try {
		$pdo= new pdo("mysql:host=localhost; dbname=id12500325_chat",'id12500325_chat','ciaofacco');
	} catch (pdoException $e) {
		echo"fail";
	}