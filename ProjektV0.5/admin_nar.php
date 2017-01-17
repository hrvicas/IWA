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
				<li><a class="veza" href="?run=dodaj_narudzbu">Dodaj narudžbu</a></li><br>
				<li><a class="veza" href="?run=brisi_narudzbu">Briši narudžbu - opcionalne veza</a></li><br>
				<li><a class="veza" href="?run=azuriraj_narudzbu">Ažuriraj narudžbu - opcionalna veza</a></li><br>
				<li><a class="veza" href="?run=status_narudzbi0">Otvorene narudžbe (status: 0)</a></li><br>
				<li><a class="veza" href="?run=status_narudzbi1">Nerealizirane narudžbe (status: 1)</a></li><br>
				<li><a class="veza" href="?run=status_narudzbi2">Zatvorene narudžbe (status: 2)</a></li><br> 
				<li><a class="veza" href="pregled_robe.php">Povratak na pregled robe</a></li><br>
			</div>
			<!-- SADRŽAJ -->
			<div class="content"><center>
				<?php
			//SKRIPTA ZA IZBOR LINKOVA
					if (isset($_GET['run'])) $izborlinkova=$_GET['run'];
					else $izborlinkova='';
					switch ($izborlinkova) {
						case 'dodaj_narudzbu':
							dodajNarudzbu1();
							break;
						case 'azuriraj_narudzbu':
							azurirajNarudzbu();
							break;
						case 'brisi_narudzbu':
							brisiNarudzbu();
							break;
						case 'status_narudzbi0':
							statusNarudzbi0();
							break;
						case 'status_narudzbi1':
							statusNarudzbi1();
							break;
						case 'status_narudzbi2':
							statusNarudzbi2();
							break;
						default:
							pregledNarudzbe();
							break;
					}
					?>
		
			</center>

			</div>
			<!-- PODNOŽJE -->
			<div style="padding-top: 10px; position: relative; clear: both; width: 100% ">
			<?php
			include("footer.php");
			?>
			</div>
	</div>