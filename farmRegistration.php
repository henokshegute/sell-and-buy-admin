<?php require_once 'app/config.php'; ?>
<?php if (!defined("APP_NAME")) exit(); ?>
<?php $user = auth_user();
if ($user === null) exit();
?>
<?php
include "app/DBfetch.php";
$Uname = $user["email"];
$admin_id = "SELECT * FROM company_users WHERE role='admin' && telegram_username='$Uname' ";
$admin_idQ = mysqli_query($connect, $admin_id);
$query = "SELECT * FROM coffee_contract";
$result = mysqli_query($connect, $query);

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
    <link rel="stylesheet" href="css/registerSeller.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
    <!--  -->
    <div>
        <div class="headcard">
            <div class="cardtext">
                <p class="e"><b>Outgrower Dashboard</b></p>
            </div>
        </div>
    </div>

    <!--  -->
    <!--  -->

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link " aria-current="true" href="dashboard.php">Transaction Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="pickingreport.php" tabindex="-1" aria-disabled="true">Picking Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_seller.php" tabindex="-1" aria-disabled="true">Register Seller</a>
                </li>
                <li class="nav-item " id="log">
                    <a class="nav-link" href="scaleManRegistration.php">Register Scale Man</a>
                </li>
                <li class="nav-item" id="log">
                    <a class="nav-link  active" href="farmRegistration.php">Register Farm</a>
                </li>
                <li class="nav-item" id="log">
                    <a class="nav-link " href="price_request.php">Price Change</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" style="color:red">Logout</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                        <div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
                            <i class="fa fa-fw fa-check-circle"></i>
                            <strong> Success ! </strong> Data saved successfully.
                        </div>
                        <div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
                            <i class="fa fa-fw fa-times-circle"></i>
                            <strong> Note !</strong> Data saving failed.
                        </div>
                        <div class="formcard" id="formcard" onsubmit="event.preventDefault()">
                            <h5 class="text-center mb-4">Farm Registration Form</h5>
                            <form class="form-card" id="serializeForm">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Admin Telegram ID</label>
                                        <?php while ($row = mysqli_fetch_array($admin_idQ)) {
                                            $admin_telegram_id = $row['telegram_id'];
                                        ?>
                                            <input type="text" id="telegramId" name="telegramId" value=<?php echo $admin_telegram_id ?> placeholder=<?php echo $admin_telegram_id ?> readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Farm Name<span class="text-danger"> *</span></label>
                                        <input type="text" id="fname" name="fname" placeholder="Enter farm name" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="button">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="farm_table" class="farm_table">

                <table class="table table-bordered " style="border-color: #8d9093; background-color:white; ">
                    <tr style="background-color: #e7feff;">
                        <th style="text-align: center; padding:20px">Id</th>
                        <th style="text-align: center; padding:20px">Farm Name</th>
                        <th style="text-align: center; padding:20px">Action</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {

                    ?>
                        <tr id="<?php echo $row['id'] ?>">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["contract_name"]; ?></td>
                            <td><button class="btn btn-danger remove-record">Delete</button></td>
                        </tr>

                    <?php
                    }
                    ?>
                </table>
            </div>
            <script type="text/javascript">
                $(function() {
                    $('.alert-danger').hide(0, function() {

                    });
                    $("#button").click(function() {
                        var fname = $("#fname").val();
                        var dataString = $("#serializeForm").serialize();
                        if (fname == "") {
                            $(".alert-danger").fadeIn();
                            $(".alert-danger").fadeOut(800);
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "savefarm.php",
                                data: dataString,
                                success: function(data) {
                                    $(".alert-success").fadeIn();
                                    $(".alert-success").fadeOut(800);
                                    $("#serializeForm")[0].reset();
                                }
                            });
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                $(".remove-record").click(function() {
                    var id = $(this).parents("tr").attr("id");
                    if (confirm('Are you sure to delete this record ?')) {
                        $.ajax({
                            url: 'farmdelet.php',
                            type: 'GET',
                            data: {
                                id: id,

                            },
                            error: function() {
                                alert('Something is wrong, couldn\'t delete record');
                            },
                            success: function(data) {
                                $("#" + id).remove();
                                alert("Record delete successfully.");

                            }
                        });
                    }
                });
            </script>
        </div>
        <!--  -->
        <!--  -->
    </div>
</body>

</html>