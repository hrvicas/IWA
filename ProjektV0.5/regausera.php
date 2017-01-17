<?php 
session_start();

include_once 'config.php';
// 'autorizacija.php';
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
}

function provjera_inputa($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;	
}

	$dbh = initDB();
	$result = mysqli_query($con,"SELECT korisnik, email FROM korisnik WHERE korisnik='$korisnik' AND email='$email'");
	if (! $result) {
		echo "Problem kod upita na bazu podataka na bazu podataka";
		exit;	
	}
	$broj = mysqli_num_rows($result);
	if ($broj==1) {
		//while ($row = mysqli_fetch_array($result)) {
			//if (($row['0']==$_POST['korisnik']) && ($row['1']==$_POST['ime']) && ($row['2']==$_POST['prezime']) && ($row['3']==$_POST['lozinka']) && ($row['4']==$_POST['email'])) {
		header("Location: error.php?e=3");
		exit;
	}
	else {
		/*
		try{
		$korisnikJeAdmin = autorizacija(0);
	}catch(Exception $ex)
	{$korisnikJeAdmin = -2;}

		if ($korisnikJeAdmin < 0)
			{ $vrsta = 1; }
			*/
		if (!mysqli_query($con, "INSERT INTO korisnik (korisnik, ime, prezime, lozinka, email, vrsta) VALUES ('$korisnik', '$ime', '$prezime', '$lozinka', '$email', '$vrsta')")) {
		//ako je uspješno spajanje ali nema upita na bazu podataka pokazuje idući odlomak koda
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