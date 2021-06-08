<?php  
	include_once 'header.php';
?>

<div style="position:absolute; top:140px; left:400px; background-color:rgba(180,208,223,0.7); width:400px; height:50px; border:width:1px; border-radius: 20px;">
		<span style="padding:45px; color:black; font-family:Audiowide; font-size: 25px;">
			Editeaza anuntul tau
		</span>
	</div>
	<?php  
		if(isset($_GET["edit"])){
			$anuntID = $_GET["edit"];
		}
	?>
	<div style="position:absolute; top:215px; left:250px; background-color:rgba(255,255,255,0.7); width:700px; height:500px; border:width:1px; border-radius: 20px;">
		<form action="includes/adaugaanunt.inc.php" method="post">
			<input id="titlu" type="text" class="form-control" name="titlu" style="margin-left:150px; margin-top:30px; width:400px;">
			<textarea id="descriere" name="descriere" rows="5" cols="40" style="margin-left:150px; margin-top:30px; width:400px; height:200px; border-color:#e1e1e1; border-radius:4px;"></textarea>
			<label id="urlpoza" style="position:absolute; top:385px; left:150px; width:10px;">Link catre poza</label>
			<input type="file" name="urlpoza" style="margin-left:300px; margin-top:80px;"> 
			<input value="<?php echo $_SESSION['userID']; ?>" class="form-control" type="text" name="id" style="position:absolute; visibility:hidden;">
			<input id="pret" type="text" class="form-control" name="pret" style="position:absolute; left:150px; top:320px; width:200px;">
			<select id="tip" name="tip" style="position:absolute; left:400px; top:320px; width:150px; height:38px; border-color:#e1e1e1; border-radius:4px;">




				<option>Tip anunt</option>
				<option>Masina</option>
				<option>Piesa</option>



				
			</select>
			<input type="submit" name="submitEditeazaaa" style="background-color:rgba(180,208,223); margin-left:275px; margin-top:20px; width:150px; height:50px; border-width:1px; border-radius:15px; border-color:rgba(160,188,203); font-family:Audiowide;" value="Salveaza">
		</form>
			
	</div>
	<?php  
		include_once 'footer.php';
	?>