<?php
include_once("config.php");

function autentikacija($p_user,$p_password)
{

	global $vrsta;
	global $ime_prezime;
	global $con;
	$result = -1;
	
	$dbh = initDB();

	$result = mysqli_query($con,"SELECT korisnik, ime, prezime, lozinka, vrsta FROM korisnik WHERE korisnik = '$p_user'");
	
	if (! $result) {
		echo "Problem kod upita na bazu podataka na bazu podataka";
		exit;	
	}

	$broj = mysqli_num_rows($result);

	if ($broj==1) {
		list($korisnik, $ime, $prezime, $lozinka, $vrsta)=mysqli_fetch_array($result);

		if ($lozinka==$p_password) {
			$ime_prezime = $ime . " " . $prezime;
			$result = 1; 
		}

	}
	
	else {
		$result = -1;
	}
	mysqli_close($con);

	return $result;
}

?>