<?php
session_start();

include("header.php");
?>

<p><a href="dkermek_vjezba_13_2.php">Primjer 2</a></p>
<p><a href="dkermek_vjezba_13_3.php">Primjer 3</a></p>

<?php
if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
} else {
?>
<p><a href="dkermek_aplikacija.php">Pocetak aplikacije</a><br>
<?php
}

include("footer.php");
?>
