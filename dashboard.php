<?php require_once 'app/config.php'; ?>
<?php if (!defined("APP_NAME")) exit(); ?>
<?php $user = auth_user();
if ($user === null) exit();
?>
<?php
include "app/DBfetch.php";
include "saveseller.php";
$query = "SELECT transaction.transaction_id,transaction.zone,transaction.neighborhood,transaction.contract_name,transaction.seller_name,
transaction.quantity,transaction.price,transaction.total,transaction.longitude,transaction.latitude,transaction.transaction_date,transaction.time,company_users.firstname,company_users.lastname FROM transaction INNER JOIN company_users ON transaction.buyer_telegram_id = company_users.telegram_id ORDER BY transaction_id DESC";
$result = mysqli_query($connect, $query);
$farm = "SELECT contract_name from coffee_contract";
$farmList = mysqli_query($connect, $farm);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>dashboard</title>
  <link rel="icon" href="images/crlogo.jpg">
  <meta name="author" content="FrontendScript" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/dashboard.css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


</head>

<body>
  <!--  -->

  <div>
    <div class="headcard">
      <div class="cardtext">
        <p class="e"><b>Outgrower Dashboard</b></p>
      </div>
    </div>
    <!--  -->
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="true" href="dashboard.php">Transaction Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="pickingreport.php" tabindex="-1" aria-disabled="true">Picking Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_seller.php" tabindex="-1" aria-disabled="true">Register Seller</a>
          </li>
          <li class="nav-item" id="log">
            <a class="nav-link " href="scaleManRegistration.php">Register Scale Man</a>
          </li>
          <li class="nav-item" id="log">
            <a class="nav-link " href="farmRegistration.php">Register Farm</a>
          </li>
          <li class="nav-item" id="log">
            <a class="nav-link " href="price_request.php">Price Change</a>
          </li>
          <li class="nav-item" id="log">
            <a class="nav-link " href="logout.php" style="color:red">Logout</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div>
          <p>
          <h3>Transactions Summary</h3>
        </div>
        <div class="container-fluid px-1 py-5 mx-auto" style="border-color:black ">
          <div class="row justify-content-between text-left" style="width: 350px;">
            <div class="form-group col-sm-6 flex-column d-flex">
              <input class="form-control" type="text" name="from_date" id="from_date" placeholder="From Date" />
            </div>
            <div class="form-group col-sm-6 flex-column d-flex">
              <input class="form-control" type="text" name="to_date" id="to_date" placeholder="To Date" />
            </div>
            <div class="form-group col-sm-6 flex-column d-flex" style="margin-top: 20px; width: 350px;">
              <select name="filter_farm" id="filter_farm" class="form-control" required>

                <option value="">Select Farm</option>
                <?php
                while ($far = mysqli_fetch_array($farmList)) {
                  $name = $far["contract_name"];
                ?>
                  <option value=<?php echo $name ?>><?php echo $name ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group col-sm-6 flex-column d-flex">
              <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" style="margin-top:10px" />
            </div>
          </div>



        </div>
        <div id="report_table" class="report_table">

          <table class="table table-bordered " style="border-color: #8d9093; background-color:white; ">
            <tr style="background-color: #e7feff;">
              <th style="text-align: center; padding:20px">Transaction Number</th>
              <th style="text-align: center; padding:20px">Scale Man</th>
              <th style="text-align: center; padding:20px">Zone</th>
              <th style="text-align: center; padding:20px">Neighborhood</th>
              <th style="text-align: center; padding:20px">Farm Name</th>
              <th style="text-align: center; padding:20px">Seller Name</th>
              <th style="text-align: center; padding:20px">Quantity (Kg)</th>
              <th style="text-align: center; padding:20px">Price per kg (Birr)</th>
              <th style="text-align: center; padding:20px">Total Price (Birr)</th>
              <th style="text-align: center; padding:20px">Location</th>
              <th style="text-align: center; padding:40px">Date</th>
              <th style="text-align: center; padding:40px">Time</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
              $fullname = $row["firstname"] . " " . $row["lastname"];
              $latlong = $row['latitude'] . "_" . $row['longitude'];
            ?>
              <tr>

                <td><?php echo $row["transaction_id"]; ?></td>
                <td><?php echo $fullname ?></td>
                <td><?php echo $row["zone"]; ?></td>
                <td><?php echo $row["neighborhood"]; ?></td>
                <td><?php echo $row["contract_name"]; ?></td>
                <td><?php echo $row["seller_name"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["total"]; ?></td>
                <td><a href="map.php?cordinates=<?php echo $latlong
                                                ?>">View</a></td>
                <td><?php echo $row["transaction_date"]; ?></td>
                <td><?php echo $row["time"]; ?></td>
              </tr>

            <?php
            }
            ?>
          </table>
        </div>
      </div>
</body>

</html>

<script>
  $(document).ready(function() {
    $.datepicker.setDefaults({
      dateFormat: 'yy-mm-dd'
    });
    $(function() {
      $("#from_date").datepicker();
      $("#to_date").datepicker();
    });
    $('#filter').click(function() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var filter_farm = $('#filter_farm').val();
      if ((from_date != '' && to_date != '') && filter_farm == '') {
        $.ajax({
          url: "reportfilter.php",
          method: "POST",
          data: {
            from_date: from_date,
            to_date: to_date
          },
          success: function(data) {
            $('#report_table').html(data);
          }
        });
      } else if (filter_farm != '' && (from_date == '' && to_date == '')) {
        $.ajax({
          url: "filterByFarm.php",
          method: "POST",
          data: {
            filter_farm: filter_farm
          },
          success: function(data) {
            $('#report_table').html(data);
          }
        });
      } else if (filter_farm != '' && (from_date != '' && to_date != '')) {
        $.ajax({
          url: "filterbyFarmDate.php",
          method: "POST",
          data: {
            from_date: from_date,
            to_date: to_date,
            filter_farm: filter_farm
          },
          success: function(data) {
            $('#report_table').html(data);
          }
        });
      } else {
        alert("Please Select values properly");
      }
    });
  });
</script>
<script type="text/javascript"></script>
<style type="text/css"> </style>
<script type="text/javascript" src="ajax/paging.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#report_table').paging({
      limit: 10
    });
  });
</script>