<?php 
	if (isset($_POST["submitPiesa"])) {
		$piesaNume = $_POST["numepiesa"];

		require_once 'dbhandler.piese.inc.php';
		require_once 'functii.inc.php';

		adauga_piesa($conn_piese, $piesaNume);	
	}
	else{
		header("location: ../adaugaPiesa.php");
		exit();
	}