<?php
include_once("config.php");

function autorizacija($potrebna_vrsta) {

//printf($_SESSION["vrsta"]);

global $con;
$vrsta = -1; 
	if (isset($_SESSION["vrsta"])) 
		$vrsta = $_SESSION["vrsta"];
		$iwa_korisnik = $_SESSION["iwa_korisnik"];

		$dbh = initDB ();
		//$sql = "select vrsta_korisnika.vrsta FROM vrsta_korisnika,KORISNIK where KORISNIK.vrsta= '$iwa_korisnik' and vrsta_korisnika.vrsta = korisnik.vrsta";
		$sql = "select vrsta from korisnik where korisnik = '" . $iwa_korisnik . "';"; 
		//ako je uspješno spajanje ali nema upita na bazu podataka pokazuje idući odlomak koda
		$reza = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error());
		list($vrijednost) = mysqli_fetch_array($reza);
/* PRVOTNO RJEŠENJE KOJE UPISUJE ZA SVAKOG KORISNIKA VRSTU 0 - KRŠI ADMIN OVLASTI
		$broj = mysqli_num_rows($reza);
		if ($broj == 1) {
		list($result)=mysqli_fetch_array($reza);
		if ($result != 0) {
			if ($result != $potrebna_vrsta) {
				$result = -2;
				}
			}
		}
		else { $result = -2;
	}
	*/

	if ($vrijednost == $potrebna_vrsta)
		{ $result = 0; }
	else
		{ $result = -2; }
	mysqli_close($con);
	return $result;
}
?>