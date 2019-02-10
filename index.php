<?php 
	
    require("config.php");
    require("database.php");
    require("models/films.php");
//	phpinfo();
?>

<body class="index-page">
<?php
    $link = db_connect();


	if(@$_GET['action'] == 'delete') {
		$reslut = delete_film($link, $_GET['id']);

		if ( $reslut ) {
			$resultInfo = "<p>Фильм был удален!</p>";
		} else {
			$resultError = "<p>Что то пошло не так.</p>";
		}
	}

    $films = films_all($link);
    require('views/header.tpl');
	require('views/notific.tpl');
	require('views/film_list.tpl');
	require('views/footer.tpl');
	
?>