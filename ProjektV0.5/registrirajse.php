<?php
session_start();

include_once("header.php");
include ("config.php");
?>

<center>
<h3>AKO NISTE PRIJAVLJENI MOLIM OBAVEZNO ISPUNITE KONTAKT FORMU KAKO BISTE MOGLI IZVRŠITI REGISTRACIJU!</br>
		HVALA.

<script type="text/javascript">
	function provjeraUnosa ()
	{
	var a=document.forms["regakorisnika"]["korisnik"].value;
	var b=document.forms["regakorisnika"]["ime"].value;
	var c=document.forms["regakorisnika"]["prezime"].value;
	var d=document.forms["regakorisnika"]["lozinka"].value;
	var e=document.forms["regakorisnika"]["email"].value;
	if (a==null || a=="", b==null || b=="", c==null || c=="", d==null || d=="" ) 
	{
		alert("Sva polja su obavezna");
		return false;
	}
}
</script>

		<form onsubmit="return provjeraUnosa()" name="regakorisnika" method="post" action="regausera.php">
			<table class="statistika" border="2">
				<p>Sva polja su obavezna!</p></br>
				<tr>
					<td width="50%">Korisničko ime:</td>
					<td><input type="text" name="korisnik" size="50%" id="a"></td>
				</tr>
				<tr>
					<td>Ime korisnika:</td>
					<td><input type="text" name="ime" size="50%" id="b"></td>
				</tr>
				<tr>
					<td>Prezime korisnika:</td>
					<td><input type="text" name="prezime" size="50%" id="c"></td>
				</tr>
				<tr>
					<td>Lozinka korisnika:</td>
					<td><input type="password" name="lozinka" size="50%" id="d"></td>
				</tr>
				<tr>
					<td>Email adresa korisnika:</td>
					<td><input type="text" name="email" size="50%" id="e"><input type="hidden" name="vrsta" value="1"></td>
				</tr>
				
			</table>
			<input method="post" name="submit" type="submit" value="Pošalji">
			<input type="reset" name="reset" value="Obriši">
		</form>

		<h4>Nakon izvršene registracije kliknite na link za početnu stranicu</h4>
	</center>

<?php
include ("footer.php");
?>
