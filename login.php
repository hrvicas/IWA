<?php

include('autentikacija.php');
include ('funkcije.php');

$p_user = provjera_inputa($_POST["p_user"]);
$p_password = provjera_inputa($_POST["p_password"]);
$vrsta = -1;
$ime_prezime = "";

$status = autentikacija ($p_user, $p_password);
	echo "Status = " . $status . "<br />";

		if ($status = 1 ) 
		{
			$iwa_2008_kz_projekt = "iwa_2008_kz_projekt";
			$iwa_korisnik = "$p_user";
			session_start();
			$_SESSION["iwa_2008_kz_projekt"] = "iwa_2008_kz_projekt";
			$_SESSION["iwa_korisnik"] = "$iwa_korisnik";
			$_SESSION["ime_prezime"] = "$ime_prezime";
			$_SESSION["vrsta"] = "$vrsta";

			
			switch ($vrsta) {
				case 0:
					header("Location: admin_usera.php");
					break;
				
				case 1:
					header("Location: pregled_robe.php");
					break;
				
				case -1:
					header("Location: error.php?e=2");
					break;
			}
		}	
?>
