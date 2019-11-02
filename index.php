<?php
	include("phpscripts/fillin/scripts.php");

	//Uncomment this to hide page errors.
	//Comment this to show errors
	//error_reporting(0);

	//TODO: Make a new table with all classes and which periods they go to
	//TODO: Each MySQL row must contain the ID of it's class, the number of the day, and the ID of the period

	$conn = get_mysql_conn();

	//Begin main page routing
	if(isset($_GET["page"])){
        $pageNum = clean($_GET["page"], 'int');
        if($pageNum < 1){
            $pageNum = 1;
        }
    }else{
        $pageNum = 1;
    }
	
	$showNavbar = true;
	
	$includeHead = true;
	$url = (parse_url($_SERVER['REQUEST_URI']));
	$url['path'] = str_replace('.php', '', $url['path']);
	$url['path'] = explode('/', $url['path']);

	$pageBase = 1;
	$url['path'][$pageBase] = strtolower($url['path'][$pageBase]);
	if(count($url['path']) > $pageBase + 1 && $url['path'][$pageBase + 1] <> ''){
		$url['path'][$pageBase + 1] = str_replace("%20", " ", $url['path'][$pageBase + 1]);
	}
	for ($i = 0; $i < $pageBase; $i++) {
		array_shift($url["path"]);
	}
	$url["path"] = array_map("strtolower", $url["path"]);
	$furl = $url["path"];

	$page = "pages/errors/notfound.php"; //if we didn't assign a page dir by the end of the code, display 404
	
	if(accounts::isLoggedIn())
	{
		$currAccount = accounts::get_current_account();
		if($furl[0] == "")
		{
			$page = "pages/forum.php";
		}
		if($furl[0] == "account")
		{
			$page = "pages/account.php";
		}
	}else{
		if($furl[0] == ""){
			$showNavbar = false;
			$page = "pages/index.php";
		}
		
		if($furl[0] == "register"){
			$page = "pages/register.php";
		}
	}

	if($furl[0] == "404"){
		$page = "pages/errors/notfound.php";
	}
	if($furl[0] == "403"){
		$page = "pages/errors/nopermission.php";
	}

	if($includeHead){
		include("phpscripts/fillin/head.php");
	}
	if($showNavbar){
?>
<div id="navbarDiv"><?php include("phpscripts/fillin/navbar.php"); ?></div>
<?php
	}
?>
<div id="body_div" <?php if(!$showNavbar){ echo "style='height:100%;'"; } ?>>
	<?php
		if(file_exists($page)){
			include($page);
		}else{
			include("pages/errors/fileerror.php");
		}
	?>
</div>

<?php
	if(session_status() == 2 && isset($_SESSION["pageMessage"]) && $_SESSION["pageMessage"] !== ""){
		$pageMessageType = "success";
		if(isset($_SESSION["pageMessageType"])){
			$pageMessageType = $_SESSION["pageMessageType"];
		}
?>
<script>
	$.notify({
		message: "<?php echo $_SESSION["pageMessage"] ?>",
	},{
		type: "<?php echo $pageMessageType ?>",
		z_index: 103001,
		placement: {
			from: "top",
			align: "left"
		},
	})
</script>
<?php }
	if(isset($_SESSION)){
		unset($_SESSION["pageMessage"]);
		unset($_SESSION["pageMessageType"]);
	}

	if(gettype($conn) == "object"){
		mysqli_close($conn);
	}
 ?>
