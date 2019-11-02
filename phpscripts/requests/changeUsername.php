<?php
	include("../fillin/scripts.php");
	
	echo accounts::changeUsername($_SESSION["userid"], $_POST["username"]);
?>