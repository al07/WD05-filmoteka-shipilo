<?php
    
    require("config.php");
    require("database.php");
    require("models/films.php");
	
    $link = db_connect();
    
    require('views/header.tpl');
    $errors = array();

    if( array_key_exists('editFilm', $_POST) ) {
//		echo "<h1><pre>".print_r($_FILES)."</pre></h1>";
//		echo "<h1><pre>".print_r($_POST)."</pre></h1>";
        if(@$_POST['title'] == '') {
            $errors[] = array("Необходимо ввести название", 'film_error');
        }
        if(@$_POST['genre'] == '') {
            $errors[] = array("Необходимо ввести жанр фильма", 'genre_error');
        }
        if(@$_POST['year'] == '') {
            $errors[] = array("Необходимо ввести год выхода фильма", 'year_error');
        }
        $result = false;
        if ( empty($errors) ) {
            $result = film_update($link, $_GET['id'], $_POST['title'], $_POST['genre'], $_POST['year'], $_POST['description']);
			if ($result) {
            	$resultSuccess = "<p>Фильм был успешно обновлен</p>";
			} else {
				$resultError = "<p>Что-то пошло не так, попробуйте еще раз</p>";
			}
        }
		
    }
	$film_data = get_film($link, $_GET['id']);


	
	require('views/notific.tpl');
	require('views/edit-film.tpl');
	require('views/footer.tpl');
?>