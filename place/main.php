<?php
include "core/init.php";
include 'includes/overall/header.php';
protectPage(1,1,1);
?>

	<h1>Siema <?php echo $s_login; ?></h1>
	<p>Co chcesz zrobić: </p>
	<?php  mainMenu($s_rights); ?>
	
<?php include 'includes/overall/footer.php'; ?>