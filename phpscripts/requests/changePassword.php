<?php
	include("../fillin/scripts.php");
	
	echo accounts::changePassword($_SESSION["userid"], $_POST["password"]);
?>