<?php
    require('config.php');
	if ( isset($_SESSION['user']) ) {
		unset($_SESSION['user']);
		session_destroy();
		setcookie('user-name', '', -1);
		setcookie('user-city', '', -1);
		header('Location: '.HOST);
	}

?>