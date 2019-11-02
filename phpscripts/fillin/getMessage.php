<?php
    include("scripts.php");

    foreach (message::get_all_msgs() as $value) {
?>
    <p data-id="<?php echo $value->id ?>">
		<span style='display:block;text-align:left;'>
			<?php echo $value->user ?> -
		</span><?php echo htmlspecialchars($value->text) ?><br>
		<span style='display:block;text-align:right;'>
			-<?php echo $value->date ?>
		</span>
		<?php 
		
		$user = accounts::getByID($_SESSION["userid"]);
		
		if($user->username == $value->user){ ?>
			<button class='deleteBtn btn btn-primary btn-sm'>Delete</button>
			<script>
				$(".deleteBtn").click(function(){
					var msgId = this
					$.post("/phpscripts/requests/deletMsg.php", {id: $(this).parent().attr("data-id")}, function(data){
						console.log($(this).parent().attr("data-id"))
						$(msgId).parent().remove()
					})
				})
			</script>
		<?php } ?>
	</p>
<?php
    }
?>