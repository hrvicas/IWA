<?php

function dodajKorisnika () {
?>
	<script type="text/javascript">
	function provjeraUnosa ()
	{
	var a=document.forms["regakorisnika"]["korisnik"].value;
	var b=document.forms["regakorisnika"]["ime"].value;
	var c=document.forms["regakorisnika"]["prezime"].value;
	var d=document.forms["regakorisnika"]["lozinka"].value;
	var e=document.forms["regakorisnika"]["email"].value;
	var f=document.forms["regakorisnika"]["vrsta"].value;
	if (a==null || a=="", b==null || b=="", c==null || c=="", d==null || d=="", e==null || e=="", f==null || f=="") {
		alert("Sva polja su obavezna");
		return false;
		}
	}
	</script>

		<form onsubmit="return provjeraUnosa()" name="regakorisnika" method="post" action="regausera.php">
			<table class="statistika" border="2" width="80%">
				<tr>
					<td width="50%">Korisničko ime:</td>
					<td><input type="text" name="korisnik" size="80%" id="a"></td>
				</tr>
				<tr>
					<td>Ime korisnika:</td>
					<td><input type="text" name="ime" size="80%" id="b"></td>
				</tr>
				<tr>
					<td>Prezime korisnika:</td>
					<td><input type="text" name="prezime" size="80%" id="c"></td>
				</tr>
				<tr>
					<td>Lozinka korisnika:</td>
					<td><input type="password" name="lozinka" size="80%" id="d"></td>
				</tr>
				<tr>
					<td>Email adresa korisnika:</td>
					<td><input type="text" name="email" size="80%" id="e"></td>
				</tr>
				<tr>
					<td>Vrsta korisnika:</td>
					<td><input type="text" name="vrsta" size="80%" id="f" readonly="1" placeholder="Default je 1"></td>
				</tr>
			</table>
			<input method="post" name="submit" type="submit" value="Pošalji">
			<input type="reset" name="reset" value="Obriši">
		</form>
	<?php
}

