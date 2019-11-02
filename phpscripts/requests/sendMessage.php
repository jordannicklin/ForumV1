<?php
	include("../fillin/scripts.php");
	
	var_dump($_POST);
	
	echo message::send_msg($_POST["message"]);
?>