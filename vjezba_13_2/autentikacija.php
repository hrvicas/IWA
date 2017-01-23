<?php
include_once("config.php");

function autentikacija($user, $pass)
{
	global $kid;
	global $prezime_ime;

	$result = -1;

	$dbh = initDB();		// inicijalizacija veze prema bazi podataka

	$sql = "select prezime, ime, lozinka, kid FROM OSOBE where korisnik = '$user'";
	$rs = mysql_query($sql) or die("Greska: ".mysql_error());
	if(! $rs) {
		echo "Problem kod upita na bazu podataka!";
		exit;
	}

	$broj = mysql_num_rows($rs);
	//echo "Broj: ".$broj."<br />";
	
	if($broj == 1) {
		list($prezime, $ime, $lozinka, $kid) = mysql_fetch_array($rs);
		//echo "Pass: ".$pass."<br />";
	
		if($lozinka == $pass) {
			//echo "Lozinke iste<br />";
			$prezime_ime = $prezime . " " . $ime;
			$result = 1;
		}
		else {
			$result = 0;
		}		
	}
	else {
		$result = -1;
	}

	mysql_close(); 
	
	return $result;
}
?>
