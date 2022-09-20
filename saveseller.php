<?php
include "app/DBfetch.php";

if (isset($_POST["telegramId"])) {
	$admin_telegram_id = mysqli_real_escape_string($connect, $_POST["telegramId"]);
	$fname = mysqli_real_escape_string($connect, $_POST["fname"]);
	$lname = mysqli_real_escape_string($connect, $_POST["lname"]);
	$woreda = mysqli_real_escape_string($connect, $_POST["woreda"]);
	$neighborhood = mysqli_real_escape_string($connect, $_POST["neighborhood"]);
	$landsize = mysqli_real_escape_string($connect, $_POST["landsize"]);
	$no_of_tree = mysqli_real_escape_string($connect, $_POST["tree"]);
	$phone = mysqli_real_escape_string($connect, $_POST["phone"]);
	$fullname = $fname . " " . $lname;

	date_default_timezone_set('Africa/Addis_Ababa');
	$time = date("h:ia");
	$today = date('y-m-d');

	$query = "INSERT INTO sellers(admin_telegram_id,firstname,lastname,fullname,woreda,neighborhood,land_size,number_of_tree,phone_number,date_registered) VALUES ('" . $admin_telegram_id . "','" . $fname . "','" . $lname . "','" . $fullname . "','" . $woreda . "','" . $neighborhood . "','" . $landsize . "','" . $no_of_tree . "','"."+251" . $phone . "','" . $today . "')";
	if (mysqli_query($connect, $query)) {
		echo '<p>You have entered</p>';
		echo '<p>Name:' . $name . '</p>';
		echo '<p>Email:' . $fname . '</p>';
		echo '<p>Message : ' . $woreda . '</p>';
	}
}
