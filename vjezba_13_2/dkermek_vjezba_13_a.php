<?php
include_once("config.php");

$korisnik = $_POST["korisnik"];
$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$lozinka = $_POST["lozinka"];
$email = $_POST["email"];
$omiljenipj = $_POST["ompjezik"];
$iskustvo = $_POST["godpjezik"];

if(array_key_exists("pozpjezik1", $_POST)) {
	$pj1 = 1;
}
else {
	$pj1 = 0;
}

if(array_key_exists("pozpjezik2", $_POST)) {
	$pj2 = 1;
}
else {
	$pj2 = 0;
}

if(array_key_exists("pozpjezik3", $_POST)) {
	$pj3 = 1;
}
else {
	$pj3 = 0;
}

if(array_key_exists("pozpjezik4", $_POST)) {
	$pj4 = 1;
}
else {
	$pj4 = 0;
}

if(array_key_exists("pozpjezik5", $_POST)) {
	$pj5 = 1;
}
else {
	$pj5 = 0;
}

if(array_key_exists("pozpjezik6", $_POST)) {
	$pj6 = 1;
}
else {
	$pj6 = 0;
}

if(array_key_exists("pozpjezik7", $_POST)) {
	$pj7 = 1;
}
else {
	$pj7 = 0;
}

if(array_key_exists("pozpjezik8", $_POST)) {
	$pj8 = 1;
}
else {
	$pj8 = 0;
}

if(array_key_exists("pozpjezik9", $_POST)) {
	$pj9 = 1;
}
else {
	$pj9 = 0;
}

if(array_key_exists("pozpjezik10", $_POST)) {
	$pj10 = 1;
}
else {
	$pj10 = 0;
}

$dbh = initDB();		// inicijalizacija veze prema bazi podataka

$sql = "insert into OSOBE " .
	"(korisnik, ime, prezime, lozinka, email, prog_jezik, prog_godina, pj1, pj2, pj3, pj4, pj5, pj6, pj7, pj8, pj9, pj10) " .
	"values ('" . $korisnik . "','" . $ime . "','" . $prezime . "','" . $lozinka . "','" . $email . "'," . 
	"'" . $omiljenipj . "','" . $iskustvo . "'," . $pj1 . "," . $pj2 . "," . $pj3 . "," . $pj4 . "," . $pj5 . "," . 
	$pj6 . "," . $pj7 . "," . $pj8 . "," . $pj9 . "," . $pj10 . ")";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upisa u bazu podataka!<br>";
	echo mysql_error();
	exit;
}

mysql_close();

setcookie("PzaWeb", $prezime . " " . $ime, time() + 60*60*5);

include("header.php");
?>

<h1 align="center">Upisani podaci!</h1>

<p><a href="dkermek_vjezba_13_4.php">Lista svih korisnika</a><br>
</p>

<?php
include("footer.php");
?>
