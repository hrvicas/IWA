<?php
session_start();
unset($_SESSION["vrsta"]);
session_destroy();
header("Location:index.php");
?>