<?php  
	include_once 'header.php';
?>
<div style="position:absolute; top:140px; left:400px; background-color:rgba(180,208,223,0.7); width:400px; height:50px; border:width:1px; border-radius: 20px;">
		<span style="padding:25px; color:black; font-family:Audiowide; font-size: 25px;">
			Editeaza informatiile tale
		</span>
	</div>
	<div style="position:absolute; top:215px; left:250px; background-color:rgba(255,255,255,0.7); width:700px; height:500px; border:width:1px; border-radius: 20px;">
		<form action="includes/mypage.inc.php" method="post">
			<?php  
				if (isset($_GET["data"])) {
					if ($_GET["data"] === "updated") {
						echo '<div style="position:absolute; bottom:610px; left:150px; height:30px; width:400px; background-color:rgba(0,255,0,0.5);border-width:1px; border-radius:20px;">
						<span style="padding-left:30px; color:black; font-family:Audiowide;">Informatiile au fost editate cu succes!</span>
						</div>';
					}
					else if ($_GET["data"] === "anuntcreat") {
						echo '<div style="position:absolute; bottom:610px; left:150px; height:30px; width:400px; background-color:rgba(0,255,0,0.5);border-width:1px; border-radius:20px;">
						<span style="padding-left:100px; color:black; font-family:Audiowide;">Anuntul a fost creat!</span>
						</div>';					
					}
					else if ($_GET["data"] === "anuntsters") {
						echo '<div style="position:absolute; bottom:610px; left:150px; height:30px; width:400px; background-color:rgba(0,255,0,0.5);border-width:1px; border-radius:20px;">
						<span style="padding-left:100px; color:black; font-family:Audiowide;">Anuntul a fost sters!</span>
						</div>';					
					}
				}
			?>
			<input id="numesiprenume" type="text" class="form-control" name="numesiprenume" style="margin-left:150px; margin-top:60px; width:400px;">
			<input id="varsta" class="form-control" type="text" name="varsta" style="margin-left:150px; margin-top:30px; width:150px;">
			<input id="mail" class="form-control" type="text" name="mail" style="margin-left:150px; margin-top:30px; width:400px;">
			<select id="judet" style="margin-left:150px; margin-top:30px; width:400px; height:38px; border-color:#e1e1e1; border-radius:4px;" name="judet">
                <option>Selecteaza Judet</option>
                <option>Alba</option><option>Arad</option><option>Arges</option><option>Bacau</option><option>Bihor</option>
                <option>Bistrita-Nasaud</option><option>Botosani</option><option>Brasov</option><option>Braila</option><option>Bucuresti</option>
                <option>Buzau</option><option>Caras-Severin</option><option>Calarasi</option><option>Cluj</option><option>Constanta</option>
                <option>Covasna</option><option>Dambovita</option><option>Dolj</option><option>Galati</option><option>Giurgiu</option>
                <option>Gorj</option><option>Harghita</option><option>Hunedoara</option><option>Ialomita</option><option>Iasi</option>
                <option>Ilfov</option><option>Maramures</option><option>Mehedinti</option><option>Mures</option><option>Neamt</option>
                <option>Olt</option><option>Prahova</option><option>Satu Mare</option><option>Salaj</option><option>Sibiu</option>
                <option>Suceava</option><option>Teleorman</option><option>Timis</option><option>Tulcea</option><option>Vaslui</option>
                <option>Valcea</option><option>Vrancea</option>
            </select>
			<input id="nr_tel" class="form-control" type="text" name="nr_tel" style="margin-left:150px; margin-top:30px; width:400px;">
			<select id="sex" name="sex" style="position:absolute; left:400px; top:128px; width:150px; height:38px; border-color:#e1e1e1; border-radius:4px;">
				<option>Sex</option>
				<option>M</option>
				<option>F</option>
			</select>
			<input value="<?php echo $_SESSION['userID']; ?>" class="form-control" type="text" name="id" style="position:absolute; visibility:hidden;">
			<input type="submit" name="submit" style="background-color:rgba(180,208,223); margin-left:275px; margin-top:50px; width:150px; height:50px; border-width:1px; border-radius:15px; border-color:rgba(160,188,203); font-family:Audiowide;" value="Actualizeaza">
	</div>





	<div style="position:absolute; top:745px; left:400px; background-color:rgba(180,208,223,0.7); width:400px; height:50px; border:width:1px; border-radius: 20px;">
		<span style="padding:25px; color:black; font-family:Audiowide; font-size: 25px;">
			Editeaza anunturile tale
		</span>
	</div>
	<button style="position:absolute; top:745px; left:830px; background-color:rgba(180,208,223,0.7); height:50px; border:width:1px; border-radius: 20px; border-color:rgba(0,0,0,0);color:black; font-family:Audiowide; font-size: 25px;" type="button" onclick="window.location.href='adaugaAnunt.php';">Adauga
	</button>
	<div style="position:absolute; top:825px; left:250px; background-color:rgba(255,255,255,0.7); width:700px; border:width:1px; border-radius: 20px;">
		<?php  
			require_once 'includes/functii.inc.php';
			require_once 'includes/dbhandler.anunturi.inc.php';
			if (isset($_SESSION["userID"])){
				$userID = $_SESSION["userID"];
				incarca_anunturi_MyPage($conn_anunturi, $userID);
			}
		?>
	</div>
	<?php  
		include_once 'footer.php';
	?>