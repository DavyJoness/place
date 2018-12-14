<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(0,1,0);
?>
<?php
function contentPreview($v_records='', $v_dataAdm='', $v_rights='', $v_catalog='', $v_error='')
{?>
	<div id="table-title"><h1 id='katalog'>Tabela: <?php echo nazwaKatalogu($v_catalog); ?></h1></div>
	</header>
    <script src="script/content.admin.jquery.js"></script>
	<div id="container" class="container" style="top:70px;">
        <div id="paginacja">
        	<span id="page">Strona: </span>
            <?php iloscStron($v_records); ?>
        </div>
    <?php
	if($v_error != "")
	{echo "<p class='error'>".$v_error."</p>";
	echo "<a href='main.php'>Powrót</a>";
	exit;}
	
	$index=0;
	echo "<table class='table table-hover'>";
		echo "<tr id='table-header'><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Kwota</th><th>Data</th><th>Uwagi</th><th>Dodał</th></tr>";
		for($i=0; $i<8; $i++){

			$index += 1;
			echo "<tr>";
			echo "<td id='index'>" . $index . "</td>";
			echo "<td id='imie' class='val'>" . $v_records[$i][1] . "</td>";
			echo "<td id='nazwisko' class='val'>" . $v_records[$i][2] . "</td>";
			echo "<td id='kwota' class='val'>" . $v_records[$i][3]." zł" . "</td>";
			echo "<td id='data'>" . date("d.m.y", strtotime($v_records[$i][4])) . "</td>";
			echo "<td id='uwagi' class='val'>" . $v_records[$i][5] . "</td>";
			echo "<td id='dodal'>" . $v_records[$i][6] . "</td>";
			echo "<td><a href='#prompt' id='delete' class='btn btn-warning btn-xs delete' data-id='" . $v_records[$i][0] . "'>Usuń</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		
		if($v_rights==1)
		{
			if(count($v_records) != 0){
				echo "<div id='stats'>";
					echo "<h1>Statystyki</h1>";
					echo "Aktualny stan budżetu: ".$v_dataAdm[0]."zł. <br>";
					echo "Ilość osob które zapłaciły: ".$v_dataAdm[1]."<br>";
					echo "Ostatnio dodano: ".$v_dataAdm[2]."<br>";
				echo "</div>";
			}else{
				echo "Brak rekordów - brak statystyk";
			}
		}
		
		include "includes/widgets/menu.php";
		?>
        
        </div>
        <?php
}
?>

<?php
$qr = "SELECT id, imie, nazwisko, kwota, data, uwagi, dodal FROM dane WHERE katalog=".$s_catalog;
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
	contentPreview("", "", $s_rights, "", $error);
}
contentPreview($data, $dataAdm, $s_rights, $s_catalog);
?>

<?php include 'includes/overall/footer.php'; ?>