<?php
/*
function initDB() {
 	//definiranje parametara za inicijalizaciju veze prema bazi podataka
	$server ='localhost';
	$baza ='iwa_2008_kz_projekt';
	$korisnik ='iwa_2008';
	$lozinka ='FOI';

	$dbc=mysql_connect($server, $korisnik, $lozinka)
	or die ("Problem kod povezivanja na poslužitelj baze!<br/" . mysql_error());

	$dbh=mysql_select_db($baza, $dbc) 
	or die ("Problem kod povezivanja na bazu podataka!<br/". msql_error());

	return $dbh;
}
*/
//početni parametri za spajanje na bazu
function initDB() {
	$server ='localhost';
	$baza ='iwa_2008_kz_projekt';
	$korisnik ='iwa_2008';
	$lozinka ='FOI';
//postavljanje $con varijable za globalnu
global $con;
//spajanje na bazu podataka iwa_2008_kz_projekt
$con=mysqli_connect("$server", "$korisnik", "$lozinka", "iwa_2008_kz_projekt");

	if (mysqli_connect_errno()) {
		echo "Problem sa spajanjem na poslužitelj" . mysqli_connect_error();
	}

	return $con;
}

/*
	$res = mysqli_query($mysqli, "SELECT * from korisnik");

	echo "table class='pregled_robe'
	<tr>
	<th>Korisnik</th><th>Ime</th><th>Prezime</th><th>Lozinka</th>Email<th></th><th>Vrsta</th>
	</tr>";
	while ($row = mysqli_fetch_array($res)) 
	{
		echo "<tr>";
		echo "<td>" . $row['Korisnik'] . "</td>";
		echo "<td>" . $row['Ime'] . "</td>";
		echo "<td>" . $row['Prezime'] . "</td>";
		echo "<td>" . $row['Lozinka'] . "</td>";
		echo "<td>" . $row['Email'] . "</td>";
		echo "<td>" . $row['Vrsta'] . "</td>";
	}
	echo "</table>";
	mysqli_close($mysqli);
*/
?>