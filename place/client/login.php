<?php
include "functions.php";

if(isset($_POST["submit"])){

    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $catalog = $_POST["catalog"];

    if(!($login=="") && !($pass == "") && !($catalog == "")){
        if($result = login($login,$pass,$catalog))
        {echo $result;}
        else
        {echo "Błędne dane logowania!"; }
    }
    else {echo "Uzupełnij wszystkie pola!";
    }
}else{return false;}