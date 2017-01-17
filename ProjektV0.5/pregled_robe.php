<?php
session_start();
include ("config.php");
 include("header.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Pregled robe</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>
<body>
	
<center>
<p><h3>STRANICA ZA PREGLED ROBE</h3>
	<ul class="nav">
		<li><a href="registrirajse.php">Registracija korisnika</a></li>
		<li><a href="naruci.php">Naruči robu</a></li>
		<li><a href="ured_narudzbi.php">Administracija narudžbi</a></li>
		<li><a href="admin_usera.php">Administratorska stranica</a></li>
	</ul>
</p>
<br>

	<h2><p>Lista proizvoda koje možete naručiti od nas!</p></h2>

	<?php
 	$dbh = initDB ();
		$result = mysqli_query($con,"SELECT r.roba, r.naziv, v.naziv, r.cijena from roba r, vrsta_robe v where r.vrsta = v.vrsta order by r.roba ");
			
			echo "<table width='70%' alighn='center' class='pregled_robe' border='1'>
				<tr>
				<th>Artikl br.</th>
				<th>Naziv</th>
				<th>Vrsta</th>
				<th>Cijena</th>
				</tr>";

		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
					echo "<td>" . $row['0'] . "</td>";
					echo "<td text-alighn='left'>" . $row['1'] . "</td>";
					echo "<td>" . $row['2'] . "</td>";
					echo "<td width='15%'>" . $row['3'] . "</td>";
					echo "</tr>";
				}
		echo "</table>";
		mysqli_free_result($result);
	mysqli_close($con);
	?>
</center>
<!-- PODNOŽJE -->
<div style="padding-top: 10px; position: relative; clear: both; width: 100% ">
<?php
include ("footer.php");
?>
</div>

