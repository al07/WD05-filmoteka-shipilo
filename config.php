<?php

session_start();
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define("MYSQL_DB", "filmoteka_films");

define("HOST", 'http://'.$_SERVER['HTTP_HOST'].'/');

define('ROOT', dirname(__FILE__).'/')
?>