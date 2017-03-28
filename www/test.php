<?php

define('DBNAME', 'martin');
define('DBUSER', 'root');
define('DBPASS', 'root');

$conn = new PDO('mysqli:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);