function brisiKorisnika () {
	?>
	<p align="center"><h4>Odaberi jednog ili više korisnika za brisanje!</h4></p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?><?= '?run=brisi_korisnika' ?>" method="POST">
		<input type="submit" name="delete" value="Obriši"><br>
		<br>
	<?php
	global $con;
	$dbh= initDB ();
	if (mysqli_connect_errno()) {
  		echo "Neuspješno spajanje na poslužitelj: " . mysqli_connect_error();
  	}
		$result = mysqli_query($con,"SELECT * FROM KORISNIK");
		if (mysqli_error($con)) {
		echo ("Neuspješan upit: " . mysqli_error($con));
		}
		$count = mysqli_num_rows($result);

  		if (isset($_POST['delete'])) {
  			
    			for($i = 1; $i <= $count; $i++){
    				if(isset($_POST['checkbox' . $i]))
    				{
						$del_id = $_POST['checkbox' . $i];
					
        				$brisi = mysqli_query($con,"DELETE from korisnik WHERE korisnik.korisnik = '" . $del_id . "';");
        				$brisi2 = mysqli_query($con,"DELETE from roba WHERE roba.korisnik = '" . $del_id . "';");
        				$brisi3 = mysqli_query($con,"DELETE from narudzbenica WHERE narudzbenica.korisnik = '" . $del_id . "';");
        				$brisi3 = mysqli_query($con,"DELETE from primka WHERE primka.korisnik = '" . $del_id . "';");
           				echo "<strong>Izbrisali ste korisnika:' " . $del_id . "' u tablici korisnik: </strong>";
      				 	 if (!$brisi) {
						echo ("Greška kod brisanja korisnika" . mysqli_error($con));
					}
    			}
			}
		}
			$sql = "SELECT * FROM KORISNIK";
			$result = mysqli_query($con,$sql);
			if (!$result) {
  				echo ("Neuspješan upit: " . mysqli_error($con));
  			}	
			$count = mysqli_num_rows($result);
		
			echo "<table class='pregled_robe' border='1' width='90%' align='center'>";
			echo "<th>Odaberi</th><th>Korisnik</th><th>Ime</th><th>Prezime</th><th>Lozinka</th><th>Email</th><th>Vrsta</th>";

			$brojacRedova = 0;
			while($row = mysqli_fetch_array($result))
			  {
			  	$brojacRedova ++;
			  echo "<tr>";?>
			  	<td><input name='checkbox<?= $brojacRedova ?>' type='checkbox' value="<?php echo $row[0];?>"></td>
			  <?php
			  echo "<td>" . $row[0] . "</td>";
			  echo "<td>" . $row[1] . "</td>";
			  echo "<td>" . $row[2] . "</td>";
			  echo "<td>" . $row[3] . "</td>";
			  echo "<td>" . $row[4] . "</td>";
			  echo "<td>" . $row[5] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";
	?>
		</form>	
	<?php
	mysqli_free_result($result);
	mysqli_close($con);
}

function azurirajKorisnika () {
?>
<p align="center"><strong>Odaberi jednog korisnika za ažuranje!</strong></p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?><?= '?run=azuriraj_korisnika' ?>" method="POST">
	<input type="submit" name="edit" value="Ažuriraj"><br>
<?php
global $con;
$dbh= initDB ();
if (mysqli_connect_errno()) {
  	echo "Neuspješno spajanje na poslužitelj: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM KORISNIK");
		if (mysqli_error($con)) {
  			echo ("Neuspješan upit na korisnika: " . mysqli_error($con));
  		}
		$count = mysqli_num_rows($result);
	
	if (isset($_POST['edit'])) {
		for ($i=1; $i <= $count ; $i++) { 
			if (isset($_POST['radio' . $i])) {
				$edit_id=$_POST['radio' . $i];
				$korisnik= htmlspecialchars($_POST['korisnik']);
				$ime= htmlspecialchars($_POST['ime']);
				$prezime = htmlspecialchars ($_POST['prezime']);
				$lozinka = htmlspecialchars($_POST['lozinka']);
				$email = htmlspecialchars($_POST['email']);
				$vrsta = htmlspecialchars ($_POST['vrsta']);

				if ($count > 0) {	
					if	(!empty($_POST['korisnik'])) {
							$sql = mysqli_query($con,"UPDATE korisnik SET korisnik='" . $korisnik . "' WHERE korisnik='" . $edit_id . "'");
							}			
					if	(!empty($_POST['ime'])) {		
							$sql = mysqli_query ($con,"UPDATE korisnik SET ime='" . $ime . "' WHERE korisnik='" . $edit_id . "'");
							}
					if	(!empty($_POST['prezime'])) {
							$sql =  mysqli_query($con,"UPDATE korisnik SET prezime='" . $prezime . "' WHERE korisnik='" . $edit_id . "'");
							}
					if	(!empty($_POST['lozinka'])) {
							$sql = mysqli_query($con,"UPDATE korisnik SET lozinka='" . $lozinka . "' WHERE korisnik='" . $edit_id . "'");
							}
					if	(!empty($_POST['email'])) {
							$sql = mysqli_query($con,"UPDATE korisnik SET email='" . $email . "' WHERE korisnik='" . $edit_id . "'");
							}
					if	($_POST['vrsta'] != null || $_POST['vrsta'] != ' ') {
							$sql = mysqli_query($con,"UPDATE korisnik SET vrsta='" . $vrsta . "' WHERE korisnik='" . $edit_id . "'");
					}
							echo "<strong>Izvršili ste promjenu u tablici korisnik na korisniku: </strong>" . $edit_id ;
				}		
			}
		}
	}

	$sql = "SELECT * FROM KORISNIK";
	$result = mysqli_query($con,$sql);
		if (mysqli_error($con)) {
  			echo ("Neuspješan upit na korisnika: " . mysqli_error($con));
  		}
		$count = mysqli_num_rows($result);

			echo "<table class='pregled_robe' border='1' width='90%' align='center'>";
			echo "<th>Odaberi</th><th>Korisnik</th><th>Ime</th><th>Prezime</th><th>Lozinka</th><th>Email</th><th>Vrsta</th>";

			$brojacRedova = 0;
			while($row = mysqli_fetch_array($result)) {
				$brojacRedova ++;
			    	echo "<tr>";?>
			  		<td><input name='radio<?= $brojacRedova ?>' type='radio' value="<?php echo $row[0];?>"></td>
			<?php
			
			  echo "<td>" . $row[0] . "</td>";
			  echo "<td>" . $row[1] . "</td>";
			  echo "<td>" . $row[2] . "</td>";
			  echo "<td>" . $row[3] . "</td>";
			  echo "<td>" . $row[4] . "</td>";
			  echo "<td>" . $row[5] . "</td>";
			  echo "</tr>";
			  }
			  echo "<tr>";
			  echo "<td>Polje unosa</td>";
			  ?>
			  <td><input type="text" name="korisnik"></td>
			  <td><input type="text" name="ime"></td>
			  <td><input type="text" name="prezime"></td>
			  <td><input type="text" name="lozinka"></td>
			  <td><input type="text" name="email"></td>
			  <td><input type="text" name="vrsta"></td>;
			  <?php echo "</table>";
			  echo "</form>";

	mysqli_free_result($result);
	mysqli_close($con);
}

function pregledKorisnika () {

	echo "<table class='pregled_robe' border='1' width='100%' align='center'>
		<tr>
		<th>Korisnik</th><th>Ime</th><th>Prezime</th><th>Lozinka</th><th>Email</th><th>Vrsta</th>
		</tr>";
	global $con;
	$dbh= initDB ();
		$sql = "SELECT * FROM KORISNIK";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($result))
		{
		echo "<tr>";
		echo "<td>" . $row['0'] . "</td>";
		echo "<td>" . $row['1'] . "</td>";
		echo "<td>" . $row['2'] . "</td>";
		echo "<td>" . $row['3'] . "</td>";
		echo "<td>" . $row['4'] . "</td>";
		echo "<td>" . $row['5'] . "</td>";
		echo "</tr>";
		}
		echo "</table>";

		mysqli_free_result($result);
		mysqli_close($con);	
		
}

