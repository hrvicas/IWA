<?php
session_start();

if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

include("header.php");
?>
<p><a href="dkermek_vjezba_13_1.php">Primjer 1</a> - za javne, obiène korisnike i administratore</p>
<p><a href="dkermek_vjezba_13_2.php">Primjer 2</a> - za obiène korisnike i administratore</p>
<p><a href="dkermek_vjezba_13_3.php">Primjer 3</a> - za administratore</p>
<p><a href="dkermek_vjezba_13_4.php">Lista korisnika</a></p>

<?php
include("footer.php");
?>
