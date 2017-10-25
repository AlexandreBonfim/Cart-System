<html>
<head>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

	<div align="center" >
		<form class="form-horizontal" action="index.php" method="POST">
			<div class="form-group">
			<div class="col-sm-4">
				<label>UserName:</label>
		       	<input type="text" class="form-control" id="username" name="username">
		  	</div>
		 	</div>
  			<div class="form-group">
			<div class="col-sm-4">
				<label>Password: </label>
  				<input type="password" class="form-control" id="password" name="password">
		  	</div>
  			</div>
  			<div class="form-group">
 	 		<div class="col-sm-offset-1 col-sm-8">
				<button type="submit" name="sign" >Sign In</button>
				<button type="submit" name="newaccount" >New Account</button>
	  		</div>
            </div>
			<br><div class="g-recaptcha" data-sitekey="6Ldrew8UAAAAAN0cCUJy6FcNkieWgokIxxBLl9mK"></div>
		</form>
	</div>
</body>
</html>

