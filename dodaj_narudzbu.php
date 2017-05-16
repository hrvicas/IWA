<?php
include('autorizacija.php');
session_start();
foreach ($_POST as $key => $value){
   echo $key.'='.$value.'<br />';

/*
foreach ($_POST as $key => $value){
   //echo $key.'='.$value.'<br />';
  if ($value == "" || $value == null) {
  goto end;
 }
*/
}
      $uspjeh = true;
      global $con;

      $dbh= initDB ();
      if (mysqli_connect_error()) {
        echo "Neuspješno spajanje na poslužitelj. Connect error:" . mysqli_error($dbh);
      }

      $sql = "SELECT max(narudzbenica) FROM narudzbenica";
      $reza = mysqli_query($con,$sql) or die ("Greška:" . mysqli_error($con));
      while ($row = mysqli_fetch_array($reza)) {
      $id_nar = $row['0']; 
      $id_narudz = $id_nar +1;
      }
      echo "Broj vaše narudžbe je : " . $id_narudz;

      $sql = "insert into narudzbenica (`narudzbenica`, `korisnik`, `status`, `naruceno`) select max(`narudzbenica`) + 1, '" . $_SESSION['iwa_korisnik'] . "',2, CURDATE() from narudzbenica;";
      $result= mysqli_query($con, $sql);
      if (mysqli_error($con)) {
        $uspjeh = false;
        echo mysqli_error($con);
      }
      
      $brojac = $_POST['brojac'];
      for ($i = 1; $i <= $brojac; $i++) {
        $kolicina = $_POST['kolicina' . $i];
        if ($kolicina == 0 || $kolicina == null) {
          continue;
        }
        $sql = "insert into stavka (`narudzbenica`,`stavka`,`roba`,`kolicina`) select max(`narudzbenica`), '" . $i . "'," . $_POST['id' . $i] . ", " . $kolicina . " from narudzbenica;";
        $result= mysqli_query($con, $sql);
        if (mysqli_error($con)) {
          $uspjeh = false;
          echo mysqli_error($con);
        }

        $result1 = mysqli_query($con, "SELECT roba.kolicina FROM roba where roba.roba = " . $_POST['id' . $i] . ";");
        if (mysqli_error($con)) {
          echo "Neuspješan upit, pokušajte ponovo." . mysqli_error($con);
        }

        while ( $row= mysqli_fetch_array($result1)) {
          if ($row['kolicina'] > $kolicina) {
            $sql = "update roba set `kolicina` = `kolicina` - " . $kolicina . " where roba = " . $_POST['id' . $i] . ";";
            $result= mysqli_query($con, $sql);
            if (mysqli_error($con)) {
            $uspjeh = false;
            echo mysqli_error($con);
            }

          } 

          else {
              $result2= mysqli_query($con, "SELECT max(narudzbenica) as indeks FROM narudzbenica");
              if (mysqli_error($con)) {
              echo "Neuspješan upit, pokušajte ponovo." . mysqli_error($con);
            }

            while ( $row_narud= mysqli_fetch_array($result2)) {
              $sql = "update narudzbenica set `status` = 0 where narudzbenica = " . $row_narud['indeks'] . ";";
              $result = mysqli_query($con, $sql);
              if (mysqli_error($con)) {
              $uspjeh = false;
              echo mysqli_error($con);
              }
            }
            $sql = "update roba set `kolicina` = 0 where roba = " . $_POST['id' . $i] . ";";
            $result= mysqli_query($con, $sql);
            if (mysqli_error($con)) {
              $uspjeh = false;
              echo mysqli_error($con);
            }
          }
        }

      }

      ?>
      <?php
        if ($uspjeh):
      ?>
      <h2>Narudžba dodana u bazu!</h2>
      <a href="./naruci.php?run=dodaj_narudzbu">Povratak</a>
      <?php
        else:
          end:
      ?>
      <h2>Došlo je do greške! Narudžba nije dodana u bazu!</h2>
      <a href="./naruci.php?run=dodaj_narudzbu">Povratak</a>
      <?php
        endif;
      ?>
