<?php 
include('autorizacija.php');

session_start();

if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

$potrebna_vrsta = 0;

$status = autorizacija($potrebna_vrsta);
//echo $status;
if ($status < 0) {
	header("Location: error.php?e=$status");
	exit();
}

$korisnik = $_GET["korisnik"];

$dbh = initDB();		// inicijalizacija veze prema bazi podataka

$sql = "select korisnik, ime, prezime, gid from OSOBE where korisnik = '$korisnik'";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upita na bazu podataka!<br>";
	echo mysql_error();
	exit;
}

$broj = mysql_num_rows($rs);
	
if($broj == 1) {
	list($korisnik, $ime, $prezime, $grupa_id) = mysql_fetch_array($rs);
}

include("header.php");
?>

<script>
function kontrolaUnosa(obrazac) {
	return true
}
</script>

<center>
<form name="vjezba8" method="post" action="dkermek_vjezba_13_8.php" onsubmit="return kontrolaUnosa(this)">
<table class="formular">
<tr><td class="labela">Korisnièko ime:</td><td class="unos"><input type="text" name="korisnik" size="10" maxlength="20" value="<?php echo $korisnik; ?>" readonly="true"></td></tr>
<tr><td class="labela">Ime:</td><td class="unos"><input type="text" name="ime" size="10" maxlength="20" value="<?php echo $ime; ?>" readonly></td></tr>
<tr><td class="labela">Prezime:</td><td class="unos"><input type="text" name="prezime" size="10" maxlength="20" value="<?php echo $prezime; ?>" readonly></td></tr>
<tr><td class="labela">Grupa:</td><td class="unos">
<select name="grupa_id">

<?php
$sql = "select gid, naziv from GRUPE ORDER BY naziv";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upita na bazu podataka!<br>";
	echo mysql_error();
	exit;
}

$broj = mysql_num_rows($rs);
	
while( list($gid, $naziv) = mysql_fetch_array($rs)) {
?>
<option value="<?php echo "$gid"; ?>" <?php if($grupa_id == $gid) echo "selected"; ?>><?php echo "$naziv"; ?></option>
<?php
}

mysql_close();
?>
</select>
</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Pošalji "></td></tr>
</table>
</form>
</center>

<?php
include("footer.php");
?>
