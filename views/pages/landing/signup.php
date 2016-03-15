<form action="/auth/signupSubmit.php" method="POST">
	<div>
		<label for="username">username</label> <input type="text" name="username" id="username" placeholder="Username">
	</div>
	<div>
		<label for="password">Password</label> <input type="password" name="password" id="password" placeholder="Password">
	</div>
	<div>
		<label for="password_confirm">Confirm Password</label> <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
	</div>
	<div>
		<label for="full_name">Full Name</label> <input type="text" name="full_name" id="full_name" placeholder="FullName">
	</div>
	<div>
		<label for="gender">Gender</label>
		<input type="radio" name="gender" id="male" value="male"> Male
		<input type="radio" name="gender" id="female" value="female"> Female
	</div>
	<div>
		<button type="submit">Signup</button>
	</div>
</form>