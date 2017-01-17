<?php
include('autorizacija.php');
session_start();

if (!isset($_SESSION["iwa_2008_kz_projekt"]) && !isset($_SESSION["iwa_korisnik"]))
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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin page</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="bs_body">
		<div class="gore_nav">
			<?php
					include("header2.php");
					include 'funkcije.php';
			?>
			<ul class="nav">
					<li><a href="admin_usera.php">Korisnici</a></li>
					<li><a href="admin_narudzbi.php">Administracija narudžbi</a></li>
					<li><a href="admin_zaliha.php">Stanje na zalihi</a></li>		
			</ul>
			<hr>
		</div>
			<!-- LIJEVA NAVIGACIJA PO STRANICI -->
			<div class="left_bar">
				<li><a class="veza" href="?run=dodaj_korisnika">Dodaj korisnika</a></li><br>
				<li><a class="veza" href="?run=brisi_korisnika">Briši korisnika</a></li><br>
				<li><a class="veza" href="?run=azuriraj_korisnika">Ažuriraj korisnika</a></li><br>
				<li><a class="veza" href="pregled_robe.php">Povratak na pregled robe</a></li><br>
			</div>

			<!-- SADRŽAJ -->
			<div class="content"><center>
			<?php
			//echo $_SESSION['vrsta']; echo "<br>";
			//echo "$potrebna_vrsta"; echo "<br>";
			//SKRIPTA ZA IZBOR LINKOVA
			if (isset($_GET['run'])) $izborlinkova=$_GET['run'];
			else $izborlinkova='';
			switch ($izborlinkova) {
				case 'dodaj_korisnika':
					dodajKorisnika();
					break;
				case 'brisi_korisnika':
					brisiKorisnika();
					break;
				case 'azuriraj_korisnika':
					azurirajKorisnika();
					break;
				default:
					pregledKorisnika();
					break;
				}
			?>
		
			</center></div>
			<!-- PODNOŽJE -->
			<div style="padding-top: 10px; position: relative; clear: both; width: 100% ">
			<?php
			include("footer.php");
			?>
			</div>
	</div>