<?php
    
    require("config.php");
    require("database.php");
    require("models/films.php");
	require('views/header.tpl');
    $link = db_connect();
    
    $db_file_name = '';
    $errors = array();

    if( isset($_POST["newFilm"]) ) {
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
			
            $result = film_new($link, $_POST['title'], $_POST['genre'], $_POST['year'], $_POST['description']);
			if ($result) {
            	$resultSuccess = "<p>Фильм был успешно добавлен</p>";
			} else {
				$resultSuccess = "<p>Что-то пошло не так, попробуйте еще раз</p>";
			}
        }
    }

	
	
	require('views/notific.tpl');
	require('views/new-film.tpl');
	require('views/footer.tpl');
?>