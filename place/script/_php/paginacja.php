<?php
include "../../core/init.php";
protectPage(0,1,0);
?>

<?php
if(isset($_POST['strona']))
{
$pokazStrone = $_POST['strona'];
$iloscNaStrone = 8;


$qr = "SELECT id, imie, nazwisko, kwota, data, uwagi, dodal FROM dane WHERE katalog=".$s_catalog;
$data = sqlDataManager::retQuery($qr);

$start = ($pokazStrone-1) * $iloscNaStrone;
$end = $start + $iloscNaStrone-1;
$index = $start;

for($start; $start<=$end; $start++)
{
	if(isset($data[$start])){
	$index++;
	echo "<tr>";
	echo "<td id='index'>" . $index . "</td>";
	echo "<td id='imie' class='val'>" . $data[$start][1] . "</td>";
	echo "<td id='nazwisko' class='val'>" . $data[$start][2] . "</td>";
	echo "<td id='kwota' class='val'>" . $data[$start][3]." zł" . "</td>";
	echo "<td id='data'>" . date("d.m.y", strtotime($data[$start][4])) . "</td>";
	echo "<td id='uwagi' class='val'>" . $data[$start][5] . "</td>";
	echo "<td id='dodal'>" . $data[$start][6] . "</td>";
	echo "<td><a href='#prompt' id='delete' class='btn btn-warning btn-xs delete' data-id='".$data[$start][0]."'>Usuń</a></td>";
	echo "</tr>";	
	}else{
		break;}
}
}
?>