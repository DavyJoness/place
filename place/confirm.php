<?php
include "core/init.php";
include 'includes/overall/header.php';
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
		echo "Poprawnie dokonano edycji wpisu!";
		header("Refresh:2; edit.php");
	}else{
		echo "Operacja zakończona niepowodzeniem.";
	}
}
elseif(isset($_POST['delete']))
{
	$id = $_POST['delete'];
	$katalog = $s_catalog;
	if(usun($id, $katalog))
	{
		echo "Poprawnie usunięto wpis z bazy!";
		header("Refresh:2; edit.php");
	}else {
		echo "Operacja zakończona niepowodzeniem.";
	}
}
 ?>
	
<?php include 'includes/overall/footer.php'; ?>