<?php
session_start();

include("header.php");

$e = $_GET["e"];
$message = "";
switch($e) {
	case -2:	$message = "Korisnik nema potrebnu dozvolu.";
			break;
	case -1:	$message = "Korisnik ne postoji.";
			break;
	case 0:		$message = "Neispravno korisnièko ime/lozinka.";
			break;
	case 2:		$message = "Neautorizirani pristup.";
			break;
	default:	$message = "Nepoznata pogreška.";
			break;
}
echo "<h1 align='center'>$message</h1>";

include("footer.php");
?>
