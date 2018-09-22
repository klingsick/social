<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>

	<form action="register.php" method="POST">
		<input type="email" name="log_email" placeholder="Email Address">
		<br>
		<input type="password" name="log_password" placeholder="Password">
		<br>
		<input type="submit" name="login_button" value="Login">
		<br><br>
	</form>

	<form action="register.php" method="POST">
		<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
			if (isset($_SESSION['reg_fname'])) {
				echo $_SESSION['reg_fname'];
			}
		?>" required>
		<br>
		<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
			if (isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			}
		?>" required>
		<br>
		<input type="text" name="reg_email" placeholder="Email" value="<?php 
			if (isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			}
		?>" required>
		<br>
		<input type="text" name="reg_email2" placeholder="Confirm Email" value="<?php 
			if (isset($_SESSION['reg_email2'])) {
				echo $_SESSION['reg_email2'];
			}
		?>" required>
		<br>
		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<input type="submit" name="register_button" value="Register">
		<br>
		<?php
			if (count($error_array) > 0) {
				$array_length =  count($error_array);
				$count = 0;
				while ($count < $array_length) {
					echo $error_array[$count];
					$count++;
				}
			}
		?>

	</form>

</body>
</html> 