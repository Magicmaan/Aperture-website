<form method="post" action="">
	<label for="username">Select a username: </label>
	<input type="text" name="username" id="username"/>
	<br/><br/>
	<label for="forename">Your forename: </label>
	<input type="text" name="forename" id="forename"/>
	<br/><br/>
	<label for="surname">Your surname: </label>
	<input type="text" name="surname" id="surname"/>
	<br/><br/>
	<label for="userType">Are you tutor or student?: </label>
	<select name="userType" id="userType">
		<option value="student">student</option>
		<option value="tutor">tutor</option>
	</select>
	<br/><br/>
	<label for="password">Type a password: </label>
	<input type="password" name="password" id="password"/>
	<br/><br/>
	<input type="submit" value="CREATE AN ACCOUNT"/>
</form>