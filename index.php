<?php
session_start();

include("header.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
<title>Index</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>	
<body>

<center>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<p>Upiši korisnika i odgovarajuću lozinku za pristup aplikaciji!</p>
	
		<table>
			<form action="login.php" method="POST">
			<tr> 
				<td>Korisnik:</td>
				&nbsp;
				&nbsp;
				<td><input type="text" size="12" name="p_user"></td>
			</tr>
			<tr>
				<td>Lozinka:</td>
				&nbsp;
				&nbsp;
				<td><input type="password" size="12" name="p_password"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="Logiranje"></td>
			</tr>
			</form>
		</table>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<a href="pregled_robe.php">LINK ZA PREGLED PONUDE</a>
</center>
<?php
include_once("footer.php");
?>
