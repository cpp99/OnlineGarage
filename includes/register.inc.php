<?php 
if (isset($_POST["submit"])) {
	$nume_ut = $_POST["nume_ut"];
	$mail = $_POST["mail"];
	$parola = $_POST["parola"];
	$judet = $_POST["judet"];
	$nr_tel = $_POST["nr_tel"];

	require_once 'dbhandler.users.inc.php';
	require_once 'functii.inc.php';

	if (campuriGoale($nume_ut, $mail, $parola, $judet, $nr_tel) !== false) {
		header("location: ../register.php?error=campurigoale");
		exit();
	}
	if (numeUtilizatorLuat($conn_users, $nume_ut) !== false) {
		header("location: ../register.php?error=numeutilizatorluat");
		exit();
	}
	if (nrTelefonInvalid($nr_tel) !== false) {
		header("location: ../register.php?error=nrtelinvalid");
		exit();
	}
	if (judetNeselectat($judet) !== false) {
		header("location: ../register.php?error=judetneselectat");
		exit();
	}

	creeaza_utilizator($conn_users, $nume_ut, $mail, $parola, $judet, $nr_tel);
}
else{
	header("location: ../register.php");
	exit();
}