function dodajNarudzbu1 () {
	?>
	<p align="center"><strong>Odaberi i unesi količinu artikala koje želite kupiti</strong></p>

		<form name="evoNarudzbe" method="POST" action="dodaj_narudzbu.php">
			<input type="submit" name="dodaj" value="Dodaj u košaricu!">
			<br><br>
			<input type="reset" name="reset" value="Obriši">
			<br><br>
				<?php
					global $con;
					$dbh= initDB ();

					if (mysqli_connect_error()) {
						echo "Neuspješno spajanje na poslužitelj. Connect error:" . mysqli_error($dbh);
					}

					$result= mysqli_query($con, "SELECT roba.naziv, vrsta_robe.naziv, roba.url, roba.kolicina, roba.cijena, roba.roba FROM roba INNER JOIN vrsta_robe ON roba.vrsta=vrsta_robe.vrsta");
					
						if (mysqli_error($con)) {
							echo "Neuspješan upit, pokušajte ponovo." . mysqli_error($con);
						}
					$count= mysqli_num_rows($result);?>

						<table class='pregled_robe' border='1' width='90%' align='center'>

							<th>Naziv</th><th>Vrsta</th><th>Link</th><th>Dostupno</th><th>Cijena</th><th>Unesi željenu količinu</th>
 									
                  	<?php $brojacRedova = 0 ;
						while ( $row= mysqli_fetch_array($result)) {
							$brojacRedova ++;?>
						<tr>
							<td><input name='naziv<?= $brojacRedova ?>' readonly value='<?=$row[0]?>'><input name="id<?= $brojacRedova ?>" hidden value="<?= $row['roba'] ?>"</td>
								<td><?= $row[1] ?></td>
								<td><?= $row[2] ?></td>
								<td><?= $row[3] ?></td>
								<td><?= $row[4] ?></td>
								<td><input type='text' name='kolicina<?= $brojacRedova ?>'></td>
								
							</tr>
           				<?php
           				 }
           				 ?>
								</table>
			<input type="hidden" value="<?= $brojacRedova ?>" name="brojac" />
		</form>

		<?php 
		mysqli_free_result($result);
		mysqli_close($con);
}

