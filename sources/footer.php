<script type="text/javascript">

		function incarcaDate(){
			var nume = document.getElementById("numesiprenume");
			if(nume !== null){
				<?php 
				if (isset($_SESSION["userID"])){
					$id = $_SESSION["userID"];
				}
				require_once 'includes/dbhandler.users.inc.php';
				$sql = "SELECT * FROM `users` where `usersID` = '$id'";
				$result = mysqli_query($conn_users, $sql);
				$row = mysqli_fetch_assoc($result);
				$numesiprenume = $row["usersNumeSiPrenume"];
				$varsta = $row["usersVarsta"];
				$mail = $row["usersMail"];
				$nr_tel = $row["usersNrTel"];
				$judet = $row["usersJudet"];
				$sex = $row["usersApelativ"];
				
				if (empty($numesiprenume)) {
					echo 'document.getElementById("numesiprenume").placeholder = "Nume si prenume";';
				}
				else{
					echo 'document.getElementById("numesiprenume").value = "' . $numesiprenume . '";';
				}
				if (empty($varsta)) {
					echo 'document.getElementById("varsta").placeholder = "Varsta(ani)";';
				}
				else{
					echo 'document.getElementById("varsta").value = "' . $varsta . '";';
				}
				if (empty($mail)) {
					echo 'document.getElementById("mail").placeholder = "Mail";';
				}
				else{
					echo 'document.getElementById("mail").value = "' . $mail . '";';
				}
				if (empty($nr_tel)) {
					echo 'document.getElementById("nr_tel").placeholder = "Numar Telefon";';
				}
				else{
					echo 'document.getElementById("nr_tel").value = "' . $nr_tel . '";';
				}
				if (empty($judet)) {
					echo 'document.getElementById("judet").selectedIndex = 0;';
				}
				else{
					echo "var listajudete = document.getElementById('judet').options;
							var i;
							for(i=0; i<listajudete.length; i++){
								if(listajudete[i].label === '" . $judet . "'){
									break;
								}
							}
							document.getElementById('judet').selectedIndex = i;";
				}
				if (empty($sex)) {
					echo 'document.getElementById("sex").selectedIndex = 0;';
				}
				else{
					echo "var listasex = document.getElementById('sex').options;
							var i;
							for(i=0; i<listasex.length; i++){
								if(listasex[i].label === '" . $sex . "'){
									break;
								}
							}
							document.getElementById('sex').selectedIndex = i;";
				}

				
			?>
			}
		}
		
	</script>
    <script src="assets/js/jquery.min(MAIN).js"></script>
    <script src="assets/bootstrap/js/bootstrap.min(MAIN).js"></script>
</body>

</html>