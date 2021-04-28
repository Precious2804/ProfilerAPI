<!DOCTYPE html>
<html>
<head>
  <title>Profila-Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="artisan_register">
  @csrf
  	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="artFname">
  	</div>
  	<div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="artLname">
  	</div>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="artUser">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="artEmail">
  	</div>
  	<div class="input-group">
  	  <label>Phone</label>
  	  <input type="number" name="artPhone">
  	</div>
  	<div class="input-group">
	  <select name="artGender" id="artGender">
	  	<option value="">Gender</option>
	  	<option value="Male">Male</option>
	  	<option value="Female">Female</option>
	  </select>
  	</div>
  	<div class="input-group">
	  <label>Date of Birth</label>
	  <input type="date" name="artDate">
  	</div>
	  <div class="input-group">
		<select name="category" id="category">
            <option value="">Select Category</option>
            <option value="Plumber">Plumbering</option>
            <option value="Electrician">Electricity Works</option>
            <option value="Hair Stylist">Hair Styling</option>
            <option value="Mechanic">Mechanical Works</option>
            <option value="AC Installer">AC Installation & Repairs</option>
            <option value="Electronics Repairer">Electronics Repairs</option>
        </select>
	</div>
	  <div class="input-group">
		<label>Resident Address</label>
		<textarea name="artAddress"  cols="50" rows="5"></textarea>
	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="artisan_login">Sign in</a>
  	</p>
  </form>
</body>
</html>