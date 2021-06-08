<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min(REGISTER).css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo(REGISTER).css">
    <link rel="stylesheet" href="assets/css/Simple-Slider(REGISTER).css">
    <link rel="stylesheet" href="assets/css/styles(REGISTER).css">
</head>

<body style="background: url(&quot;assets/img/poza-background-register-1.jpg&quot;);color: rgb(255,255,255);">
    <?php 
        if (isset($_GET["error"])) {
            if($_GET["error"] == "campurigoale"){
                echo "<div style='border-radius:10px; margin-top:30px;margin-left:402px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:60px;font-family: Audiowide; font-size:18px;'>Toate campurile trebuie completate!
                        </span>
                    </div>";
            }
            if($_GET["error"] == "numeutilizatorluat"){
                echo "<div style='border-radius:10px; margin-top:30px;margin-left:402px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:100px;font-family: Audiowide; font-size:18px;'>Numele de utilizator este luat!
                        </span>
                    </div>";
            }
            if($_GET["error"] == "nrtelinvalid"){
                echo "<div style='border-radius:10px; margin-top:30px;margin-left:402px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:90px;font-family: Audiowide; font-size:18px;'>Numarul de telefon este invalid!
                        </span>
                    </div>";
            }
            if($_GET["error"] == "judetneselectat"){
                echo "<div style='border-radius:10px; margin-top:30px;margin-left:402px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:110px;font-family: Audiowide; font-size:18px;'>Va rugam selectati un judet!
                        </span>
                    </div>";
            }
            if($_GET["error"] == "stmtgresit"){
                echo "<div style='border-radius:10px; margin-top:30px;margin-left:402px; position:absolute; width:500px; height:50px; background-color:rgba(255,0,0,0.5);'>
                        <span style='padding-left:135px;font-family: Audiowide; font-size:18px;'>Oops! Incercati din nou.
                        </span>
                    </div>";
            }
        }
    ?>
    <div style="width: 1200px;height: 429px;padding-top: 100px;padding-left: 380px;padding-right: 40px;">
        <form method="post" action="includes/register.inc.php" style="height: 398px;border-radius: 10px;background: rgba(255,255,255,0.44);width: 516px;border-style: solid;border-color: rgb(0,0,0);margin-left: 15px;">
            <label class="text-center" style="font-size: 29px;margin: 20px;margin-top: 0px;color: rgb(0,0,0);font-family: Audiowide, cursive;">Va rugam completati cu datele dumneavoastra
            </label>
            <input class="form-control" type="text" name="nume_ut" style="width: 375px;margin-top: 0px;margin-left: 61px;"
                placeholder="Nume de utilizator">
            <input class="form-control" type="email" name="mail" style="width: 375px;margin-top: 19px;margin-left: 61px;" placeholder="Email">
            <input class="form-control" type="password" name="parola" style="margin-top: 19px;width: 375px;margin-left: 61px;"
                placeholder="Parola">
            <select style="border-radius:3px; border-color:white; height:38px; margin-top:19px;margin-left:60px;" name="judet">
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
            <input class="form-control" type="tel" name="nr_tel" style="width: 215px;margin-left: 220px;margin-top: -38px;" placeholder="Telefon" value="+40">
            <input type="checkbox" id="sunt_de_acord" name="sunt_de_acord" style="margin-left: 61px;margin-top: 19px;">
            <a href="#" style="margin-left: 17px;color: rgb(63,64,65); font-family: Audiowide;">Sunt de acord cu termenii si conditiile
            </a>
            <button 
                class="btn btn-info" type="submit" name="submit" style="margin-bottom: -107px;margin-left: -170px;width: 150px;height: 61px;border-radius: 10px;border-width: 2px;border-color: rgb(0,0,0); font-family: Audiowide">Creeaza Cont
            </button>
        </form>
    <script src="assets/js/jquery.min(REGISTER).js"></script>
    <script src="assets/bootstrap/js/bootstrap.min(REGISTER).js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
</body>

</html>