<?php
include('autentikacija.php');

$f_user = $_POST["f_user"];
$f_pass = $_POST["f_pass"];
$kid = -1;
$prezime_ime = "";

$status = autentikacija($f_user, $f_pass);
echo "Status: ".$status."<br />";
if ($status == 1) {
	$PzaWeb = "PzaWeb";
	$PzaWeb_korisnik = $f_user;
	session_start();
	$_SESSION["PzaWeb"] = "PzaWeb";
	$_SESSION["PzaWeb_korisnik"] = $PzaWeb_korisnik;
	$_SESSION["KID"] = $kid;
	$_SESSION["prezime_ime"] = $prezime_ime;
	//echo $_SESSION["PzaWeb"]."<br />".$_SESSION["PzaWeb_korisnik"]."<br />".$_SESSION["KID"]."<br />".$_SESSION["prezime_ime"]."<br />";
	header("Location: dkermek_aplikacija.php");
	exit();
}
else {
	//header("Location: error.php?e=$status");
	exit();
}


?>