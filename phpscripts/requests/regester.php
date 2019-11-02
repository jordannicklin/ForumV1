<?php
	include("../fillin/scripts.php");
	
	if(!empty($_POST["username"]) && !empty($_POST["password"]))
	{	
		accounts::create($_POST["username"], $_POST["password"]);
		echo "success";
	}else
	{
		echo "cock";
	}
?>