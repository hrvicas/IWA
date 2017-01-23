<?php
include('autorizacija.php');

session_start();

if (!isset($_SESSION["PzaWeb"]) && !isset($_SESSION["PzaWeb_korisnik"]))
{
	header("Location: error.php?e=2");
	exit();
}

$korisnik = $_GET["korisnik"];

$potrebna_vrsta = 0;

$status = autorizacija($potrebna_vrsta);

if ($status < 0 && (! (isset($HTTP_SESSION_VARS["PzaWeb"]) && isset($HTTP_SESSION_VARS["PzaWeb_korisnik"]) && $korisnik == $HTTP_SESSION_VARS["PzaWeb_korisnik"]))) 
{
	header("Location: error.php?e=$status");
	exit();
}

$dbh = initDB();		// inicijalizacija veze prema bazi podataka

$sql = "select korisnik, ime, prezime, lozinka, email, prog_jezik, prog_godina, pj1, pj2, pj3, pj4, pj5, pj6, pj7, pj8, pj9, pj10 from OSOBE where korisnik = '$korisnik'";

$rs = mysql_query($sql);
if(! $rs) {
	echo "Problem kod upita na bazu podataka!<br>";
	echo mysql_error();
	exit;
}

$broj = mysql_num_rows($rs);
	
if($broj == 1) {
	list($korisnik, $ime, $prezime, $lozinka, $email, $prog_jezik, $prog_godina, $pj1, $pj2, $pj3, $pj4, $pj5, $pj6, $pj7, $pj8, $pj9, $pj10) = mysql_fetch_array($rs);
}

mysql_close();

include("header.php");
?>
<script>
function kontrolaUnosa(obrazac) {
	re0 = new RegExp("^([a-z]){3,}");   
	ok0 = re0.test(obrazac.korisnik.value);   
	if (! ok0) {
		alert("Korisnik treba imati min 3 slova (mala)!");
		return false;
	}

	re1 = new RegExp("^[A-ZŠÐÈÆŽ]([a-zšðèæž]){2,}(-[A-ZŠÐÈÆŽ]([a-zšðèæž]){2,})?$");   
	re2 = new RegExp("^[A-ZŠÐÈÆŽ]([a-zšðèæž]){2,}\x20[A-ZŠÐÈÆŽ]([a-zšðèæž]){2,}$");   
	ok1 = re1.test(obrazac.ime.value);   
	ok2 = re2.test(obrazac.ime.value);   
	if (! (ok1 | ok2)) {
		alert("Ime treba imati min 3 slova!");
		obrazac.ime.focus();
		return false;
	}
	if(obrazac.ompjezik.selectedIndex == 0) {
		alert("Treba odabrati omiljeni p. jezik!");
		obrazac.ompjezik.focus();
		return false;	
	}
	var nemaIzbora = true;
	
	for(i=0;i < obrazac.godpjezik.length;i++) {
		if(obrazac.godpjezik[i].checked)
			nemaIzbora = false;
	}
	
	if(nemaIzbora) {
		alert("Treba odabrati broj godina iskustva!");
		obrazac.godpjezik[0].focus();
		return false;	
	}

	var trazi = "IWA="
	var tekst = obrazac.ime.value + " " + obrazac.prezime.value

	var upisano = pogledaj(trazi)
	upisi_cookie(trazi, tekst, 5)
	return true
}

function upisi_cookie(trazi, tekst, minuta) {
		var danas = new Date()	
		var istice = new Date()	
		istice.setTime(danas.getTime() + 10000*60*minuta)	
		document.cookie = trazi + tekst + "; expires=" + istice.toGMTString() + ";"
}

function pogledaj(trazi) {
	var kolacici = document.cookie
	var gotovo = false
	var vrijednost = ""
	if (kolacici.length > 0) {
		pocetak = kolacici.indexOf(trazi)
		
		if (pocetak != -1) {
			kolacici = kolacici.substring(pocetak + trazi.length, kolacici.length)
			kraj = kolacici.indexOf(";")
			if (kraj == -1) {
				kraj = kolacici.length
			}
			vrijednost = kolacici.substring(pocetak, kraj)
		}
	}
	return vrijednost;
}

</script>

