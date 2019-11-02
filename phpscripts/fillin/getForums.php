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
		<?php } ?>
	</p>
<?php
    }
?>