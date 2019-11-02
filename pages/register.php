<div class="row" id="loginPanelRow">
	<div class="col-lg-4 col-lg-offset-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="submitForm">
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" required class="form-control" placeholder="Username" id="username">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon">Password</span>
						<input type="password" required class="form-control" placeholder="Password" id="password">
					</div>
					<br>
					<button class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#submitForm").submit(function(){
		$.post("/phpscripts/requests/regester.php", {username: $("#username").val(), password: $("#password").val()}, function(data){
			console.log(data)
			if(data == "success"){
				window.location = "/"
			}else{
				$.notify({
                    message: data,
                },{
                    type: "danger",
                    z_index: 10300001,
                })
			}
		})
		
		return false
	})
</script>