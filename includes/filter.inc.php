<?php 


if(isset($_POST["submitPiesa"])){
	header('location: ../index.php?tip=' . $_POST["piesa"] . '');
	exit();
}


if(isset($_POST["submitPretCresc"])){
	header('location: ../index.php?filter=pretcresc');
	exit();
}
if(isset($_POST["submitPretDesc"])){
	header('location: ../index.php?filter=pretdesc');
	exit();
}
if(isset($_POST["submitJudet"])){
	header('location: ../index.php?filter=' . $_POST["judet"] . '');
	exit();
}