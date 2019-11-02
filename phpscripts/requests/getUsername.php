<?php
	include("../fillin/scripts.php");
	
	if(!empty($_POST["id"])){
		echo accounts::getByID($_SESSION['sessionid'])->username;
	}
?>