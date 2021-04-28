<!DOCTYPE html>
<html>
<head>
  <title>Profila-Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="artisan_login">
  @csrf
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="artUser" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="artisan_register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>