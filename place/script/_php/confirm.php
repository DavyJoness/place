<?php
include "../../core/init.php";
protectPage(0,1,0);
?>

<?php
if(isset($_POST['edytuj']))
{
	$id = $_POST['edytuj'];
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$kwota = $_POST['kwota'];
	$uwagi = $_POST['uwagi'];
	$katalog = $s_catalog;
	$przezKogo = $s_login;
	
	$set = array("imie" => $imie, "nazwisko" => $nazwisko, "kwota" => $kwota, "uwagi" => $uwagi, "dodal" => $przezKogo);
	$where = array("id" => $id, "katalog" => $katalog);

	if(modyfikujDane("dane", $set, $where, "AND"))
	{
		echo true;
	}else{
		echo false;
	}
}

elseif(isset($_POST['delete']))
{
	$id = $_POST['delete'];
	$katalog = $s_catalog;
	if(usun($id, $katalog))
	{
		echo true;
	}else {
		echo false;
	}
}

elseif(isset($_POST["dodano"])){
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$kwota = $_POST['kwota'];
	$uwagi = $_POST['uwagi'];
	$katalog = $s_catalog;
	$przezKogo = $s_login;
	$dane = array($katalog, $imie, $nazwisko, $kwota, $uwagi, $przezKogo);
	
	if(dodaj($dane)){ 
		$idIdata = dajId($imie, $nazwisko, $przezKogo);
		echo "<tr>";
		echo "<td id='index'></td>";
		echo "<td id='imie' class='val'>" . $imie . "</td>";
		echo "<td id='nazwisko' class='val'>" . $nazwisko . "</td>";
		echo "<td id='kwota' class='val'>" . $kwota ." zł" . "</td>";
		echo "<td id='data'>". date("d.m.y", strtotime($idIdata[1])) ."</td>";
		echo "<td id='uwagi' class='val'>" . $uwagi . "</td>";
		echo "<td id='dodal'>" . $przezKogo . "</td>";
		echo "<td><a href='#prompt' id='delete' class='btn btn-warning btn-xs delete' data-id='" . $idIdata[0] . "'>Usuń</a></td>";
		echo "</tr>";
	}else {
		echo false;
	}
}
?>