<center>
<form name="vjezba8" method="post" action="dkermek_vjezba_13_6.php" onsubmit="return kontrolaUnosa(this)">
<table class="formular">
<tr><td class="labela">Korisnièko ime:</td><td class="unos"><input type="text" name="korisnik" size="10" maxlength="20" value="<?phpecho $korisnik; ?>" readonly="true"></td></tr>
<tr><td class="labela">Ime:</td><td class="unos"><input type="text" name="ime" size="10" maxlength="20" value="<?phpecho $ime; ?>"></td></tr>
<tr><td class="labela">Prezime:</td><td class="unos"><input type="text" name="prezime" size="10" maxlength="20" value="<?phpecho $prezime; ?>"></td></tr>
<tr><td class="labela">Lozinka:</td><td class="unos"><input type="text" name="lozinka" size="6" maxlength="15" value="<?phpecho $lozinka; ?>"></td></tr>
<tr><td class="labela">E-mail:</td><td class="unos"><input type="text" name="email" size="20" maxlength="30" value="<?phpecho $email; ?>"></td></tr>
<tr><td class="labela">URL:</td><td class="unos"><input type="text" name="url" size="20" maxlength="40" value=""></td></tr>
<tr><td class="labela">Tel:</td><td class="unos"><input type="text" name="tel" size="10" maxlength="20" value=""></td></tr>
<tr><td class="labela">Fax:</td><td class="unos"><input type="text" name="fax" size="10" maxlength="20" value=""></td></tr>
<tr><td class="labela">Moj prog. jezik:</td><td class="unos">
<select name="ompjezik">
<option value="-1">Odaberi prog. jezik</option>
<option value="1" <?phpif($prog_jezik == 1) echo "selected"; ?>>PHP</option>
<option value="2" <?phpif($prog_jezik == 2) echo "selected"; ?>>Java</option>
<option value="3" <?phpif($prog_jezik == 3) echo "selected"; ?>>ASP</option>
<option value="4" <?phpif($prog_jezik == 4) echo "selected"; ?>>C/C++</option>
<option value="5" <?phpif($prog_jezik == 5) echo "selected"; ?>>C#</option>
<option value="6" <?phpif($prog_jezik == 6) echo "selected"; ?>>Visual Basic</option>
<option value="7" <?phpif($prog_jezik == 7) echo "selected"; ?>>JSP</option>
<option value="8" <?phpif($prog_jezik == 8) echo "selected"; ?>>Fortran</option>
<option value="9" <?phpif($prog_jezik == 9) echo "selected"; ?>>COBOL</option>
<option value="10" <?phpif($prog_jezik == 10) echo "selected"; ?>>Smalltalk</option>
</select>
</td></tr>
<tr><td class="labela">Godine s PJ:</td><td class="unos">
<table>
<tr><td><input type="radio" name="godpjezik" value="1"  <?phpif($prog_godina == 1) echo "checked"; ?>>1 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="2"  <?phpif($prog_godina == 2) echo "checked"; ?>>2 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="3"  <?phpif($prog_godina == 3) echo "checked"; ?>>3 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="4"  <?phpif($prog_godina == 4) echo "checked"; ?>>4-5 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="5"  <?phpif($prog_godina == 5) echo "checked"; ?>>6-8 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="6"  <?phpif($prog_godina == 6) echo "checked"; ?>>9-10 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="7"  <?phpif($prog_godina == 7) echo "checked"; ?>>11 > godina</input></td></tr>
</table>
</td></tr>
<tr><td class="labela">Poznaje PJ:</td><td class="unos">
<table>
<tr><td><input type="checkbox" name="pozpjezik1" value="1"  <?phpif($pj1 == 1) echo "checked"; ?>>PHP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik2" value="2"  <?phpif($pj2 == 1) echo "checked"; ?>>Java</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik3" value="3"  <?phpif($pj3 == 1) echo "checked"; ?>>ASP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik4" value="4"  <?phpif($pj4 == 1) echo "checked"; ?>>C/C++</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik5" value="5"  <?phpif($pj5 == 1) echo "checked"; ?>>C#</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik6" value="6"  <?phpif($pj6 == 1) echo "checked"; ?>>Visual Basic</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik7" value="7"  <?phpif($pj7 == 1) echo "checked"; ?>>JSP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik8" value="8"  <?phpif($pj8 == 1) echo "checked"; ?>>Fortran</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik9" value="9"  <?phpif($pj9 == 1) echo "checked"; ?>>COBOL</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik10" value="10"  <?phpif($pj10 == 1) echo "checked"; ?>>Smalltalk</input></td></tr>
</table>
</td></tr>
<tr><td class="labela">Iskustva:</td><td class="unos">
  <textarea name="iskustvo" rows="4" columns="50" cols="20"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value=" Pošalji "></td></tr>
</table>
</form>
</center>

<?php
include("footer.php");
?>
