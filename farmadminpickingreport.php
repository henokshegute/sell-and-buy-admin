<?php require_once 'app/config.php'; ?>
<?php if (!defined("APP_NAME")) exit(); ?>
<?php
$user_farm = auth_user_farm();
$user = auth_user();
if ($user_farm === null && $user == null) exit();
?>
<?php
include "app/DBfetch.php";
include "saveseller.php";
$userData = $_SESSION["user"];
$farmData = $userData["assigned_farm"];
$query = "SELECT c.collecting_id,c.zone,c.neighborhood,c.farm_name,c.picker_name,c.latitude,c.longitude,c.quantity,c.rate,c.total,c.collecting_date,c.time,company_users.firstname,
company_users.lastname FROM collecting AS c INNER JOIN company_users ON c.buyer_telegram_id = company_users.telegram_id WHERE farm_name='$farmData' ORDER BY collecting_id DESC";
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

    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript"></script>
    <script type="text/javascript" src="ajax/paging.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#report_table').paging({
                limit: 10
            });
        });
    </script>
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
                        <a class="nav-link " aria-current="true" href="farmadmindashboard.php">Transaction Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="farmadminpickingreport.php">Picking Report</a>
                    </li>
                    <li class="nav-item" id="log">
                        <a class="nav-link " href="logout.php" style="color:red">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div>
                    <p>
                    <h3>Picking Summary</h3>
                </div>
                <div class="container-fluid px-1 py-5 mx-auto" style="border-color:black ">
                    <div class="row justify-content-between text-left" style="width: 350px;">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <input class="form-control" type="text" name="from_date" id="from_date" placeholder="From Date" />
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <input class="form-control" type="text" name="to_date" id="to_date" placeholder="To Date" />
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" style="margin-top:10px" />
                        </div>
                    </div>



                </div>
                <div id="report_table" class="table">

                    <table class="table table-bordered " style="border-color: #8d9093; background-color:white; ">
                        <tr style="background-color: #e7feff;">
                            <th style="text-align: center; padding:20px">Transaction Number</th>
                            <th style="text-align: center; padding:20px">Scale Man</th>
                            <th style="text-align: center; padding:20px">Zone</th>
                            <th style="text-align: center; padding:20px">Neighborhood</th>
                            <th style="text-align: center; padding:20px">Farm Name</th>
                            <th style="text-align: center; padding:20px">Picker Name</th>
                            <th style="text-align: center; padding:20px">Quantity (Kg)</th>
                            <th style="text-align: center; padding:20px">Rate per kg (Birr)</th>
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

                                <td><?php echo $row["collecting_id"]; ?></td>
                                <td><?php echo $fullname ?></td>
                                <td><?php echo $row["zone"]; ?></td>
                                <td><?php echo $row["neighborhood"]; ?></td>
                                <td><?php echo $row["farm_name"]; ?></td>
                                <td><?php echo $row["picker_name"]; ?></td>
                                <td><?php echo $row["quantity"]; ?></td>
                                <td><?php echo $row["rate"]; ?></td>
                                <td><?php echo $row["total"]; ?></td>
                                <td><a href="map.php?cordinates=<?php echo $latlong
                                                                ?>">View</a></td>
                                <td><?php echo $row["collecting_date"]; ?></td>
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
            if ((from_date != '' && to_date != '')) {
                $.ajax({
                    url: "pickingfilterforfarmadmin.php",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date
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