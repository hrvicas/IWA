<?php
include('autorizacija.php');

session_start();

if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

$korisnik = $_POST["korisnik"];

$potrebna_vrsta = 0;

$status = autorizacija($potrebna_vrsta);

if ($status < 0 && (! (isset($HTTP_SESSION_VARS["PzaWeb"]) && isset($HTTP_SESSION_VARS["PzaWeb_korisnik"]) && $korisnik == $HTTP_SESSION_VARS["PzaWeb_korisnik"]))) 
{
	header("Location: error.php?e=$status");
	exit();
}

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

$sql = "update OSOBE set " .
	"ime = '$ime', prezime = '$prezime', lozinka = '$lozinka', email = '$email ', " .
	"prog_jezik = '$omiljenipj', prog_godina = '$iskustvo', pj1 = '$pj1', pj2 = '$pj2', pj3 = '$pj3', " .
	"pj4 = '$pj4', pj5 = '$pj5', pj6 = '$pj6', pj7 = '$pj7', pj8 = '$pj8', pj9 = '$pj9', pj10 = '$pj10' " .
	"where korisnik = '$korisnik'";

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

<h1 align="center">Ažurirani podaci!</h1>

<p><a href="dkermek_vjezba_13_4.php">Lista svih korisnika</a><br>
</p>

<?php
include("footer.php");
?>