<style>
	#fuck{
		font-size: 16px;
		font-weight: bold;
	}
	#fuck > p{
		padding: 4px;
		background: white;
		border: 1px black solid;
	}
	
	#accountLink{
		position: absolute;
		left: 10px;
		top: 10px;
	}
</style>

<div class="row" id="loginPanelRow">
	<div class="col-lg-4 col-lg-offset-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="submitForm">
					<div class="input-group">
						<span class="input-group-addon">Text</span>
						<input type="text" required class="form-control" placeholder="message" id="message">
					</div>
					<br>
					<button class="btn btn-primary">Send</button>
				</form>
			</div>
		</div>
		<br>
		<center><div id="messages"></div></center>
	</div>
</div>

<style>
	body{
		background-image: url("/pepe.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
	}
	
	p{
		border: 2px black dotted;
		padding: 4px;
	}
</style>

<script>
	$("#registerBtn").click(function(){
		$.get("/phpscripts/requests/logout.php", function(){
			location.reload();
		});
	})
	
	function getMessages(){
		$.post("/phpscripts/fillin/getMessage.php", {message: $("#message").val()}, function(data){
			$("#messages").html(data)
		})
	}
	getMessages()

	$("#submitForm").submit(function(){
		$.post("/phpscripts/requests/sendMessage.php", {message: $("#message").val()}, function(data){
			console.log(data)
			getMessages()
		})
		
		return false
	})
</script>
