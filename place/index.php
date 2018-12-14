<?php
include "core/init.php";
include 'includes/overall/header.php';

function loginForm($v_login='', $v_catalog='', $v_error='')
{ ?>
	</header>
    <script src="script/login.jQuery.js"></script>
	<div id="container" class="container">
    <div class="row">
    	<?php include 'includes/overall/aside.php'; ?>
        <div id="login" class="five columns">
        <h1>LOGOWANIE:</h1>
        <p id="caption">Podaj swój login i hasło oraz wybierz katalog.</p>
        <?php if($v_error != "")
            echo "<p class='error'>".$v_error."</p>";
        ?>
    	<p class='error'></p>
        <form action="#" method="post" id="logowanie">
            <input type="text" name="login" placeholder="Login:" value="<?php echo $v_login; ?>" /><br>
            <input type="password" name="pass" placeholder="Hasło:" value="" /><br>
            <select class='pole' name='catalog'>
            	<option selected="selected" value="">Wybierz katalog...</option>
                <?php katalogiSelect($v_catalog); ?>
            </select></br>
            <input type="submit" id="submit" value="Zaloguj" name="submit" />
        </form>
        </div>
        </div>
    </div>
<?php } ?>

<?php

if(isset($s_logged))
{
	echo "Juz jestes zalogowany!";
	header("Refresh:2; main.php");
	exit;
}

if(isset($_POST['submit']))
{
	$login = $_POST['login'];
	$password = $_POST['pass'];
	$catalog = $_POST['catalog'];
	
	if($login=='' || $password=='' || $catalog=='')
	{
		$error = "Podaj wszystkie dane logowania.";
		loginForm($login, $catalog, $error);
	}else{
		$result = login($login, $password, $catalog);
		if($result === true)
		{
			echo "zalogowano";
			header("Location: content.php");
		}else{
			$error = $result;
			loginForm($login, $catalog, $error);
		}
	}
}else{
	loginForm();
}
include 'includes/overall/footer.php';
?>