function pregledNarudzbe () {

	echo $_POST['dodaj'];
	global $con;
	$dbh= initDB ();
		if (mysqli_connect_error()) {
			echo "Neuspješno spajanje na poslužitelj. Connect error:" . mysqli_error($dbh);
		}
		$result= mysqli_query($con, "SELECT roba.naziv, vrsta_robe.naziv, roba.url, roba.kolicina, roba.cijena FROM roba INNER JOIN vrsta_robe ON roba.vrsta=vrsta_robe.vrsta");
			if (mysqli_error($con)) {
				echo "Neuspješan upit, pokušajte ponovo." . mysqli_error($con);
			}
			$count= mysqli_num_rows($result);

		if (isset($_POST['dodaj'])) {
			for ($i=0; $i < $count; $i++) { 
				if (isset($_POST['kolicina' . $i])) {
					$edit_ide = $_POST ['kolicina' . $i];
				}
			}
		}
}

function brisiNarudzbu () {
	echo "TEST";
}

function azurirajNarudzbu () {
	echo "TEST";
}

function statusNarudzbi0 () {
	echo "<p align='center'><strong>Popis svih narudžbi sa statusom 0 ( otvorene narudžbe - nije kreirana izdatnica )</strong></p>";
		global $con;
		$dbh= initDB ();
			
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Narudžbenica broj</th><th>Korisničko ime</th><th>Korisničko prezime</th><th>Datum narudžbe</th><th>Status narudžbe</th>
			</tr>";

			$sql = "SELECT n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status FROM narudzbenica n, korisnik k WHERE n.status='0' AND n.korisnik = k.korisnik;";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";
			mysqli_free_result($result);
			mysqli_close($con);	
}

function statusNarudzbi1 () {
		echo "<p align='center'><strong>Popis svih narudžbi sa statusom 1 ( nerealizirane narudžbe - nije kreirana izdatnica )</strong></p>";
		global $con;
		$dbh= initDB ();

			$sql = "SELECT n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status FROM narudzbenica n, korisnik k WHERE n.status='1' AND n.korisnik = k.korisnik;";
			$result = mysqli_query($con,$sql);
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Narudžbenica broj</th><th>Korisničko ime</th><th>Korisničko prezime</th><th>Datum narudžbe</th><th>Status narudžbe</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";
			mysqli_free_result($result);
			mysqli_close($con);
}

function statusNarudzbi2 () {
	echo "<p align='center'><strong>Popis svih narudžbi sa statusom 2 ( zatvorene narudžbe - kreirana izdatnica )</strong></p>";
		global $con;
		$dbh= initDB ();
			$sql = "SELECT n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status FROM narudzbenica n, korisnik k WHERE n.status='2' AND n.korisnik = k.korisnik;";
			$result = mysqli_query($con,$sql);
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Narudžbenica broj</th><th>Korisničko ime</th><th>Korisničko prezime</th><th>Datum narudžbe</th><th>Status narudžbe</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";
			mysqli_free_result($result);
			mysqli_close($con);
}

function pregledNarudzbi () {
	echo "<p align='center'><strong>Popis svih narudžbi</strong></p>";
		global $con;
		$dbh= initDB ();
			$sql = "SELECT * FROM narudzbenica";
			$result = mysqli_query($con,$sql);
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Narudžbenica broj</th><th>Naručio korisnik</th><th>Datum narudžbe</th><th>Status narudžbe</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";

			mysqli_free_result($result);
			mysqli_close($con);		
}

