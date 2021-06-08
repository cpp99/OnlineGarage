<?php  
if(isset($_POST["submit"])){
	$numesiprenume = $_POST["numesiprenume"];
	$mail = $_POST["mail"];
	$varsta = $_POST["varsta"];
	$judet = $_POST["judet"];
	$nr_tel = $_POST["nr_tel"];
	$sex = $_POST["sex"];
	$id = $_POST["id"];

	require_once 'dbhandler.users.inc.php';
	require_once 'functii.inc.php';
	updateaza_utilizator($conn_users, $id, $numesiprenume, $mail, $varsta, $judet, $nr_tel, $sex);
}
if(isset($_POST["submitSterge"])){
	$anuntID = $_POST["anuntID"];
	
	require_once 'dbhandler.anunturi.inc.php';
	require_once 'functii.inc.php';
	sterge_anunt($conn_anunturi, $anuntID);
	header('location: ../mypage.php?data=anuntsters');
	exit();
}
if(isset($_POST["submitStergeAdmin"])){
	$anuntID = $_POST["anuntID"];
	
	require_once 'dbhandler.anunturi.inc.php';
	require_once 'functii.inc.php';
	sterge_anunt($conn_anunturi, $anuntID);
	header('location: ../index.php?data=anuntsters');
	exit();
}
if(isset($_POST["submitEditeaza"])){
	$_SESSION["anuntID"] = $_POST["anuntID"];
	
	header('location: ../adaugaAnunt.php?edit=' . $_SESSION["anuntID"] . '');
	exit();
}