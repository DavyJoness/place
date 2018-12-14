<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(0,1,0);
?>

<?php 
function contentForm()
{ ?>
	<form action="#" method="post" >
		<label for="imie">Imię:</label>
		<input type="text" name="imie" value="" autocomplete="off" autofocus required/><br>
		<label for="nazwisko">Nazwisko:</label>
		<input type="text" name="nazwisko" value="" autocomplete="off" /><br>
		<label for="kwota">Kwota:</label>
		<input type="text" name="kwota" value="" required/><br>
		<label for="uwagi">Uwagi:</label>
		<input type="text" name="uwagi" value="" autocomplete="off" /><br>
		<input type="hidden" name="dodano" value="1" />
		<input type="submit" value="Dodaj" /> 
	</form>
<?php }
?>

<?php 
if(isset($_POST["dodano"])){
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$kwota = $_POST['kwota'];
	$uwagi = $_POST['uwagi'];
	$katalog = $s_catalog;
	$przezKogo = $s_login;
	$dane = array($katalog, $imie, $nazwisko, $kwota, $uwagi, $przezKogo);
	
	if(dodaj($dane)){ 
		echo "Dodano do bazy danych. Co chcesz teraz zrobic: </br>";
		echo "<a href='add.php'>Dodaj kolejną osobę</a></br>";
		echo "<a href='main.php'>Powrót</a>";
	}else {
		echo "Nie dodano do bazy danych";
	}
}else{
	contentForm();
}
?>

<?php include 'includes/overall/footer.php'; ?>