function dodajPrimku () {
global $con;
?>
<center>
<?php
	echo "<p><strong>Forma za unos primki: </strong></p>";

	if (isset($_POST['submit1'])) {
		$odab_naziv = $_POST['naziv'];
			$dbh = initDB();
				$sql = "SELECT roba, cijena FROM roba WHERE naziv = '" . $odab_naziv . "'";
				$result = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
					while ($row = mysqli_fetch_array($result)) {
						$id_roba = $row['0'];
						$cijena = $row['1'];
					}
	}
	else {
		$odab_naziv = "";
		$id_roba = "";
		$cijena = "";
	}
?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?><?= '?run=dodaj_primku' ?>">
		<td><select name="naziv">
				<?php
					$dbh = initDB();
					$sql="SELECT naziv FROM roba";
					$result = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
						while ($row = mysqli_fetch_array($result)) {
							$naziv = $row['0'];
							if ($odab_naziv == $naziv) {
							echo "<option value='$naziv' selected='selected'>$naziv</option>";
							}
							else {
								echo "<option value='$naziv'>$naziv</option>";
							}
						}
				?>
		</td></select>
		<input type="submit" name="submit1" value="Odaberi">
	</form>
<p>Zatim upiši željenu količinu u polje za količinu</p>

<?php

	$dbh = initDB();
		$sql = "SELECT max(broj) FROM primka";
		$reza = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
		while ($row = mysqli_fetch_array($reza)) {
		$id_primke = $row['0']; 
		$id_primke = $id_primke + 1;
		}
		

	if (isset($_POST['submit'])){
		$primka = htmlspecialchars(($_POST['primka']));
		$korisnik = provjera_inputa($_POST['korisnik']);
		$primljeno = provjera_inputa ($_POST['primljeno']);
		$stavka = provjera_inputa ($_POST['stavka']);
		$roba = provjera_inputa ($_POST['id_roba']);
		$naziv = provjera_inputa ($_POST['naziv']);
		$kolicina = provjera_inputa ($_POST['kolicina']);
		$cijena = provjera_inputa ($_POST['cijena']);
		
		$primka = $_POST['primka'];
		$korisnik = $_POST['korisnik'];
		$primljeno =  $_POST['primljeno'];
		$stavka = $_POST['stavka'];
		$roba =  $_POST['id_roba'];
		$naziv =  $_POST['naziv'];
		$kolicina =  $_POST['kolicina'];
		$cijena =  $_POST['cijena'];

		$sql="SELECT kolicina, jm FROM roba WHERE roba = " . $_POST['id_roba'] . ";";
		$result = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
		while ($row = mysqli_fetch_array($result)) {
		$staraKol = $row['0'];
		$jedMjere = $row['1'];
		}
		
		$sql = "UPDATE ROBA set `kolicina` = `kolicina` + " . $kolicina . " WHERE roba = " . $_POST['id_roba'] . ";";
		$result1 = mysqli_query($con,$sql);
		if (mysqli_error($con)) {
			echo mysqli_error($con);
		}
		 
		echo "<br/>Korigirano je u bazi stanje za artikal : " . $naziv . " sa količinom od: " . $kolicina . $jedMjere . ". Stara Količina : " . $staraKol . $jedMjere . "<br/>";

		$sql = "INSERT into primka (`broj`,`korisnik`,`roba`,`kolicina`,`primljeno`) VALUES (" . $id_primke . ", '" . $_POST['korisnik'] . "'," . $roba . "," . $kolicina . ", " . $primljeno . ")";

		$result = mysqli_query($con,$sql);
		if (mysqli_error($con)) {
			echo (mysqli_error($con));

		}
	}

?>
		<form name="dodajprimku" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?><?= '?run=dodaj_primku' ?>"><center>
			<table class="statistika" border="2" width="70%" >
				<tr>
					<td width="5%" align="center">Primka:</td><td width="8%" align="center">Korisnik:</td><td width="35%" align="center" colspan="3">Datum zaprimanja:</td></tr>
				<tr>	
					<td align="center"><input type="text" name="primka" align="center" size="10%" id="a" value="<?php echo $id_primke;?>"></td>

					<td align="center"><input type="text" name="korisnik"  size="5%" align="center" id="b" value="<?php echo $_SESSION['iwa_korisnik'];?>"></td>

					<td colspan="3"  align="center"><input type="date" name="primljeno" size="35%" align="center" id="c" value="<?php echo date('Y-m-d');?>">(gggg-mm-dd)</td>
				</tr><br>
				<tr>
					<td align="center">Stavka:</td><td align="center">IdRoba</td><td align="center" size="50%">Naziv</td><td align="center">Količina</td><td align="center">Cijena</td>
				</tr>
				<tr>	
					<td  align="center"><input type="text" name="stavka" size="10%" id="d" value="1"></td>

					<td align="center"><input type="text" name="id_roba" size="10%" align="center" id="e" value="<?php echo $id_roba;?>"></td>

					<td  align="center"><input type="text" name="naziv" size="60%" id="f" value="<?php echo $odab_naziv; ?>"></td>

					<td  align="center"><input type="text" name="kolicina" size="15%"  align="center" id="g"></td>

					<td  align="center"><input type="text" name="cijena" size="15%"  align="center" id="h" value="<?php echo $cijena; ?>"></td>
				<tr>
					<td align="center" colspan="3">Ukupna vrijednost: </td>
					<td align="center" colspan="2"><input type="text"></td>
				</tr>
				</tr>
			</table>
			<input method="post" name="submit" type="submit" value="Pošalji">
			<input type="reset" name="reset" value="Obriši">
		</form>
	</center>
<?php
}

