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

include("header.php");
?>
<p><a href="dkermek_vjezba_13_1.php">Primjer 1</a></p>
<p><a href="dkermek_vjezba_13_2.php">Primjer 2</a></p>
<p><a href="dkermek_aplikacija.php">Po�etak aplikacije</a><br>

<?php
include("footer.php");
?>
