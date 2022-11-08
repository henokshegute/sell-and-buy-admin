<?php
include "app/DBfetch.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM company_users WHERE user_id='$id'";
    $qry = mysqli_query($connect, $query);
    echo 'Record deleted successfully.';
}
