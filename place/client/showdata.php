<?php
session_start();
include "functions.php";


    $catalog = '1';
    $mysqli = connect();
    $j=0;

    if($stat = $mysqli -> prepare("SELECT imie, nazwisko, kwota, data, uwagi, dodal FROM dane WHERE katalog=?")){
        $stat -> bind_param("s", $catalog);
        $stat -> execute();
        $stat -> bind_result($dbImie, $dbNazwisko, $dbKwota, $dbData, $dbUwagi, $dbDodal);
        while($stat -> fetch()){
            $imie[$j]=$dbImie;
            $nazwisko[$j]=$dbNazwisko;
            $kwota[$j]=$dbKwota;
            $data[$j]=$dbData;
            $uwagi[$j]=$dbUwagi;
            $dodal[$j]=$dbDodal;
            $j++;
        }
        echo "<?xml version='1.0' standalone='yes'?>\n";
        echo "<NewDataSet>\n";
        for($i=0; $i < $j; $i++){

            $index = $i+1;
            echo "<Osoba>\n";
            echo "<ID>" . $index . "</ID>\n";
            echo "<Imie>" . $imie[$i] . "</Imie>\n";
            echo "<Nazwisko>" . $nazwisko[$i] . "</Nazwisko>\n";
            echo "<Kwota>" . $kwota[$i]." zł" . "</Kwota>\n";
            echo "<Data>" . $data[$i] . "</Data>\n";
            echo "<Uwagi>" . $uwagi[$i] . "</Uwagi>\n";
            echo "<Dodal>" . $dodal[$i] . "</Dodal>\n";
            echo "</Osoba>\n";
        }
        echo "</NewDataSet>\n";
        $stat ->close();
    }else{echo "Brak rekordów";}

