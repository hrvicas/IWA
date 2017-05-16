<?php


function initDB() {

	global $con;

	$server ='localhost';
	$baza ='iwa_2008_kz_projekt';
	$korisnik ='iwa_2008';
	$lozinka ='FOI';

	$con = mysqli_connect($server,$korisnik,$lozinka,$baza);
		if (mysqli_connect_errno($con)) {
			echo "Problem sa spajanjem na poslužitelj" . mysqli_connect_error();
		}

		return $con;

}

?>
