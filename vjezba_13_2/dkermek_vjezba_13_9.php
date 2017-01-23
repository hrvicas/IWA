<?php
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
	if(tekst == upisano) {
		alert("Veæ postoji: " + tekst)
		obrazac.ime.focus()
		return false;
	}
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

<p><a href="dkermek_vjezba_13_4.php">Lista svih korisnika</a><br>
<center>
<form name="vjezba8" method="post" action="dkermek_vjezba_13_a.php" onsubmit="return kontrolaUnosa(this)">
<table class="formular">
<tr><td class="labela">Korisnièko ime:</td><td class="unos"><input type="text" name="korisnik" size="10" maxlength="20"></td></tr>
<tr><td class="labela">Ime:</td><td class="unos"><input type="text" name="ime" size="10" maxlength="20"></td></tr>
<tr><td class="labela">Prezime:</td><td class="unos"><input type="text" name="prezime" size="10" maxlength="20"></td></tr>
<tr><td class="labela">Lozinka:</td><td class="unos"><input type="text" name="lozinka" size="6" maxlength="15"></td></tr>
<tr><td class="labela">E-mail:</td><td class="unos"><input type="text" name="email" size="20" maxlength="30"></td></tr>
<tr><td class="labela">URL:</td><td class="unos"><input type="text" name="url" size="20" maxlength="40"></td></tr>
<tr><td class="labela">Tel:</td><td class="unos"><input type="text" name="tel" size="10" maxlength="20"></td></tr>
<tr><td class="labela">Fax:</td><td class="unos"><input type="text" name="fax" size="10" maxlength="20"></td></tr>
<tr><td class="labela">Moj prog. jezik:</td><td class="unos">
<select name="ompjezik">
<option value="-1">Odaberi prog. jezik</option>
<option value="1">PHP</option>
<option value="2">Java</option>
<option value="3">ASP</option>
<option value="4">C/C++</option>
<option value="5">C#</option>
<option value="6">Visual Basic</option>
<option value="7">JSP</option>
<option value="8">Fortran</option>
<option value="9">COBOL</option>
<option value="10">Smalltalk</option>
</select>
</td></tr>
<tr><td class="labela">Godine s PJ:</td><td class="unos">
<table>
<tr><td><input type="radio" name="godpjezik" value="1">1 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="2">2 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="3">3 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="4">4-5 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="5">6-8 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="6">9-10 godina</input></td></tr>
<tr><td><input type="radio" name="godpjezik" value="7">11 > godina</input></td></tr>
</table>
</td></tr>
<tr><td class="labela">Poznaje PJ:</td><td class="unos">
<table>
<tr><td><input type="checkbox" name="pozpjezik1" value="1">PHP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik2" value="2">Java</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik3" value="3">ASP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik4" value="4">C/C++</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik5" value="5">C#</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik6" value="6">Visual Basic</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik7" value="7">JSP</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik8" value="8">Fortran</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik9" value="9">COBOL</input></td></tr>
<tr><td><input type="checkbox" name="pozpjezik10" value="10">Smalltalk</input></td></tr>
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