<?php
include "app/DBfetch.php";

if ($_POST["farm"] == "Select Farm" || $_POST["price"]== "0") {
    echo '<p>Please Select the farm again</p>';
} else {
    if (isset($_POST["telegramId"])) {
        $admin_telegram_id = mysqli_real_escape_string($connect, $_POST["telegramId"]);
        $fname = mysqli_real_escape_string($connect, $_POST["farm"]);
        $price = mysqli_real_escape_string($connect, $_POST["price"]);

        date_default_timezone_set('Africa/Addis_Ababa');
        $time = date("h:ia");
        $today = date('y-m-d');

        $query = "INSERT INTO price_temp(telegram_id,contract_name,price,date_registered) VALUES ('" . $admin_telegram_id . "','" . $fname . "','" . $price . "','" . $today . "')";
        if (mysqli_query($connect, $query)) {
            echo '<p>You have entered</p>';
            echo '<p>Name:' . $name . '</p>';
            echo '<p>Email:' . $fname . '</p>';
            echo '<p>Message : ' . $woreda . '</p>';
        }
    }
}
