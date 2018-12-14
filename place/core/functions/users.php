<?php 

function login($login, $pass, $catalog){

	$passHash = md5($pass);
	
	$qr = "SELECT * FROM user  WHERE login = '".$login."' AND pass = '".$passHash."'";
	$user = sqlDataManager::retQuery($qr);
	
	$countU = count($user);
	
	if($countU == 1)
	{
		$qr = "SELECT * FROM dost_do_katalog WHERE id_user = ".$user[0][0]." AND id_katalog = ".$catalog;
		$cat = sqlDataManager::retQuery($qr);
		$countC = count($cat);
		
		if($countC == 1){
		$_SESSION['logged'] = $user[0][0];
		$_SESSION['login'] = $user[0][1];
		$_SESSION['catalog'] = $cat[0][1];
		$_SESSION['rights'] = $user[0][3];
		return true;
		}else{
			return "Brak dostępu do zadanego katalogu.";
		}
	}else{
		$qr = "SELECT login from user WHERE login = '".$login."'";
		$statTwo = sqlDataManager::retQuery($qr);
		$count = count($statTwo);
		if($count > 0)
		{
			return "Niepoprawne hasło dla użytkownika ".$statTwo[0][0].".";
		}else{
			return "Brak użytkownika o podanej nazwie.";
		}
	}
	
}

function logged_in()
{
	if(isset($_SESSION['logged']))
		return true;
	else
		return false;
}

function protectPage($u, $a, $m)
{
	$id = $_SESSION['logged'];
	$prawo = $_SESSION['rights'];
	$kat = $_SESSION['catalog'];


	
	if(isset($id)){ //czy jestes zalogowany
		$qr = "SELECT * FROM user  WHERE id = '".$id."' AND rights = '".$prawo."'";
		$user = sqlDataManager::retQuery($qr);
		
		$qr = "SELECT * FROM dost_do_katalog WHERE id_user = ".$id." AND id_katalog = ".$kat;
		$katalog = sqlDataManager::retQuery($qr);
		if(count($user)==1 && count($katalog)==1) //sprawdz czy ten typ konta moze ogladac ta zawartosc
			if(($prawo==0 && $u==1) || ($prawo==1 && $a==1) || ($prawo==2 && $m==1))
				return true;
			else
				header("Location: index.php");
		else
			header("Location: index.php");
	}else{
		header("Location: index.php");
	}
}

function createAccount($dane){

	$qr = "INSERT user (login, pass, rights) VALUES (";
	foreach($dane as $value)
	{
		$qr = $qr."'".$value."', ";
	}
	$qr = substr($qr, 0, strlen($qr)-2);
	$qr = $qr.")";

	$result = sqlDataManager::modQuery($qr);
	return $result;
	
}	
?>