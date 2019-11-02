<style>
	body{
		background-image: url("/img/green.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
	}
</style>

<div class="row" id="loginPanelRow">
	<div class="col-lg-4 col-lg-offset-4">
		<div class="panel panel-default" style="margin: 25px">
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
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="/register"><button type="button" id="registerBtn" class="btn btn-primary" style="float:right;">Register</button></a>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#submitForm").submit(function(){
		$.post("/phpscripts/requests/login.php", {username: $("#username").val(), password: $("#password").val()}, function(data){
			
			console.log(data)
			
			if(data == "success") //data.localeCompare("success") == 0  
			{
				location.reload() //suckacock
			}
			else
			{
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