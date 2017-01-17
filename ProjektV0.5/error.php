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
	case 2:		$message = "Kriva lozinka ili korisničko ime, molim unesite ispravne podatke ili se registrirajte!";
			break;
	case 3:		$message = "Postojeći korisnik!";
			break;
	default:	$message = "Nepoznata pogreška.";
			break;
}
echo "<h1 align='center'>$message</h1>";

include("footer.php");
?>