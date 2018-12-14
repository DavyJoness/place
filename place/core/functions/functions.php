<?php
function dodaj($dane){
	$qr = "INSERT dane (katalog, imie, nazwisko, kwota, uwagi, dodal) VALUES (";
	foreach($dane as $value)
	{
		$qr = $qr."'".$value."' , ";
	}
	$qr = substr($qr, 0, strlen($qr)-2);
	$qr = $qr.")";
	
	$result = sqlDataManager::modQuery($qr);
	
	return $result;
}
	
function usun($id, $catalog){
	$qr = "DELETE FROM dane WHERE id = ".$id." AND katalog = ".$catalog;
	$result = sqlDataManager::modQuery($qr);
	return $result;
}	

function modyfikujDane($update, $set, $where, $andOr='')
{
	$qr = "UPDATE ".$update." SET ";

	foreach($set as $key => $value)
	{
		$qr = $qr.$key." = '".$value."', ";
	}

	$qr = substr($qr, 0, strlen($qr)-2);
	$qr = $qr." WHERE ";
	
	foreach($where as $key => $value)
	{
		$qr = $qr." ".$key." = '".$value."' ".$andOr;
	}
	
	$qr = substr($qr, 0, strlen($qr)-strlen($andOr));

	$result = sqlDataManager::modQuery($qr);
	return $result;
}

function katalogiSelect($v_catalog="")
{
	$query = "SELECT * FROM katalog ORDER BY nazwa";
	$katalog = sqlDataManager::retQuery($query);

	foreach($katalog as $key => $value)
	{
		if($value[0] == $v_catalog)
			{echo "<option value=".$value[0]." selected='selected'>".$value[1]."</option>";}
		else
			{echo "<option value=".$value[0].">".$value[1]."</option>";}
	}
}
	
function nazwaKatalogu($id='')
{
	$query = "SELECT nazwa FROM katalog WHERE id_katalog = ".$id;
	$katalog = sqlDataManager::retQuery($query);
	
	return $katalog[0][0];
}	
	
function dajId($imie, $nazwisko, $dodal)
{
	$qr = "SELECT id, data FROM dane WHERE imie='".$imie."' and nazwisko='".$nazwisko."' and dodal='".$dodal."'";
	$result = sqlDataManager::retQuery($qr);
	return $result[0];
}	

function iloscStron($v_records)
{
	$iloscRekordow = 8;
	
	$iloscStron = ceil(count($v_records) / $iloscRekordow);
	
	for($i=1; $i<=$iloscStron; $i++)
	{
		echo "<span data-page='".$i."' class='paginacja'>".$i."</span>";
	}
}	
	
	
	