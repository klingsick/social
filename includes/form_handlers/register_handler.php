<?php

// Declaring variables to prevent errors
$fname = ""; // First Name
$lname = ""; // Last Name
$em = ""; // email
$em2 = ""; // email 2
$password = ""; // password
$password2 = ""; // password 2
$date = ""; // Sign up date
$error_array = array(); // Error messages

if (isset($_POST['register_button'])) {
	// Registration form values

	// First Name
	$fname = strip_tags($_POST['reg_fname']); // Remove html tags
	$fname = str_replace(' ', '', $fname); // Remove spaces
	$fname = ucfirst(strtolower($fname)); // Uppercase first letter only
	$_SESSION['reg_fname'] = $fname; // Stores first name into session variable

	// Last Name
	$lname = strip_tags($_POST['reg_lname']); // Remove html tags
	$lname = str_replace(' ', '', $lname); // Remove spaces
	$lname = ucfirst(strtolower($lname)); // Uppercase first letter only
	$_SESSION['reg_lname'] = $lname; // Stores last name into session variable


	// email
	$em = strip_tags($_POST['reg_email']); // Remove html tags
	$em = str_replace(' ', '', $em); // Remove spaces
	$em = strtolower($em); // lower case only
	$_SESSION['reg_email'] = $em; // Stores email into session variable


	// email 2
	$em2 = strip_tags($_POST['reg_email2']); // Remove html tags
	$em2 = str_replace(' ', '', $em2); // Remove spaces
	$em2 = strtolower($em2); // Lower case letter only
	$_SESSION['reg_email2'] = $em2; // Stores email 2 into session variable


	// password
	$password = strip_tags($_POST['reg_password']); // Remove html tags

	// password 2
	$password2 = strip_tags($_POST['reg_password2']); // Remove html tags

	$date = date("Y-m-d"); // Current date

	if ($em == $em2) {

		//Check if email is in valid format
		if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			// Check if email already exists
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em");

			// Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if ($num_rows > 0) {
				array_push($error_array, "Email already in use<br>") ;
			}

		} else {
			array_push($error_array, "Invalid email format<br>");
		}


	} else {
		array_push($error_array, "Emails don't match<br>");
	}

	if (strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters.<br>");
	}

	if (strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array, "Your last name must be between 2 and 25 characters.<br>");
	}

	if ($password != $password2) {
		array_push($error_array, "Passwords don't match!<br>");
	} else {
		if (preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Password can only contain letters and numbers<br>");
		}
	}

	if (strlen($password) > 30 || strlen($password) < 5) {
		array_push($error_array, "Password must be between 5 and 30 characters long.<br>");
	}

	if (empty($error_array)) {
		$password = md5($password); // Encrypt password

		// Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username");

		$i = 0;
		// If username exists add number to end
		while (mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username");

		}

		// Assign random profile picture
		$rand = rand(1, 16); // random number between 1 and 16
		$default_profile_pic_folder = "assets/images/profile_pics/defaults/";
		$profile_pic = $default_profile_pic_folder . "head" . $rand . ".png";

		// insert values into database
		mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
		// success message
		array_push($error_array, "<span style='color: #14c800'><br>You're all set! Go ahead and log in!<br>Your username is $username <br></span>");

		// Clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";


	}

}

?>