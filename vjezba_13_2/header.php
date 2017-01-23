<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>Vježba br. 13</title>
<link href="vjezba_13.css" rel="stylesheet" type="text/css">
</head> 
<body>
<center>
<table class="vanjska" border="0" cellspacing="0" cellpadding="0">
<tr><td><img src="images/PzaWeb.jpg">
</td></tr>
<tr><td>
<?php
if (! (isset($_SESSION["PzaWeb"]) && !(isset($_SESSION["PzaWeb_korisnik"]))))
{
?>
<center>
Pozdrav javnom korisniku
</center>
<p align="right"><a href="dkermek_login.php">Prijavljivanje</a></p>
<p align="right"><a href="index.php">Početak</a></p>
<?php
} else {
?>
<center>
Korisnik: <b>
<?php 
	echo $_SESSION["prezime_ime"];
?>
</center>
<p align="right"><a href="logout.php">Odjava</a></p>
<p align="right"><a href="index.php">Početak</a></p>
<?php
}
?>
