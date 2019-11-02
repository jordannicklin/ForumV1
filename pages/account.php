<style>
	.input-group{
		margin-bottom: 10px;
	}
</style>

<div class="row" id="loginPanelRow">
	<div class="col-lg-4 col-lg-offset-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="changeUsernameForm">
					<div class="input-group">
						<span class="input-group-addon">Change Username</span>
						<input type="text" required class="form-control" placeholder="Username" id="username">
					</div>
					<button class="btn btn-primary">Change</button>
				</form>
				<hr>
				<form id="submitForm password">
					<div class="input-group">
						<span class="input-group-addon">Change Password</span>
						<input type="password" required class="form-control" placeholder="Password" id="password">
					</div>
					<button class="btn btn-primary">Change</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#changeUsernameForm").submit(function(){
		
		$.post("/phpscripts/requests/changeUsername.php", {username: $("#username").val()}, function(data){
			console.log(data)
			
			if(data == "success"){
				location.reload()
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
	
	$("#submitForm password").submit(function(){
		$.post("/phpscripts/requests/changePassword.php", {password: $("#password").val()}, function(data){
			console.log(data)
		})
		
		return false
	})
</script>