<?php
session_start();
include("header.php");
?>

<p>
<center>
  <table border="1" cellpadding="2" cellspacing="2" width="720">
    <tr>
      <td align="center"><strong>Naziv</strong></td>
      <td align="center"><strong>Opis</strong></td>
    </tr>
    <tr>
      <td>autentikacija.php</td>
      <td>Autentikacija korisnika - provjera postoji li korisnik s lozinkom bazi
        podataka</td>
    </tr>
    <tr>
      <td>autorizacija.php</td>
      <td>Autorizacija korisnika - provjera smije li korisnik obaviti operaciju
        tj. izvršiti skriptu</td>
    </tr>
    <tr>
      <td>conf</td>
      <td>Direktorij za datoteke konfiguracije</td>
    </tr>
    <tr>
      <td>conf\config.txt</td>
      <td>Datoteka konfiguracije - poslužitelj baze podataka, baza podataka,
        korisnik i lozinka za bazu podataka</td>
    </tr>
    <tr>
      <td>config.php</td>
      <td>Datoteka s funkcijama za otvaranje baze podataka prema konfiguraciji</td>
    </tr>
    <tr>
      <td>dkermek_aplikacija.php</td>
      <td>Osnovna aplikacija</td>
    </tr>
    <tr>
      <td>dkermek_login.php</td>
      <td>Kontrola prijavljivanja korisnika - poziva se iz index.html</td>
    </tr>
    <tr>
      <td>
    <tr>
      <td>dkermek_vjezba_13_0.php</td>
      <td>Ova datoteka - opis skripata</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_1.php</td>
      <td>Skripta za javne (nisu se prijavili) i ostale korisnike</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_2.php</td>
      <td>Skripta za prijavljene korisnike - obiène</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_3.php</td>
      <td>Skripta za prijavljene korisnike - administratore</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_4.php</td>
      <td>Skripta za listu korisnika - javni korisnik vidi samo popis, prijavljeni
        mogu izabrati sebe i promijeniti podatke, a administratori mogu mijenjati
        svima podatke i pridruživati ih grupama</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_5.php</td>
      <td>Skripta za promjenu podataka korisnika - prijavljeni korisnik može
        promijeniti vlastite podatke, a administratori mogu mijenjati svima podatke</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_6.php</td>
      <td>Skripta za upis promjene podataka korisnika - poziva se iz dkermek_vjezba_13_5.php</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_7.php</td>
      <td>Skripta za promjenu grupe korisnika - samo administratori</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_8.php</td>
      <td>Skripta za upis promjene grupe korisnika - samo administratori - poziva
        se iz dkermek_vjezba_13_7.php</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_9.php</td>
      <td>Skripta za unos podataka novog korisnika</td>
    </tr>
    <tr>
      <td>dkermek_vjezba_13_a.php</td>
      <td>Skripta za upis podataka novog korisnika - poziva se iz dkermek_vjezba_13_9.php</td>
    </tr>
    <tr>
      <td>error.php</td>
      <td>Skripta za ispis pogreške</td>
    </tr>
    <tr>
      <td>footer.php</td>
      <td>Skripta za podnožje</td>
    </tr>
    <tr>
      <td>header.php</td>
      <td>Skripta za zaglavlje</td>
    </tr>
    <tr>
      <td>images</td>
      <td>Direktorij za slike</td>
    </tr>
    <tr>
      <td>images\PzaWeb.jpg</td>
      <td>Slika za zaglavlje</td>
    </tr>
    <tr>
      <td>index.php</td>
      <td>Poèetna skripta - upis podataka za prijavu korisnika (korisnièko ime
        i lozinka) </td>
    </tr>
    <tr>
      <td>logout.php</td>
      <td>Skripta za odjavljivanje korisnika</td>
    </tr>
    <tr>
      <td>vjezba_13.css</td>
      <td>Datoteka za css upute</td>
    </tr>
  </table>
</center>
<?php
include("footer.php");
?>
