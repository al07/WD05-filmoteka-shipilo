<?php
require('config.php');
if( isset($_POST['enter']) ) {
	$userName = 'admin';
	$userPassword = '123456';
	
	if( $_POST['login'] == $userName && $_POST['password'] == $userPassword) {
		$_SESSION['user'] = 'admin';
		header('Location: '.HOST);
	}
}


include('views/header.tpl');
include('views/login.tpl');
include('views/footer.tpl')



?>