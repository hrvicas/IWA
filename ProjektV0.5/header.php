<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
<title>Header</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header">
	<center>.
		<div>Nalazite se na početnoj stranici projektnog zadatka iz kolegija Izgradnja web aplikacija.</br>
	Pristup imaju javni, obični korisnici i admin!
		</div>
	Korisnik:
<?php
if (! (isset($_SESSION["iwa_2008_kz_projekt"])) && !(isset($_SESSION["iwa_korisnik"]))) {
	//if (empty($_SESSION["ime_prezime"])) {
		echo "niste prijavljeni...";
	} else {
		echo $_SESSION["ime_prezime"];
	}

?>

	</center>
<hr>
</div>