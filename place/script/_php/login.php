<?php
include "../../core/init.php";

if(isset($_POST['submit']))
{
	$login = $_POST['login'];
	$password = $_POST['pass'];
	$catalog = $_POST['catalog'];
	
	if($login=='' || $password=='' || $catalog=='')
	{
		echo "Podaj wszystkie dane logowania.";
		exit();
	}
	$result = login($login, $password, $catalog);
	if($result === true)
	{
		$_SESSION['logged'] = null;
		echo $result;
	}else{
		echo $result;
	}
}
?>