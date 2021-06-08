<?php

function campuriGoale($nume_ut, $mail, $parola, $judet, $nr_tel){
	$verif;
	if(empty($nume_ut) || empty($mail) || empty($parola) || empty($judet) || empty($nr_tel)){
		$verif = true;
	}
	else{
		$verif = false;
	}
	return $verif;
}

function nrTelefonInvalid($nr_tel){
	$verif;
	$regex = "\+\d{1}\s?\d{1}\s?\d{3}\s?\d{3}\s?\d{3}";
	if(!preg_match("/^$regex$/", $nr_tel)){
		$verif = true;
	}
	else{
		$verif = false;
	}
	return $verif;
}

function judetNeselectat($judet){
	$verif;
	if ($judet === 'Selecteaza Judet') {
		$verif = true;
	}
	else{
		$verif = false;
	}
	return $verif;
}

function numeUtilizatorLuat($conn, $nume_ut){
	$sql = "SELECT * FROM users WHERE usersNumeUt = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header('location: ../register.php?error=stmtgresit');
		exit();
	}

	mysqli_stmt_bind_param($stmt, 's', $nume_ut);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($result)) {
		return $row;
	}
	else{
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function creeaza_utilizator($conn, $nume_ut, $mail, $parola, $judet, $nr_tel){
	$sql = "INSERT INTO users (usersNumeUt, usersMail, usersParola, usersJudet, usersNrTel) VALUES (?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header('location: ../register.php?error=stmtgresit');
		exit();
	}

	$hashedParola = password_hash($parola, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, 'sssss', $nume_ut, $mail, $hashedParola, $judet, $nr_tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header('location: ../login.php?error=null-register');
	exit();
}

function campuriGoaleLogin($nume_ut, $parola){
	$verif;
	if(empty($nume_ut) || empty($parola)){
		$verif = true;
	}
	else{
		$verif = false;
	}
	return $verif;
}

function login_utilizator($conn, $nume_ut, $parola){
	$nume_ut_exista = numeUtilizatorLuat($conn, $nume_ut);

	if ($nume_ut_exista === false) {
		header('location: ../login.php?error=credentialegresite');
		exit();
	}

	$parolaHashed = $nume_ut_exista["usersParola"];
	$verifParola = password_verify($parola, $parolaHashed);

	if ($verifParola === false) {
		header('location: ../login.php?error=credentialegresite');
		exit();
	}
	else if($verifParola === true){
		session_start();
		$_SESSION["userID"] = $nume_ut_exista["usersID"];
		$_SESSION["userNumeUt"] = $nume_ut_exista["usersNumeUt"];

		header('location: ../index.php');
		exit();
	}
}

function updateaza_utilizator($conn, $id, $numesiprenume, $mail, $varsta, $judet, $nr_tel, $sex){
	if (empty($numesiprenume) === false) {
		$query = "UPDATE `users` SET `usersNumeSiPrenume` = '$numesiprenume' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	if (empty($mail) === false) {
		$query = "UPDATE `users` SET `usersMail` = '$mail' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	if (empty($varsta) === false) {
		$query = "UPDATE `users` SET `usersVarsta` = '$varsta' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	if ($judet !== 'Selecteaza Judet') {
		$query = "UPDATE `users` SET `usersJudet` = '$judet' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	if (nrTelefonInvalid($nr_tel) === false) {
		$query = "UPDATE `users` SET `usersNrTel` = '$nr_tel' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	if ($sex !== 'Sex') {
		$query = "UPDATE `users` SET `usersApelativ` = '$sex' WHERE `usersID` = '$id'";
		$query_run = mysqli_query($conn, $query);
	}
	header('location: ../mypage.php?data=updated');
	exit();
}

function updateaza_anunt($conn_anunturi, $anuntID, $anuntTitlu, $anuntDescriere, $anuntUrlPoza, $anuntPret, $anuntTip){
	if (empty($anuntTitlu) === false) {
		$query = "UPDATE `anunturi` SET `anunturiTitlu` = '$anuntTitlu' WHERE `anunturiID` = '$anuntID'";
		$query_run = mysqli_query($conn_anunturi, $query);
	}
	if (empty($anuntDescriere) === false) {
		$query = "UPDATE `anunturi` SET `anunturiDescriere` = '$anuntDescriere' WHERE `anunturiID` = '$anuntID'";
		$query_run = mysqli_query($conn_anunturi, $query);
	}
	if (empty($anuntUrlPoza) === false) {
		$query = "UPDATE `anunturi` SET `anunturiUrlPoza` = '$anuntUrlPoza' WHERE `anunturiID` = '$anuntID'";
		$query_run = mysqli_query($conn_anunturi, $query);
	}
	if (empty($anuntPret) === false) {
		$query = "UPDATE `anunturi` SET `anunturiPret` = '$anuntPret' WHERE `anunturiID` = '$anuntID'";
		$query_run = mysqli_query($conn_anunturi, $query);
	}
	if ($anuntTip !== 'Tip anunt') {
		require_once 'dbhandler.piese.inc.php';
		$piesaID = gaseste_id_piesa($conn_piese, $anuntTip);

		$query = "UPDATE `anunturi` SET `pieseID` = '$piesaID' WHERE `anunturiID` = '$anuntID'";
		$query_run = mysqli_query($conn_anunturi, $query);
	}

	header('location: ../mypage.php?data=anunt_updated');
	exit();
}

function incarca_anunturi_MyPage($conn_anunturi, $userID){
	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi` where `usersID` = '$userID'";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$areAnunturi++;
		$anuntID = $row["anunturiID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];

		$piesaID = $row["pieseID"];
		require_once 'dbhandler.piese.inc.php';
		$anuntTip = gaseste_nume_piesa($conn_piese, $piesaID);


		echo '<form method="post" action="includes/mypage.inc.php">
			<input type="text" name="anuntID" value="' . $anuntID . '" style="position:absolute; visibility:hidden;">
			<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitSterge">Sterge</a>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitEditeaza">Editeaza</button>
		</div></form>';
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu aveti nici un anunt adaugat</div><br>';
	}
}

function creeaza_anunt($conn_anunturi, $userID, $anuntTitlu, $anuntDescriere, $anuntUrlPoza, $anuntPret, $anuntTip){

	require_once 'dbhandler.piese.inc.php';

	$piesaID = gaseste_id_piesa($conn_piese, $anuntTip);

	$sql = "INSERT INTO anunturi (usersID, anunturiTitlu, anunturiDescriere, anunturiUrlPoza, anunturiPret, pieseID) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn_anunturi);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header('location: ../mypage.php?error=stmtgresit');
		exit();
	}

	mysqli_stmt_bind_param($stmt, 'ssssss', $userID, $anuntTitlu, $anuntDescriere, $anuntUrlPoza, $anuntPret, $piesaID);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header('location: ../mypage.php?data=anuntcreat');
	exit();
}

function incarca_anunturi_MainPage($conn_anunturi){
	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$areAnunturi++;
		$id = $row["usersID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];


		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
		</div>';
		if(isset($_SESSION["userID"])){
			echo '<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 660px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';
		}
		else{
			echo '<p style="font-family:Audiowide; font-size:30px; position:absolute; top:-120px; padding-left:50px;background-color:rgba(255,0,0,0.1); border-radius:10px; color:white;"> Trebuie sa va logati pentru a vedea informatiile proprietarilor!</p>';
			
		}
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}

function incarca_anunturi_MainPage_Admin($conn_anunturi){
	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$areAnunturi++;
		$id = $row["usersID"];
		$anuntID = $row["anunturiID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<form method="post" action="includes/mypage.inc.php">
			<input type="text" name="anuntID" value="' . $anuntID . '" style="position:absolute; visibility:hidden;">
			<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitStergeAdmin">Sterge</a>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitEditeaza">Editeaza</button>
		</div></form>
		<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 650px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';			
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}


function afiseaza_informatii($conn_users, $id){
	$sql = "SELECT * FROM `users` where `usersID` = '$id'";
	$result = mysqli_query($conn_users, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}

function sterge_anunt($conn_anunturi, $anuntID){
	$sql = "DELETE FROM `anunturidb`.`anunturi` WHERE `anunturiID`='$anuntID';";
	mysqli_query($conn_anunturi, $sql);
}














function incarca_anunturi_MainPage_Filtrate_tip($conn_anunturi, $piesaID){
	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$id = $row["usersID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		$piesaIDdinAnunt = $row["pieseID"];

		if($piesaIDdinAnunt !== $piesaID){
			continue;
		}

		$areAnunturi++;

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
		</div>';
		if(isset($_SESSION["userID"])){
			echo '<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 660px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';
		}
		else{
			echo '<p style="font-family:Audiowide; font-size:30px; position:absolute; top:-120px; padding-left:50px;background-color:rgba(255,0,0,0.1); border-radius:10px; color:white;"> Trebuie sa va logati pentru a vedea informatiile proprietarilor!</p>';
			
		}
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}
















function incarca_anunturi_MainPage_Admin_Filtrate_tip($conn_anunturi, $piesaID){

	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$id = $row["usersID"];
		$anuntID = $row["anunturiID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		$piesaIDdinAnunt = $row["pieseID"];

		if($piesaIDdinAnunt !== $piesaID){
			continue;
		}
		
		$areAnunturi++;

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<form method="post" action="includes/mypage.inc.php">
			<input type="text" name="anuntID" value="' . $anuntID . '" style="position:absolute; visibility:hidden;">
			<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitStergeAdmin">Sterge</a>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitEditeaza">Editeaza</button>
		</div></form>
		<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 650px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';			
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}






















function incarca_anunturi_MainPage_Filtrate_pret($conn_anunturi, $filter){
	if($filter === 'pretcresc'){
		$sql = "SELECT * FROM `anunturi` ORDER BY `anunturiPret` ASC;";
	}
	else{
		$sql = "SELECT * FROM `anunturi` ORDER BY `anunturiPret` DESC;";
	}

	$areAnunturi = 0;
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$id = $row["usersID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		//$anuntTip = $row["anunturiTip"];

		$areAnunturi++;

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
		</div>';
		if(isset($_SESSION["userID"])){
			echo '<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 660px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';
		}
		else{
			echo '<p style="font-family:Audiowide; font-size:30px; position:absolute; top:-120px; padding-left:50px;background-color:rgba(255,0,0,0.1); border-radius:10px; color:white;"> Trebuie sa va logati pentru a vedea informatiile proprietarilor!</p>';
			
		}
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}

function incarca_anunturi_MainPage_Admin_Filtrate_pret($conn_anunturi, $filter){
	if($filter === 'pretcresc'){
		$sql = "SELECT * FROM `anunturi` ORDER BY `anunturiPret` ASC;";
	}
	else{
		$sql = "SELECT * FROM `anunturi` ORDER BY `anunturiPret` DESC;";
	}

	$areAnunturi = 0;
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$areAnunturi++;
		$id = $row["usersID"];
		$anuntID = $row["anunturiID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		//$anuntTip = $row["anunturiTip"];

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $id);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<form method="post" action="includes/mypage.inc.php">
			<input type="text" name="anuntID" value="' . $anuntID . '" style="position:absolute; visibility:hidden;">
			<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitStergeAdmin">Sterge</a>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitEditeaza">Editeaza</button>
		</div></form>
		<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 650px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';			
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}

function incarca_anunturi_MainPage_Filtrate_judet($conn_anunturi, $filter){

	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){

		$eUserCuJudet = false;

		$usersIDAnunt = $row["usersID"];

		require_once 'dbhandler.users.inc.php';
		$sql1 = "SELECT * FROM `users`;";
		$result1 = mysqli_query($conn_users, $sql1);
		while(($row1 = mysqli_fetch_assoc($result1)) !== null){
			$usersIDUsers = $row1["usersID"];
			$userJudet = $row1["usersJudet"];
			if($userJudet === $filter && $usersIDAnunt === $usersIDUsers){
				$eUserCuJudet = true;
			}
		}

		if($eUserCuJudet === false){
			continue;
		}


		$areAnunturi++;
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		//$anuntTip = $row["anunturiTip"];

		$row_user = afiseaza_informatii($conn_users, $usersIDAnunt);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
		</div>';
		if(isset($_SESSION["userID"])){
			echo '<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 660px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';
		}
		else{
			echo '<p style="font-family:Audiowide; font-size:30px; position:absolute; top:-120px; padding-left:50px;background-color:rgba(255,0,0,0.1); border-radius:10px; color:white;"> Trebuie sa va logati pentru a vedea informatiile proprietarilor!</p>';
			
		}
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}

function incarca_anunturi_MainPage_Admin_Filtrate_judet($conn_anunturi, $filter){
	$areAnunturi = 0;
	$sql = "SELECT * FROM `anunturi`";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$eUserCuJudet = false;

		$usersIDAnunt = $row["usersID"];

		require_once 'dbhandler.users.inc.php';
		$sql1 = "SELECT * FROM `users`;";
		$result1 = mysqli_query($conn_users, $sql1);
		while(($row1 = mysqli_fetch_assoc($result1)) !== null){
			$usersIDUsers = $row1["usersID"];
			$userJudet = $row1["usersJudet"];
			if($userJudet === $filter && $usersIDAnunt === $usersIDUsers){
				$eUserCuJudet = true;
			}
		}

		if($eUserCuJudet === false){
			continue;
		}

		$areAnunturi++;
		$anuntID = $row["anunturiID"];
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];
		//$anuntTip = $row["anunturiTip"];

		require_once 'dbhandler.users.inc.php';
		$row_user = afiseaza_informatii($conn_users, $usersIDAnunt);
		if(empty($row_user["usersNumeSiPrenume"])){
			$row_user["usersNumeSiPrenume"] = "Necunoscut";
		}
		if(empty($row_user["usersMail"])){
			$row_user["usersMail"] = "Necunoscut";
		}
		if(empty($row_user["usersVarsta"])){
			$row_user["usersVarsta"] = "Necunoscut";
		}
		if(empty($row_user["usersApelativ"])){
			$row_user["usersApelativ"] = "Necunoscut";
		}
		if(empty($row_user["usersNrTel"])){
			$row_user["usersNrTel"] = "Necunoscut";
		}
		echo '<form method="post" action="includes/mypage.inc.php">
			<input type="text" name="anuntID" value="' . $anuntID . '" style="position:absolute; visibility:hidden;">
			<div style="margin-left:20px; margin-top:20px; background-color:grey; width:650px; border-width:1px; border-radius:5px;">
			<img src="assets/img/' . $anuntUrlPoza . '" width="150" style="margin-left:10px; margin-top:10px;">
			<label style="font-family:Audiowide; font-size:30px;">' . $anuntTitlu . '</label>
			<br>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide; font-size:20px;">' . $anuntPret . ' lei</p>
			<p style="margin-left:20px; margin-top:5px; font-family:Audiowide;">' . $anuntDescriere . '</p>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitStergeAdmin">Sterge</a>
			<button style="background-color:rgba(180,208,223,0.7); border-color:rgba(0,0,0,0); margin-left:10px; margin-bottom:10px; border-radius:5px;" type="submit" name="submitEditeaza">Editeaza</button>
		</div></form>
		<div style="margin-left:20px; padding-left:50px; border-width:1px; border-radius:10px;width: 650px;height: 40%;background-color: rgba(0,0,0,0.8); z-index: 2; color:white; font-family:Audiowide;" id="overlay">
			<br>
			Nume: '
			.
			$row_user["usersNumeSiPrenume"]
			.
			'<br>
			<br>
			Mail: '
			.
			$row_user["usersMail"]
			.
			'<br>
			<br>
			Numar Telefon: '
			.
			$row_user["usersNrTel"]
			.
			'<br>
			<br>
			Varsta/Sex: '
			.
			$row_user["usersVarsta"]
			.
			'/'
			.
			$row_user["usersApelativ"]
			.

		'</div><br><br>';			
	}
	if ($areAnunturi === 0) {
		echo '<div style="margin-left:120px; margin-top:30px; font-family:Audiowide; font-size:20px;">Momentan nu este nici un anunt adaugat</div><br>';
	}
}


function incarca_piese($conn_piese){
	echo '<select id="tip" name="tip" style="position:absolute; left:400px; top:320px; width:150px; height:38px; border-color:#e1e1e1; border-radius:4px;">
	<option>Tip anunt</option>';

	$sql = "SELECT * FROM `piese`;";
	$result = mysqli_query($conn_piese, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$piesaNume = $row["pieseNume"];
		echo '<option>' . $piesaNume . '</option>';
	}

	echo '</select>';
}

function incarca_piese_main($conn_piese){
	echo '<select name="piesa" id="tip" name="tip" style="position:absolute; left:50px; top:150px; height:30px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;">
	<option>Tip anunt</option>';

	$sql = "SELECT * FROM `piese`;";
	$result = mysqli_query($conn_piese, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$piesaNume = $row["pieseNume"];
		echo '<option>' . $piesaNume . '</option>';
	}

	echo '</select>';
}


function adauga_piesa($conn_piese, $piesaNume){
	$sql = "INSERT INTO piese (pieseNume) VALUES (?);";
	$stmt = mysqli_stmt_init($conn_piese);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header('location: ../adaugaPiesa.php?error=stmtgresit');
		exit();
	}

	mysqli_stmt_bind_param($stmt, 's', $piesaNume);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header('location: ../adaugaAnunt.php?data=piesa_adaugata');
	exit();
}

function gaseste_id_piesa($conn_piese, $anuntTip){
	$sql = "SELECT * FROM `piese` WHERE `pieseNume`='$anuntTip';";
	$result = mysqli_query($conn_piese, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$piesaID = $row["pieseID"];
	}

	return $piesaID;
}

function gaseste_nume_piesa($conn_piese, $piesaID){
	$sql = "SELECT * FROM `piese` WHERE `pieseID`='$piesaID';";
	$result = mysqli_query($conn_piese, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$piesaNume = $row["pieseNume"];
	}

	return $piesaNume;
}


function gaseste_nume_piesa_dupaID($conn_piese, $conn_anunturi, $anuntID){
	$sql = "SELECT * FROM `anunturi` WHERE `anunturiID`='$anuntID';";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$piesaID = $row["pieseID"];
	}

	$sql1 = "SELECT * FROM `piese` WHERE `pieseID`='$piesaID';";
	$result1 = mysqli_query($conn_piese, $sql1);
	while(($row1 = mysqli_fetch_assoc($result1)) !== null){
		$piesaNume = $row1["pieseNume"];
	}

	return $piesaNume;
}

function incarca_date_anunt($conn_anunturi, $anuntID, $piesaNume){
	$sql = "SELECT * FROM `anunturi` WHERE `anunturiID`='$anuntID';";
	$result = mysqli_query($conn_anunturi, $sql);
	while(($row = mysqli_fetch_assoc($result)) !== null){
		$anuntTitlu = $row["anunturiTitlu"];
		$anuntDescriere = $row["anunturiDescriere"];
		$anuntUrlPoza = $row["anunturiUrlPoza"];
		$anuntPret = $row["anunturiPret"];

	}

	echo '<div style="padding-left:20px; position:absolute; top:30px; left:600px;background-color:rgba(0,0,0,0.8); width:400px; height:270px; font-family:Audiowide; color:white; border-width:1px; border-radius:10px;"> 
		<br>
			Titlu: '
			.
			$anuntTitlu
			.
			'<br>
			<br>
			Descriere: '
			.
			$anuntDescriere
			.
			'<br>
			<br>
			Url Poza: '
			.
			$anuntUrlPoza
			.
			'<br>
			<br>
			Pret: '
			.
			$anuntPret
			.
			' lei<br>
			<br>
			Tip: '
			.
			$piesaNume
			.
	'</div>';

}