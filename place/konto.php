<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(0,0,1);
?>
<?php 
function contentForm($v_login='', $v_error='')
{ ?>
	<?php if($v_error != "")
	{echo "<p class='error'>".$v_error."</p>";
	echo "<a href='main.php'>Powrót</a>";
	exit;} ?>

	<form action="#" method="post">
		<label for="login">Login:</label>
		<input type="text" name="login" value="<?php $v_login ?>" /><br>
		<label for="pass">Hasło:</label>
		<input type="password" name="pass" value="" /><br>
		<label for="cpass">Potwierdź hasło:</label>
		<input type="password" name="cpass" value="" /><br>
		<label for="catalog">Katalog:</label>
		<input type="hidden" name="submit" value="1" />
		<input type="submit" value="Dodaj" />
	</form>
</form>
<?php
}
 ?>
<?php
if(isset($_POST['submit'])){
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$rights = 1;
	
	if($login =="" || $pass == "" || $cpass == ""){
		$error = "Uzupełnij wszystkie pola.";
		contentForm($login, $error);
		exit;
	}
	if($pass != $cpass){
		$error = "Niepoprawnie podane hasło.";
		contentForm($login, $error);
		exit;
	}
	
	$dane = array($login,md5($pass),$rights);
	if(createAccount($dane)){
		echo "Dodano użytkownika ".$login." do bazy!";
		header("Refresh:2; main.php");
	}else{
		$error = "Wystąpił nieoczekiwany problem.";
		contentForm($login, $error);
		exit;
	}		
}else{
	contentForm();
}
?>

<?php include 'includes/overall/footer.php'; ?>