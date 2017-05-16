<?php
include('autorizacija.php');
session_start();

if (!isset($_SESSION["iwa_2008_kz_projekt"]) && !isset($_SESSION["iwa_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

$potrebna_vrsta = 1;

$status = autorizacija($potrebna_vrsta);

if ($status < 0) {
	header("Location: error.php?e=$status");
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Pregled narudžbi</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		include("header.php");
		include 'funkcije.php';
	?>
<center>
<p>
	<ul class="nav">
		<li><a href="registrirajse.php">Registracija korisnika</a></li>
		<li><a href="naruci.php">Naruči robu</a></li>
		<li><a href="ured_narudzbi.php">Administracija narudžbi</a></li>
		<li><a href="admin_usera.php">Administratorska stranica</a></li>
	</ul>
</p>
<hr>
			<div class="left_bar">
				<li><a class="veza" href="?run=pregled_narudzbi">Pregled mojih narudzbi</a></li><br>
				<li><a class="veza" href="?run=preuzeta_roba">Roba koju sam preuzeo</a></li><br>
				<li><a class="veza" href="?run=info_roba">Informacija o pojedinoj robi</a></li><br>
				<li><a class="veza" href="pregled_robe.php">Povratak na pregled robe</a></li><br>
			</div>
<div class="content"><center>
	
	<?php
			
					if (isset($_GET['run'])) $izborlinkova=$_GET['run'];
					else $izborlinkova='';
					switch ($izborlinkova) {
						case 'pregled_narudzbi':
							pregledNarudzbiUser();
							break;
						case 'preuzeta_roba':
							preuzeoRobu();
							break;
						case 'info_roba':
							infoRoba();
							break;
						default:
							pregledZaliha();
							break;
					}
			
	?>
</center></div>
			<div style="padding-top: 10px; position: relative; clear: both; width: 100% ">
			<?php
			include("footer.php");
			?>
			</div>
	</div>