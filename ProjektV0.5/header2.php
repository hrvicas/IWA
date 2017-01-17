<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin stranice</title>
<link href="css_oznake.css" rel="stylesheet" type="text/css">
</head>
<body>
<center>
<div id="header2">
Nalazite se na admin stranici projektnog zadatka iz kolegija Izgradnja web aplikacija.<br>
Pristup ima samo admin!<br>
<br>
Admin:
<?php
echo $_SESSION["ime_prezime"];
?>

</div>
</center>

<hr>
</body>
</html>