<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(0,1,0);
?>

<?php 
function contentModify($v_records='', $v_error='')
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
			echo "<td>" . $value[1] . "</td>";
			echo "<td>" . $value[2] . "</td>";
			echo "<td>" . $value[3]." zł" . "</td>";
			echo "<td>" . $value[4] . "</td>";
			echo "<td>" . $value[5] . "</td>";
			echo "<td>" . $value[6] . "</td>";
			echo "<td><a href='edit.php?edt=" . $value[0] . "'>Edytuj</a></td>";
			echo "<td><a href='edit.php?del=" . $value[0] . "'>Usuń</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	echo "<a href='main.php'>Powrót</a>";
}

function contentEdit($v_record='', $v_id='', $v_error='')
{
	if($v_error != "")
	{echo "<p class='error'>".$v_error."</p>";
	echo "<a href='main.php'>Powrót</a>";
	exit;}
	
	echo "Edytujesz rekord o ID=".$v_id;	
?> 
		<form action="confirm.php" method="post" >
			<label for="imie">Imię:</label>
			<input type="text" name="imie" value="<?php echo $v_record[0]; ?>" /></br>
			<label for="imie">Nazwisko:</label>
			<input type="text" name="nazwisko" value="<?php echo $v_record[1]; ?>"/></br>
			<label for="imie">Kwota:</label>
			<input type="text" name="kwota" value="<?php echo $v_record[2]; ?>"/></br>
			<label for="imie">Uwagi:</label>
			<input type="text" name="uwagi" value="<?php echo $v_record[3]; ?>"/></br>
			<input type="hidden" name="edytuj" value="<?php echo $v_id; ?>" />
			<input type="submit" value="Edytuj" />		
		</form>
<?php
}

function contentDelete($v_record='', $v_id='', $v_error='')
{
	if($v_error != "")
	{echo "<p class='error'>".$v_error."</p>";
	echo "<a href='main.php'>Powrót</a>";
	exit;}
	
	echo "Czy na pewno chcesz usunąć osobę:".$v_record[0]." ".$v_record[1];
		
?> 
	<form action="confirm.php" method="post" name="tak">
		<input type="hidden" name="delete" value="<?php echo $v_id; ?>" />
		<input type="submit" value="Tak" />			
	</form>
	<form action="edit.php" method="post" name="nie">
		<input type="submit" value="Nie" />			
	</form>
<?php
}

?>

<?php 
if(isset($_GET['edt']))
{
	$id = $_GET['edt'];
	$qr = "SELECT imie, nazwisko, kwota, uwagi FROM dane WHERE katalog=".$s_catalog." AND id=".$id;
	$data = sqlDataManager::retQuery($qr);
	
	if(!$data)
	{
		$error = "Problem z odczytem danych.";
		contentEdit("", "", $error);
	}
	$data = $data[0];
	contentEdit($data, $id);
}
elseif(isset($_GET['del']))
{
	$id = $_GET['del'];
	$qr = "SELECT imie, nazwisko FROM dane WHERE katalog=".$s_catalog." AND id=".$id;
	$data = sqlDataManager::retQuery($qr);
	
	if(!$data)
	{
		$error = "Problem z odczytem danych.";
		contentDelete("", "", $error);
	}
	$data = $data[0];
	contentDelete($data, $id);
}
else
{
$qr = "SELECT id, imie, nazwisko, kwota, data, uwagi, dodal FROM dane WHERE katalog=".$s_catalog;
$data = sqlDataManager::retQuery($qr);

if(!$data)
{
	$error = "Problem z odczytem danych.";
	contentModify("", $error);
}
contentModify($data);
}	
 ?>

<?php include 'includes/overall/footer.php'; ?>