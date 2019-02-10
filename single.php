<?php
    
    require("config.php");
    require("database.php");
    require("models/films.php");
    $link = db_connect();

	
	$film_data = get_film($link, $_GET['id']);


	require('views/header.tpl');
	require('views/notific.tpl');
	require('views/film-single.tpl');
?>


<?php
	require('views/footer.tpl');
?>