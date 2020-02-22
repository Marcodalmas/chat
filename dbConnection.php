<?php

$options = [//PDO::ATTR_EMULATE_PREPARES => FALSE
];

try {
		$pdo= new pdo("mysql:host=localhost;dbname=id12500325_chat",'root','',$options);
	} catch (pdoException $e) {
		echo"fail";
	}
?>