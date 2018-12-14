<?php

function connect(){
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'system_plac';

    return $mysqli = new mysqli($server,$user,$pass,$db);
}

function login($login, $pass, $catalog){
    $passHash = md5($pass);

    $mysqli = connect();

    if($stat = $mysqli -> prepare("SELECT login, `password`, catalog, rights from user WHERE login=?")){
        $stat -> bind_param("s", $login);
        $stat -> execute();
        $stat -> bind_result($dbLogin, $dbPassword, $dbCatalog, $dbRights);
        $stat -> fetch();
    }

    if(isset($dbLogin))
    {
        if($login==$dbLogin && $passHash==$dbPassword){
            if($login==$dbLogin && $catalog==$dbCatalog)
            {
                $_SESSION['login'] = $login;
                $_SESSION['catalog'] = $catalog;
                $_SESSION['rights'] = $dbRights;
                return true;
            }
            else{ echo "Brak dostepu do katalogu ".$catalog."<br>";
                return false;}
        }
        else{echo "błędne hasło dla usera ".$login."<br>";
            return false;}
    }
    else{
        echo "Brak usera w bazie <br>";
        return false;
    }
}

function dodaj($katalog, $imie, $nazwisko, $kwota, $uwagi, $przezKogo){
    $mysqli = connect();

    if($stat = $mysqli -> prepare("INSERT dane (katalog, imie, nazwisko, kwota, uwagi, dodal) VALUES (?,?,?,?,?,?)")){
        $stat -> bind_param("ssssss",$katalog, $imie, $nazwisko, $kwota, $uwagi, $przezKogo);
        $stat -> execute();
    }
    else {echo "Błąd zapytania <br>"; return false;}
    $stat -> close();
    return true;
}

function usun($id, $catalog){
    $mysqli = connect();

    if($stat = $mysqli -> prepare("DELETE FROM dane WHERE id=? AND katalog=?")){
        $stat -> bind_param("ss",$id, $catalog);
        $stat -> execute();
    }
    else {echo "Błąd zapytania <br>"; return false;}
    $stat -> close();
    return true;

}

function createAccount($login,$pass,$catalog,$rights){
    $passHash = md5($pass);

    $mysqli = connect();

    if($stat = $mysqli -> prepare("INSERT user (login, password, catalog, rights) VALUES (?,?,?,?)")){
        $stat -> bind_param("ssss",$login, $passHash, $catalog, $rights);
        $stat -> execute();
    }
    else {echo "Błąd zapytania przy dodawaniu urzytkownika <br>"; return false;}
    $stat -> close();
    return true;

}

function katalogiSelect()
{
    $mysqli = connect();
    $i=0;

    if($stat = $mysqli -> prepare("SELECT DISTINCT catalog FROM user ORDER BY catalog"))
    {
        $stat -> execute();
        $stat -> bind_result($katalog);
        while($stat -> fetch())
        {
            $katalogi[$i] = $katalog;
            $i++;
        }
        $stat -> close();
    }
    echo "<select name='catalog'>";
    foreach($katalogi as $kat)
    {
        echo "<option value=".$kat.">".$kat."</option>";
        $i++;
    }
    echo "</select><br>";
}

	
	
	
	
	
	
	
	