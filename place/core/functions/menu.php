<?php
function mainMenu($rights)
{
	switch($rights){
		case 1:
			echo '<a href="preview.php">Przeglądaj liste plac</a><br>';
			echo '<a href="edit.php">Dokonaj edycji lub usunięcia zawartości<a><br>';
			echo '<a href="add.php">Dodaj osobe do zawartości<a><br><br/>';
			echo '<a href="unlog.php">Wyloguj mnie</a>';
		break;
		
		case 2:
			echo '<a href="konto.php">Dodaj nowe konto dostępowe</a><br><br/>';
			echo '<a href="unlog.php">Wyloguj mnie</a>';
		break;
		
		case 0:
			echo '<a href="preview.php">Przeglądaj liste plac</a><br><br/>';
			echo '<a href="unlog.php">Wyloguj mnie</a>';
		break;
		
		default:
			header("Location: index.php");
		break;
	}
}