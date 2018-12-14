<?php include "functions.php";
session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="System bazy danych płac za eventy" />
<title>Dodaj Nowe Konto</title>
</head>

<body>
<?php if(isset($_SESSION['login']) && $_SESSION['rights']=="mod"){
		if(isset($_POST['submit'])){
			$login = $_POST['login'];
			$pass = $_POST['pass'];
			$cpass = $_POST['cpass'];
			$catalog = $_POST['catalog'];
			$rights = $_POST['rights'];
			if($login !="" && $pass != "" && $cpass != "" && $catalog != "" && $rights != ""){
				if($pass == $cpass){
				if(createAccount($login,$pass,$catalog,$rights)){
					echo "Dodano użytkownika ".$login." do bazy!";
					header("Refresh:2; main.php");
				}else
				{
					header("Refresh:2; create.php");
				}
					
				}
				else {
					echo "Wpisz jeszcze raz hasło";
				?>
				<form action="#" method="post">
					<label for="login">Login:</label>
					<input type="text" name="login" value="<?php $login ?>" /><br>
					<label for="pass">Hasło:</label>
					<input type="password" name="pass" value="" /><br>
					<label for="cpass">Potwierdź hasło:</label>
					<input type="password" name="cpass" value="" /><br>
					<label for="catalog">Katalog:</label>
					<input type="text" name="catalog" value="" /><br>
					<label for="rights">Uprawnienia:</label>
					<select name="rights">
						<option value="user">Użytkownik</option>
						<option value="admin">Administrator</option>
						<option value="mod">Moderator</option>
					</select><br>
					<input type="hidden" name="submit" value="1" />
					<input type="submit" value="Dodaj" />
				</form>
				<?php
				echo "<a href='main.php'>Powrót</a>";
				}
			}
			else
			{
				echo "Niepoprawnde dane:";
				?>
				<form action="#" method="post">
					<label for="login">Login:</label>
					<input type="text" name="login" value="<?php $login ?>" /><br>
					<label for="pass">Hasło:</label>
					<input type="password" name="pass" value="" /><br>
					<label for="cpass">Potwierdź hasło:</label>
					<input type="password" name="cpass" value="" /><br>
					<label for="catalog">Katalog:</label>
					<input type="text" name="catalog" value="" /><br>
					<label for="rights">Uprawnienia:</label>
					<select name="rights">
						<option value="user">Użytkownik</option>
						<option value="admin">Administrator</option>
						<option value="mod">Moderator</option>
					</select><br>
					<input type="hidden" name="submit" value="1" />
					<input type="submit" value="Dodaj" />
				</form>
				<?php	
				echo "<a href='main.php'>Powrót</a>";
			}
		}
		else {	
	echo "Dodaj nowe konto:";
?>
<form action="#" method="post">
	<label for="login">Login:</label>
	<input type="text" name="login" value="" /><br>
	<label for="pass">Hasło:</label>
	<input type="password" name="pass" value="" /><br>
	<label for="cpass">Potwierdź hasło:</label>
	<input type="password" name="cpass" value="" /><br>
	<label for="catalog">Katalog:</label>
	<input type="text" name="catalog" value="" /><br>
	<label for="rights">Uprawnienia:</label>
	<select name="rights">
		<option value="user">Użytkownik</option>
		<option value="admin">Administrator</option>
		<option value="mod">Moderator</option>
	</select><br>
	<input type="hidden" name="submit" value="1" />
	<input type="submit" value="Dodaj" />
</form>
<?php	
echo "<a href='main.php'>Powrót</a>";
		}
		
}
else {header("Location: index.php");} ?>
</body>
</html>