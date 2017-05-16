<?php
include_once("config.php");

function autorizacija($potrebna_vrsta) {

global $con;
$vrsta = -1; 
	if (isset($_SESSION["vrsta"])) 
		$vrsta = $_SESSION["vrsta"];
		$iwa_korisnik = $_SESSION["iwa_korisnik"];

		$dbh = initDB ();
		$sql = "select vrsta from korisnik where korisnik = '" . $iwa_korisnik . "'";
		$result = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error());
		list($vrijednost) = mysqli_fetch_array($result);

	if ($vrijednost == $potrebna_vrsta)
		{ $result = 0; }
	else
		{ $result = -2; }
	mysqli_close($con);
	return $result;
}
?>