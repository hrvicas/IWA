<?php 
session_start();

include_once 'config.php';
include_once 'funkcije.php';

$korisnik = $_POST['korisnik'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$lozinka = $_POST['lozinka'];
$email = $_POST['email'];
$vrsta = $_POST['vrsta'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{	
	$korisnik= provjera_inputa($_POST['korisnik']);
	$ime= provjera_inputa($_POST['ime']);
	$prezime = provjera_inputa ($_POST['prezime']);
	$lozinka = provjera_inputa ($_POST['lozinka']);
	$email = provjera_inputa ($_POST['email']);
	$vrsta = provjera_inputa ($_POST['vrsta']);
}

	$dbh = initDB();
	$result = mysqli_query($con,"SELECT korisnik, email FROM korisnik WHERE korisnik='$korisnik' AND email='$email'");
	if (! $result) {
		echo "Problem kod upita na bazu podataka na bazu podataka";
		exit;	
	}
	$broj = mysqli_num_rows($result);
	if ($broj==1) {
		header("Location: error.php?e=3");
		exit;
	}
	else {
		if (!mysqli_query($con, "INSERT INTO korisnik (korisnik, ime, prezime, lozinka, email, vrsta) VALUES ('$korisnik', '$ime', '$prezime', '$lozinka', '$email', '$vrsta')")) {
		echo "Problem kod upisivanja korisnika u bazu podataka";
		exit;	
		}
		else {
			echo "Izvršili ste registraciju korisnika!";
			header("Location: pregled_robe.php");				
		}

	}
		mysqli_free_result($result);
	mysqli_close();
		
?>