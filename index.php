

<!-- Разные миксины по одному, которые понадобятся. Для логотипа, бейджа, и т.д.-->
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>[Имя и фамилия] - Фильмотека</title>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
	<meta name="keywords" content="" />
	<meta name="description" content="" /><!-- build:cssVendor css/vendor.css -->
	<link rel="stylesheet" href="libs/normalize-css/normalize.css" />
	<link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css" />
	<link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css" /><!-- endbuild -->
	<!-- build:cssCustom css/main.css -->
	<link rel="stylesheet" href="css/main.css" /><!-- endbuild -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
</head>

<body class="index-page">
<?php
    $valid_title = true;
    $valid_genre = true;
    $valid_year = true;
    
    //массив для обновления данных
    $array_to_add = array();
    
    $update_btn_value="Добавить";
    
    $link = mysqli_connect('localhost', 'root', '', 'filmoteka_films');
    if( mysqli_connect_error() ) {
        die("Ошибка подключения к БД!");
    }
    if (!empty($_POST) && @$_GET['action'] != "update") {
        $validation = true;
        
        if( !(array_key_exists ( "title" , $_POST ) ) || trim($_POST["title"]) === "" ) {
            $valid_title = false;
            $validation = false;
        }
        if( !(array_key_exists ( "genre" , $_POST ) ) || trim($_POST["genre"]) === "" ) {
            $valid_genre = false;
            $validation = false;
        }
        if( !(array_key_exists ( "year" , $_POST ) ) || !(is_numeric ( $_POST["year"] )) ) {
            $valid_year = false;
            $validation = false;
        }
        if($validation) {
            $query = "INSERT into `films` (`title`, `genre`, `year`) VALUES ('".mysqli_real_escape_string($link, trim($_POST["title"]))."', '".mysqli_real_escape_string($link, trim($_POST["genre"]))."', '".mysqli_real_escape_string($link, trim($_POST["year"]))."')";
            $resule = mysqli_query($link, $query);
            if(!$query) {
                echo("Не добавил! Печалька");
            }
        }
    }
    
    
    

        if(@$_GET["action"] == "delete") {
            $query = "DELETE FROM `films` WHERE id='".mysqli_real_escape_string($link, $_GET["id"])."' LIMIT 1";
            mysqli_query($link, $query);
            if (!(mysqli_affected_rows($link))) {
                echo "Не удалено";
            }
        }
        if(@$_GET["action"] == "update_prep") {
            // Готовлю данные, чтобы заполнить 
            $query = "SELECT * FROM `films` WHERE id='".mysqli_real_escape_string($link, $_GET["id"])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            
            if($row) {
                $array_to_add['id'] = $row["id"];
                $array_to_add["title"] = $row['title'];
                $array_to_add["genre"] = $row["genre"];
                $array_to_add["year"] = $row["year"];
            }
        }
        if(@$_GET["action"] == "update") {
            $query = "UPDATE `films` SET `title`='".mysqli_real_escape_string($link, trim($_POST["title"]))."', `genre`='".mysqli_real_escape_string($link, trim($_POST["genre"]))."', `year`='".mysqli_real_escape_string($link, trim($_POST["year"]))."' WHERE id=".@$_GET["id"]." LIMIT 1";
            $result = mysqli_query($link, $query);
            if(!$result) {
                echo("Не добавил! Печалька");
                echo("<pre>");
                echo($query);
                echo("</pre>");
            }
        }

?>
	<div class="container user-content section-page">
		<div class="title-1">Фильмотека</div>
<?php
        $query = "SELECT *FROM `films`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result) ) {
?>
       <div class="card mb-20">
            <div class="class__header">
                <h4 class="title-4"><?=$row["title"]?></h4>
                <div class="buttons">
                   <a href="index.php?action=update_prep&id=<?=$row['id']?>" class="button button--edit">Редактировать</a>
                   <a href="index.php?action=delete&id=<?=$row['id']?>" class="button button--delete">Удалить</a>
                </div>
            </div>
			
			<div class="badge"><?=$row["genre"]?></div>
			<div class="badge"><?=$row["year"]?></div>
		</div>
<?php
                                                    }
?>

		<div class="panel-holder mt-80 mb-40">
			<div class="title-3 mt-0">Добавить фильм</div>
<?php 
            if(@$_GET["action"] != "update_prep") {
?>
			<form action="index.php" method="POST">
<?php
            } 
            if(@$_GET["action"] == "update_prep") {
                $update_btn_value = "Редактировать"
?>
            <form action="index.php?action=update&id=<?=@$array_to_add["id"]?>" method="POST">
<?php
            }
    if (!$valid_title) {
?>
            <div class="notify notify--error mb-20" id="film_error">Название фильма не может быть пустым.</div>
<?php
    } 
    if (!$valid_genre) {
?>
            <div class="notify notify--error mb-20" id="genre_error">Поле жанр не может быть пустым.</div>
<?php
    }
    if (!$valid_year) {
?>
            <div class="notify notify--error mb-20" id="year_error">Поле год не может быть пустым или содержать нечисловые данные.</div>
<?php
    } 
?>

				
				<div class="form-group">
				    <label class="label">Название фильма
				    <input class="input" name="title" type="text" placeholder="Такси 2" id="film_input" value=<?='"'.@$array_to_add["title"].'"'?>/>
				    </label>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" id="genre_input"  value=<?='"'.@$array_to_add["genre"].'"'?>/></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" id="year_input"  value=<?='"'.@$array_to_add["year"].'"'?>/></label></div>
					</div>
				</div>
				<input class="button" type="submit" name="newFilm" value="<?=$update_btn_value?>" />
			</form>
		</div>
	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
	<!-- build:jsVendor js/vendor.js -->
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script src="js/custom.js"></script>
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>