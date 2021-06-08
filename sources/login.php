<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LogIn</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min(LOGIN).css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark(LOGIN).css">
    <link rel="stylesheet" href="assets/css/styles(LOGIN).css">
</head>

<body>
    <div class="login-dark" style="background: url(&quot;assets/img/poza-background-login.jpg&quot;);">
    	<?php 
    		if(isset($_GET["error"])){
    			if($_GET["error"] == "campurigoale"){
                echo "<div style='border-radius:10px; margin-top:10px;margin-left:380px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:60px;font-family: Audiowide; font-size:18px; color:white'>Toate campurile trebuie completate!
                        </span>
                    </div>";
            	}
    			if($_GET["error"] == "credentialegresite"){
                echo "<div style='border-radius:10px; margin-top:10px;margin-left:380px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:45px;font-family: Audiowide; font-size:18px; color:white'>Nume de utilizator si/sau parola gresite!
                        </span>
                    </div>";
            	}
    			if($_GET["error"] == "null-register"){
                echo "<div style='border-radius:10px; margin-top:10px;margin-left:380px; position:absolute; width:500px; height:50px; background-color:rgba(0,255,0,0.5);'>
                        <span style='padding-left:100px;font-family: Audiowide; font-size:18px; color:black'>Contul a fost creat cu succes!
                        </span>
                    </div>";
            	}
    		}
    	?>
    	<span class="text-center d-xl-flex align-items-xl-start" style="font-family: Audiowide, cursive;font-size: 40px;text-align: center;padding-top: 56px;margin-right: 104px;margin-left: 104px;">Conecteaza-te sau inregistreaza-te pentru a avea acces la sute de anunturi cu si despre masini!
    	</span>
        <form action="includes/login.inc.php" method="post" style="height: 484px;background: rgba(30,40,51,0.94);">
            <h2 class="sr-only">Login Form</h2>
            <span class="d-xl-flex" style="font-family: Alatsi, sans-serif;font-size: 34px;">ONLINE GARAGE</span>
            <div class="illustration" style="padding: 0px;">
            	<i class="icon ion-android-car" style="filter: brightness(200%) contrast(200%) grayscale(100%) hue-rotate(0deg) invert(0%) saturate(0%);">
            		
            	</i>
            </div>
            <input class="form-control" type="text" name="nume_ut" placeholder="Nume Utilizator" style="width: 200px;">
            <div class="form-group">
            	<input class="form-control" type="password" name="parola" placeholder="Parola" style="width: 200px;">
            </div>
    		<div class="form-group">
    			<button style=" font-family: Audiowide;" class="btn btn-primary btn-block" name="submit" type="submit">Conectare
    			</button>
    		</div>
    		<button onclick="window.location.href='register.php';" class="btn btn-primary" type="button" style=" font-family: Audiowide; width: 240px;margin-top: 5px;background: rgb(33,128,100);">Inregistrare
    		</button>
    		<a href="index.php" style="margin-left: 25px;color: white; font-family: Audiowide;">Continua ca vizitator
    		</a>
    	</form>
    </div>
    <script src="assets/js/jquery.min(LOGIN).js"></script>
    <script src="assets/bootstrap/js/bootstrap.min(LOGIN).js"></script>
</body>

</html>