<?php
session_start();

include("header.php");
?>
<center>
<table border="0" cellspacing="5" cellpadding="5">
<form action="dkermek_login.php" method="POST">
<tr>
<td>Korisnik</td>
<td><input type="text" size="10" name="f_user"></td>
</tr>
<tr>
<td>Lozinka</td>
<td><input type="password" size="10" name="f_pass"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit"
name="submit" value="Log In"></td> </tr> </form> </table>
</center>
<p><a href="dkermek_vjezba_13_0.php">Opis skripata</a></p>
<p><a href='dkermek_aplikacija.php'>Poèetak aplikacije</a></p>
<p><a href="dkermek_vjezba_13_4.php">Lista korisnika</a></p>
<p><a href="dkermek_vjezba_13_1.php">Primjer 1</a> - za javne, obiène korisnike i administratore</p>
<p><a href="dkermek_vjezba_13_2.php">Primjer 2</a> - za obiène korisnike i administratore</p>
<p><a href="dkermek_vjezba_13_3.php">Primjer 3</a> - za administratore</p>

<?php
include("footer.php");
?>
