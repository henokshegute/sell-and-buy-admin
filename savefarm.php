<?php
include "app/DBfetch.php";

if (isset($_POST["telegramId"])) {
    $admin_telegram_id = mysqli_real_escape_string($connect, $_POST["telegramId"]);
    $fname = mysqli_real_escape_string($connect, $_POST["fname"]);

    date_default_timezone_set('Africa/Addis_Ababa');
    $time = date("h:ia");
    $today = date('y-m-d');

    $query = "INSERT INTO coffee_contract(telegram_id,contract_name,date_registered) VALUES ('" . $admin_telegram_id . "','" . $fname . "','" . $today . "')";
    if (mysqli_query($connect, $query)) {
        echo '<p>You have entered</p>';
        echo '<p>Name:' . $name . '</p>';
        echo '<p>Email:' . $fname . '</p>';
        echo '<p>Message : ' . $woreda . '</p>';
    }
}
