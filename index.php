<?php require_once 'app/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Mastercard Foundation</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="icon" href="images/crlogo.jpg">
    <?php if (auth_user() !== null) { ?>
        <link href="css/dashboard.css" rel="stylesheet">
    <?php } ?>
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="ajax/paging.js"></script>

</head>

<body>
    <?php
    if (auth_user() !== null) {
        echo "<script>window.location.href='dashboard.php';</script>";
    } else if (auth_user_farm() !== null) {
        echo "<script>window.location.href='farmadmindashboard.php';</script>";
    } else { ?>
        <div>
            <?php require_once 'inc/sign-in.php'; ?>
        </div>
    <?php } ?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>