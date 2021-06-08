<?php 
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Online Garage</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min(MAIN).css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button(MAIN).css">
    <link rel="stylesheet" href="assets/css/styles(MAIN).css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body onload="incarcaDate();" style="background-image:url('assets/img/poza-background.jpg'); background-size:1283px;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="index.php" style="background: url(&quot;assets/img/logo-site-1.png&quot;);width: 199px;height: 85px;opacity: 1;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li style="font-family: Audiowide; font-size: 20px;" class="nav-item"><a class="nav-link text-white" href="index.php">Anunturi</a></li>
                    <li style="font-family: Audiowide; font-size: 20px;" class="nav-item"><a class="nav-link text-white" href="despre.php">Despre Noi</a></li>
                    
                </ul>
                <?php 
                    if (isset($_SESSION["userID"])) {  
                        if ($_SESSION["userID"] === 2) {
                            echo '<div style="position:absolute; top:140px; left:20px; background-color:rgba(0,0,255,0.7); width:350px; height:50px; border:width:1px; border-radius: 20px;">
                                    <span style="padding:25px; color:white; font-family:Audiowide; font-size: 25px;">
                                    Bine ai revenit, admin!
                                    </span>
                                </div>';
                        }

                        echo '<span class="navbar-text actions"> 
                        <a style="font-family: Audiowide; font-size: 25px; padding-right:20px;" class="text-white" href="mypage.php">Pagina Mea</a>
                        <a style="font-family: Audiowide; font-size: 25px;" class="btn btn-light action-button" role="button" href="includes/logout.inc.php">Deconecteaza-te</a>
                        </span>';
                    }
                    else{
                        echo '<span class="navbar-text actions"> 
                        <a style="font-family: Audiowide; font-size: 25px; padding-right:20px;" class="text-white" href="login.php">Conecteaza-te</a>
                        <a style="font-family: Audiowide; font-size: 25px;" class="btn btn-light action-button" role="button" href="register.php">Inscrie-te</a>
                        </span>';
                    }
                ?>
            </div>
        </div>
    </nav>