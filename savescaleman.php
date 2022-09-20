<?php
include "app/DBfetch.php";

if (isset($_POST["telegramId"])) {
    $admin_telegram_id = mysqli_real_escape_string($connect, $_POST["telegramId"]);
    $company = mysqli_real_escape_string($connect, $_POST["company"]);
    $fname = mysqli_real_escape_string($connect, $_POST["fname"]);
    $lname = mysqli_real_escape_string($connect, $_POST["lname"]);
    $woreda = mysqli_real_escape_string($connect, $_POST["woreda"]);
    $phone = mysqli_real_escape_string($connect, $_POST["phone"]);
    $telegram_username = mysqli_real_escape_string($connect, $_POST["tguser"]);
    $role = "scale man";
    date_default_timezone_set('Africa/Addis_Ababa');
    $time = date("h:ia");
    $today = date('y-m-d');

    $query = "INSERT INTO company_users(company_telegram_id,firstname,lastname,woreda,telegram_username,role,phone_number,company_name,date_registered) VALUES ('" . $admin_telegram_id . "','" . $fname . "','" . $lname . "','" . $woreda . "','" . $telegram_username . "','" . $role . "','" . "+251" . $phone . "','" . $company . "','" . $today . "')";
    if (mysqli_query($connect, $query)) {
        echo '<p>You have entered</p>';
        echo '<p>Name:' . $name . '</p>';
        echo '<p>Email:' . $fname . '</p>';
        echo '<p>Message : ' . $woreda . '</p>';
    }
}
