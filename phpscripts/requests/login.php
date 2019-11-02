<?php
	include("../fillin/scripts.php");
	
	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		
		//var_dump(accounts::login($_POST["username"],$_POST["password"]));
		
		echo accounts::login($_POST["username"],$_POST["password"]);
	}
?>