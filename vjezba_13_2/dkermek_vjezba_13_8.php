<?php
include('autorizacija.php');

session_start();

if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

$potrebna_vrsta = 0;

$status = autorizacija($potrebna_vrsta);
//echo $status;
if ($status < 0) {
	header("Location: error.php?e=$status");
	exit();
}

$korisnik = $_POST["korisnik"];
$grupa_id = $_POST["grupa_id"];

$dbh = initDB();		// inicijalizacija veze prema bazi podataka

$sql = "update OSOBE set " .
	"gid = '$grupa_id' where korisnik = '$korisnik'";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upisa u bazu podataka!<br>";
	echo mysql_error();
	exit;
}

mysql_close();

include("header.php");
?>

<h1 align="center">Ažurirani podaci!</h1>

<p><a href="dkermek_aplikacija.php">Poèetak aplikacije</a><br>
<p><a href="dkermek_vjezba_13_4.php">Lista svih korisnika</a><br>
</p>

<?php
include("footer.php");
?>