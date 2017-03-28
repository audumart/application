<?php

define('DBNAME', 'martin');
define('DBUSER', 'root');
define('DBPASS', 'root');

try{

	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch(PDOException $e){
	echo $e->getMessage();
}




