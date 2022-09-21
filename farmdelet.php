<?php
include "app/DBfetch.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM coffee_contract WHERE id='$id' ";
    $qry = mysqli_query($connect, $query);
    echo 'Record deleted successfully.';
}
