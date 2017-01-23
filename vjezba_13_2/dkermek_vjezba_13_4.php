<?php
include('autorizacija.php');

session_start();

$potrebna_vrsta = 1;

$status1 = autorizacija($potrebna_vrsta);

$potrebna_vrsta = 0;

$status = autorizacija($potrebna_vrsta);

include("header.php");

echo "<p><a href='dkermek_vjezba_13_9.php'>Novi korisnik</a><br>";

if ($status1 >= 0) 
{
	echo "<p><a href='dkermek_aplikacija.php'>Poèetak aplikacije</a><br>";
} else {
}
$dbh = initDB();		// inicijalizacija veze prema bazi podataka

$sql = "select korisnik, prezime, ime, lozinka, naziv from OSOBE, GRUPE WHERE GRUPE.GID = OSOBE.GID order by prezime, ime";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upita na bazu podataka!<br>";
	echo mysql_error();
	exit;
}
echo "<center>";
echo "<table border=1 cellspacing=2 cellpadding=2><TR><TD><b>Korisnik</b><TD><b>Prezime</b><TD><b>Ime</b><TD><b>Lozinka</b><TD><b>Grupa</b>\n";

while( list($korisnik, $prezime, $ime, $lozinka, $naziv) = mysql_fetch_array($rs)) {
	echo "<TR><TD>";
	if ($status >= 0) {
		echo "<a href='dkermek_vjezba_13_5.php?korisnik=$korisnik'>$korisnik</a>";
	} else if (isset($HTTP_SESSION_VARS["PzaWeb"]) && isset($HTTP_SESSION_VARS["PzaWeb_korisnik"]) &&
			$korisnik == $HTTP_SESSION_VARS["PzaWeb_korisnik"]) {
		echo "<a href='dkermek_vjezba_13_5.php?korisnik=$korisnik'>$korisnik</a>";
	} else {
		echo "$korisnik";
	}
	echo "<TD>$prezime<TD>$ime<TD>$lozinka<TD>";
	if ($status >= 0) {
		echo "<a href='dkermek_vjezba_13_7.php?korisnik=$korisnik'>$naziv</a>";
	} else {
		echo "$naziv";
	}
	echo "\n";
}

echo "</table>\n";
echo "</center>\n";

mysql_close();

include("footer.php");
?>
