<?php if(accounts::isLoggedIn())
{
	echo $currAccount->username;
	
	?>
	
	<a href="javascript:void(0)" id="logOutLink"><div class="navbar-link">Log out</div></a>
	<a href="/account.php"><div class="navbar-link">Account</div></a>
	<a href="/"><div class="navbar-link">Forum</div></a>
	<?php
}
else
{
	?>
	<a href="/" id=""><div class="navbar-link">Log in</div></a>
	<?php
}
?>

<script>
	$("#logOutLink").click(function(){
		$.get("/phpscripts/requests/logout.php", function(){
			location.reload();
		});
	})
</script>