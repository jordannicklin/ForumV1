<?php
	include("../fillin/scripts.php");
	
	var_dump($_POST["id"]);
	
	echo message::delete_msg($_POST["id"]);
?>