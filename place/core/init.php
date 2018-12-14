<?php 
session_start();
//error_reporting(0);
require 'database/connect.php';
include 'functions/functions.php';
include 'functions/users.php';
include 'functions/menu.php';

if(logged_in()==true)
{
	$s_logged = $_SESSION['logged'];
	$s_login = $_SESSION['login'];
	$s_rights = $_SESSION['rights'];
	$s_catalog = $_SESSION['catalog'];
}
?>