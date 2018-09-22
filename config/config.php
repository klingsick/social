<?php

ob_start(); // Turns on output buffering

session_start();

$timezone = date_default_timezone_set("America/Chicago");

$con = mysqli_connect("localhost", "swirlfeed", "S0c1alM3dia4G00d!", "social");

if (mysqli_connect_errno()) {
	echo "Failed to connect:" . mysqli_connect_errno();
}

?>