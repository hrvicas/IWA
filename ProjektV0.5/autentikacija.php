<?php
include_once("config.php");

function autentikacija($p_user,$p_password)
{

	//postavljanje naziva globalnih varijabli
	global $vrsta;
	global $ime_prezime;
	global $con;
	$result = -1;
	//inicijalizacija veze prema bazi podataka
	$dbh = initDB();
	$result = mysqli_query($con,"SELECT korisnik, ime, prezime, lozinka, vrsta FROM korisnik WHERE korisnik = '$p_user'");
	//ako je uspješno spajanje ali nema upita na bazu podataka pokazuje idući odlomak koda
	if (! $result) {
		echo "Problem kod upita na bazu podataka na bazu podataka";
		exit;	
	}

	$broj = mysqli_num_rows($result);

	if ($broj==1) 
	{
		//spremanje podataka iz vađenog niza
		list($korisnik, $ime, $prezime, $lozinka, $vrsta)=mysqli_fetch_array($result);

		if ($lozinka==$p_password) {
			$ime_prezime = $ime . " " . $prezime;
			$result = 1; 
		}
		//else { 
		//	$result = 0;
		//}
	}
	
	else {
		$result = -1;
	}
	mysqli_close($con);

	return $result;
}
?>