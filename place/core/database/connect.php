<?php 
class sqlDataManager{
private static $server = 'localhost';
private static $user = 'root';
private static $pass = '';
private static $db = 'system_plac';

public static function getConnection()
{
	$mysqli = new mysqli(self::$server, self::$user, self::$pass, self::$db);
	if($mysqli->connect_errno)
	{
		echo "Problem z połączeniem, numer: ".$mysqli->connect_errno." o treści: ".$mysqli->connect_error;
		return false;
	}else{
		return $mysqli;
	}
}

	
public static function retQuery($qr)
{
	$mysqli = self::getConnection();
	$stmt = $mysqli->query($qr);
	
	if(!$stmt)
	{
		echo "Pojawił się problem połączenia z bazą danych. ";
		return false;
	}else{
		$result = array();
		$i=0;
		while ($row=$stmt->fetch_row()) {
			$result[$i]= $row;
			$i++;
		}
		
		$stmt->close();
		$mysqli->close();
		return $result;
	}
}

public static function modQuery($qr)
{
	$mysqli = self::getConnection();
	
	$stmt = $mysqli->query($qr);
	
	if(!$stmt)
	{
		echo "Pojawił się problem połączenia z bazą danych. ";
		return false;
	}else{
		$result = $mysqli->affected_rows;

		$mysqli->close();
		return $result;
	}
}









}
?>