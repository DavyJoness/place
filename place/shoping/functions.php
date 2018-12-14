<?php

function connect(){
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'system_plac';
	
	return $mysqli = new mysqli($server,$user,$pass,$db);
	}
	
function stanKonta($catalog){
	$mysqli = connect();
	
  	if($stat = $mysqli -> prepare("SELECT sum(kwota) FROM dane WHERE katalog=?")){
		$stat -> bind_param("s", $catalog);
		$stat -> execute();
		$stat -> bind_result($dbSuma);
		$stat -> fetch();						
		$stat -> close();		
			}
  		return $dbSuma;
}
	
function usun($id, $catalog){
	$mysqli = connect();
	
	if($stat = $mysqli -> prepare("DELETE FROM dane WHERE id=? AND katalog=?")){
		$stat -> bind_param("ss",$id, $catalog);
		$stat -> execute();
		}
		else {echo "Błąd zapytania <br>"; return false;}
		$stat -> close();
		return true;
	
}	
	


	
	
	
	
	
	
	
	