<?php 
	if (isset($_POST["submit"])) {
		$userID = $_POST["id"];
		$anuntTitlu = $_POST["titlu"];
		$anuntDescriere = $_POST["descriere"];

		$anuntTip = $_POST["tip"];
		
		$anuntPret = $_POST["pret"];
		$anuntUrlPoza = $_POST["urlpoza"];

		require_once 'dbhandler.anunturi.inc.php';
		require_once 'functii.inc.php';

		creeaza_anunt($conn_anunturi, $userID, $anuntTitlu, $anuntDescriere, $anuntUrlPoza, $anuntPret, $anuntTip);
	}
	else if(isset($_POST["submitEditeaza"])){
		$anuntID = $_POST["anuntid"];
		$userID = $_POST["id"];
		$anuntTitlu = $_POST["titlu"];
		$anuntDescriere = $_POST["descriere"];
		$anuntTip = $_POST["tip"];
		$anuntPret = $_POST["pret"];
		$anuntUrlPoza = $_POST["urlpoza"];

		require_once 'dbhandler.anunturi.inc.php';
		require_once 'functii.inc.php';
		updateaza_anunt($conn_anunturi, $anuntID, $anuntTitlu, $anuntDescriere, $anuntUrlPoza, $anuntPret, $anuntTip);
	}
	else{
		header("location: ../adaugaAnunt.php");
		exit();
	}