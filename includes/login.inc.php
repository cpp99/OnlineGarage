<?php 

if (isset($_POST["submit"])) {
	
	$nume_ut = $_POST["nume_ut"];
	$parola = $_POST["parola"];

	require_once 'dbhandler.users.inc.php';
	require_once 'functii.inc.php';

	if (campuriGoaleLogin($nume_ut, $parola) !== false) {
		header("location: ../login.php?error=campurigoale");
		exit();
	}

	login_utilizator($conn_users, $nume_ut, $parola);
}
else{
	header("location: ../login.php");
	exit();
}