<?php
include_once("config.php");

function autorizacija($potrebna_vrsta)
{
	$kid = -1;
	
	if (session_is_registered("KID"))
		$kid = $_SESSION["KID"];

	$result = -2;

	$dbh = initDB();		// inicijalizacija veze prema bazi podataka

	$sql = "select grupe.vrsta FROM grupe, OSOBE where OSOBE.KID = '$kid' and grupe.GID = OSOBE.GID";

	$rs = mysql_query($sql) or die("Greska: ".mysql_error());
	if(! $rs) {
		echo "Problem kod upita na bazu podataka!";
		echo mysql_error();
		exit;
	}

	$broj = mysql_num_rows($rs);
	
	if($broj == 1) {
		list($result) = mysql_fetch_array($rs);
		if($result != 0) {
			if($result != $potrebna_vrsta) {
				$result = -2;
			}
				
		}
	}
	else {
		$result = -2;
	}

	mysql_close();
	
	return $result;
}
?>
