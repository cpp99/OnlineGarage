<?php 
include_once 'header.php';
?>
<?php 
if (isset($_GET["data"])) {  
    if ($_GET["data"] === "anuntsters") {
        echo '<div style="position:absolute; top:140px; left:400px; background-color:rgba(0,0,255,0.7); width:350px; height:50px; border:width:1px; border-radius: 20px;">
            <span style="padding:25px; color:white; font-family:Audiowide; font-size: 25px;">
            Anuntul a fost sters!
            </span>
            </div>';
    } 
}
 ?>
	<form method="post" action="includes/filter.inc.php"><div class="sticky-top" style="font-family:Audiowide; position:absolute; top:250px; background-color:rgba(255,255,255,0.7); width:300px; height:500px; border-width:1px; border-radius:0px 20px 20px 0px;">
		<span style="position:absolute; top:30px; left:50px;font-size:20px;">Filtreaza Dupa:</span>





		<span style="position:absolute; top:100px; left:50px;font-size:20px;">Tip:</span>
		
		<?php 
            require_once 'includes/functii.inc.php';
            require_once 'includes/dbhandler.piese.inc.php';

            incarca_piese_main($conn_piese); 
        ?>
        <button name="submitPiesa" style="position:absolute; top:150px; left:170px; height:28px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;">Gata</button>





		<span style="position:absolute; top:230px; left:50px;font-size:20px;">Pret:</span>
		<button name="submitPretCresc" style="position:absolute; top:280px; left:30px; border-width:1px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;">Crescator</button>
		<button name="submitPretDesc" style="position:absolute; top:280px; left:160px; border-width:1px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;">Descrescator</button>
		<span style="position:absolute; top:360px; left:50px;font-size:20px;">Judet:</span>
		<button name="submitJudet" style="position:absolute; top:410px; left:220px; height:28px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;">Gata</button>
		<select id="judet" style="position:absolute; top:410px; left:30px; height:28px; border-color:rgba(0,0,0,0); border-radius:5px 10px 5px 10px; background-color:grey; color:white;" name="judet">
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

	</div>
	</form>

	<div style="position:absolute; top:250px; left:350px; background-color:rgba(255,255,255,0.7); width:700px; border:width:1px; border-radius: 20px;">
		<?php  
			require_once 'includes/functii.inc.php';
			require_once 'includes/dbhandler.anunturi.inc.php';
            if(isset($_GET["tip"])){
                $tip = $_GET["tip"];

                if($tip === 'Tip anunt'){
                    if (isset($_SESSION["userID"])) {  
                        if ($_SESSION["userID"] === 2) {
                           incarca_anunturi_MainPage_Admin($conn_anunturi);    
                        }
                        else{
                            incarca_anunturi_MainPage($conn_anunturi);
                        }
                    }
                    else{
                        incarca_anunturi_MainPage($conn_anunturi);
                    }
                }
                else{
                    require_once 'includes/dbhandler.piese.inc.php';
                    $piesaID = gaseste_id_piesa($conn_piese, $tip);

                    if (isset($_SESSION["userID"])) {  
                            if ($_SESSION["userID"] === 2) {
                                incarca_anunturi_MainPage_Admin_Filtrate_tip($conn_anunturi, $piesaID);    
                            }
                            else{
                                incarca_anunturi_MainPage_Filtrate_tip($conn_anunturi, $piesaID);
                            }
                    }
                    else{
                        incarca_anunturi_MainPage_Filtrate_tip($conn_anunturi, $piesaID);
                    }
                }
            }

			else{
                if(isset($_GET["filter"])){
    				$filter = $_GET["filter"];


    				if($filter === 'pretcresc' || $filter === 'pretdesc'){
    					if (isset($_SESSION["userID"])) {  
                    		if ($_SESSION["userID"] === 2) {
                           		incarca_anunturi_MainPage_Admin_Filtrate_pret($conn_anunturi, $filter);    
                    		}
                			else{
                				incarca_anunturi_MainPage_Filtrate_pret($conn_anunturi, $filter);
                			}
               	 		}
                		else{
                			incarca_anunturi_MainPage_Filtrate_pret($conn_anunturi, $filter);
                		}
    				}
    				else{
    					if (isset($_SESSION["userID"])) {  
                    		if ($_SESSION["userID"] === 2) {
                           		incarca_anunturi_MainPage_Admin_Filtrate_judet($conn_anunturi, $filter);    
                    		}
                			else{
                				incarca_anunturi_MainPage_Filtrate_judet($conn_anunturi, $filter);
                			}
               	 		}
                		else{
                			incarca_anunturi_MainPage_Filtrate_judet($conn_anunturi, $filter);
                		}
    				}
    			}
    			else{
    				if (isset($_SESSION["userID"])) {  
                    	if ($_SESSION["userID"] === 2) {
                           incarca_anunturi_MainPage_Admin($conn_anunturi);    
                    	}
                		else{
                			incarca_anunturi_MainPage($conn_anunturi);
                		}
                	}
                	else{
                		incarca_anunturi_MainPage($conn_anunturi);
                	}
    			}
            }
		?>
	</div>



<?php  
	include_once 'footer.php';
?>