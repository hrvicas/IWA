<?php

function putanja()  {
    global $HTTP_SERVER_VARS;
    $file = $HTTP_SERVER_VARS["SCRIPT_FILENAME"];
    $end = strrpos($file, "/");
    $dir = substr($file, 0, $end + 1);

    return $dir;
}

function conf()  {
    $dir = putanja() . "conf/";

    return $dir;
}

function init($datIme) {

    $ldat = conf() . $datIme;
    
    $podaci = file ($ldat) or prekid("Problem kod inicijalizacije: $! ! \n");

    $j = 0;
    
    foreach ($podaci as $i) {
        $i = preg_replace("/\n/", "", $i);
        $i = preg_replace("/\r/", "", $i);
        $i = preg_replace("/cM/", "", $i);
        $podaci[$j] = $i;
        $j++;
    }

    return $podaci;
}

function initDB() {

    $dat = "iwa_config.txt";

    list ($server, $baza, $korisnik, $lozinka) = init($dat);

    $dbc = mysql_connect($server, $korisnik, $lozinka) or die(mysql_error());
        //prekid("Problem kod povezivanja na posluzitelja baze podataka. " . mysql_error());

    $dbh = mysql_select_db($baza, $dbc) or die(mysql_error());
       // prekid("Problem kod povezivanja na bazu podataka"); 

    return $dbh;
}

function prekid($msg) {
        print "Pogreška u radu!\n";
        print $msg;
        exit;
}

?>
