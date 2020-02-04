<?php


function db_connect() {
	$dsn = 'mysql:dbname=db; host=localhost';
	return new PDO($dsn, "root", "");
}


?>