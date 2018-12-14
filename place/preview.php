<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(1,1,0);
?>
<?php
function contentPreview($v_records='', $v_dataAdm='', $v_rights='', $v_error='')
{
	if($v_error != "")
	{echo "<p class='error'>".$v_error."</p>";
	echo "<a href='main.php'>Powrót</a>";
	exit;}
	
	$index=0;
	echo "<table border='1' cellpadding='10'>";
		echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Kwota</th><th>Data</th><th>Uwagi</th><th>Dodał</th></tr>";
		foreach($v_records as $key => $value){

			$index += 1;
			"<tr>";
			echo "<td>" . $index . "</td>";
			echo "<td>" . $value[0] . "</td>";
			echo "<td>" . $value[1] . "</td>";
			echo "<td>" . $value[2]." zł" . "</td>";
			echo "<td>" . $value[3] . "</td>";
			echo "<td>" . $value[4] . "</td>";
			echo "<td>" . $value[5] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		if($v_rights==1)
		{
			if(count($v_records) != 0){
				echo "<h1>Statystyki</h1>";
				echo "Aktualny stan budżetu: ".$v_dataAdm[0]."zł. <br>";
				echo "Ilość osob które zapłaciły: ".$v_dataAdm[1]."<br>";
				echo "Ostatnio dodano: ".$v_dataAdm[2]."<br>";
			}else{
				echo "Brak rekordów - brak statystyk";
			}
		}
		echo "<a href='main.php'>Powrót</a>";
}
?>

<?php
$qr = "SELECT imie, nazwisko, kwota, data, uwagi, dodal FROM dane WHERE katalog=".$s_catalog;
$data = sqlDataManager::retQuery($qr);

$dataAdm = '';

if($s_rights == 1){
	$qr = "SELECT sum(kwota), count(imie), max(data) FROM dane WHERE katalog=".$s_catalog;
	$dataAdm = sqlDataManager::retQuery($qr);
	$dataAdm = $dataAdm[0];
}



if(!$data || !$dataAdm && $dataAdm !='')
{
	$error = "Problem z odczytem danych.";
	contentPreview("", "", $s_rights, $error);
}
contentPreview($data, $dataAdm, $s_rights);
?>

<?php include 'includes/overall/footer.php'; ?>