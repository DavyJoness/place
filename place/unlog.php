<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage();
?>

<?php 

if(isset($s_logged))
{
	session_destroy();
	header("Location: index.php");
}else{
	header("Location: index.php");
} ?>

<?php include 'includes/overall/footer.php'; ?>
