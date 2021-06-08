<?php  
	include_once 'header.php';
?>
<div style="position:absolute; top:215px; left:250px; background-color:rgba(255,255,255,0.7); width:700px; border:width:1px; border-radius: 20px; padding-top:30px;">
	<span style="font-size:20px; font-family:Audiowide; padding-left:200px; ">Ce piesa ai dori sa adaugi?</span>
	<form action="includes/adaugapiesa.inc.php" method="post">
		<input style="margin-left:150px; margin-top:30px; width:400px;" class="form-control" type="text" name="numepiesa">
		<input style="margin-left:280px; margin-top:30px; margin-bottom:50px; width:130px; background-color:rgba(180,208,223); border-width:1px; border-radius:15px; border-color:rgba(160,188,203); font-family:Audiowide; font-size:20px;" type="submit" name="submitPiesa" value="Salveaza">
	</form>
</div>

<?php  
	include_once 'footer.php';
?>