function infoRoba () {
	echo "<p align='center'><strong>Pregled pojedine robe u skladištu</strong></p>";
global $con;

	if (isset($_POST['submit'])) {
		$odab_naziv = $_POST['naziv'];
	}
	else{
		$odab_naziv = "";
	}
	
?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']?><?= '?run=info_roba' ?>">
		<td><select name="naziv">
						<?php
							$dbh = initDB();
							$sql="SELECT naziv FROM roba";
							$result = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
							while ($row = mysqli_fetch_array($result)) {
								$naziv = $row['0'];
								if ($odab_naziv == $naziv) {
									echo "<option value='$naziv' selected='selected'>$naziv</option>";
								}
								else {
									echo "<option value='$naziv'>$naziv</option>";
								}
							}
						?>
		</td></select>
		<input type="submit" name="submit" value="Odaberi">
	</form>

<?php
	
	$dbh = initDB();
	$sql = "SELECT r.roba, r.naziv, v.naziv, r.kolicina FROM roba r, vrsta_robe v WHERE r.naziv ='$odab_naziv' AND r.vrsta = v.vrsta;";
	$result = mysqli_query($con,$sql);
		echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>ID robe</th><th>Naziv robe</th><th>Vrsta robe</th><th>Količina na stanju</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";

			mysqli_free_result($result);
			mysqli_close($con);	

}

function pregledZaliha () {
	echo "<p align='center'><strong>Pregled stanja zaliha svih predmeta</strong></p>";
		global $con;
		$dbh= initDB ();
		$sql = "SELECT r.roba, r.naziv, r.jm, r.kolicina from roba r";
		$result = mysqli_query($con,$sql);

			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Id robe</th><th>Naziv robe</th><th>Jed. mjere</th><th>Količina</th></tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";

			mysqli_free_result($result);
			mysqli_close($con);	
}

function pregledNarudzbiUser () {
	echo "<p align='center'><strong>Popis mojih narudžbi</strong></p>";
	$user_1 = $_SESSION['iwa_korisnik'];
		global $con;
		$dbh= initDB ();
			$sql = "SELECT * FROM narudzbenica WHERE korisnik = '$user_1'";
			$result = mysqli_query($con,$sql);
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Narudžbenica broj</th><th>Naručio korisnik</th><th>Datum narudžbe</th><th>Status narudžbe</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";

			mysqli_free_result($result);
			mysqli_close($con);		
}

function preuzeoRobu () {
	echo "<p align='center'><strong>Popis preuzete robe za korisnika : " . $_SESSION['iwa_korisnik'] . "</strong></p>";
	$user_1 = $_SESSION['iwa_korisnik'];
		global $con;
		$dbh= initDB ();
			$sql = "SELECT izd.broj, izd.narudzbenica, izd.stavka, izd.roba, izd.kolicina, rob.naziv from izdatnica izd left join roba rob on izd.roba = rob.roba where izd.stavka in(select stavka from stavka where narudzbenica in(select narudzbenica from narudzbenica where korisnik in(select korisnik from korisnik where korisnik = '" . $user_1 . "')));";
			$result = mysqli_query($con,$sql);
			echo "<table class='statistika' border='1' width='70%' align='center'>
			<tr>
			<th>Izdatnica broj</th><th>Narudžbenica broj</th><th>Stavka</th><th>ID robe</th><th>Količina</th><th>Naziv</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td align='center'>" . $row['0'] . "</td>";
			  echo "<td align='center'>" . $row['1'] . "</td>";
			  echo "<td align='center'>" . $row['2'] . "</td>";
			  echo "<td align='center'>" . $row['3'] . "</td>";
			  echo "<td align='center'>" . $row['4'] . "</td>";
			  echo "<td align='center'>" . $row['5'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";

			mysqli_free_result($result);
			mysqli_close($con);		
}

function provjera_inputa($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = htmlentities($data); 
	return ($data);
	}