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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="icon" href="images/masterlogo.png">
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
                <p class="e"><b>Outgrower System Administrative Dashboard</b></p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link " aria-current="true" href="dashboard.php">Transaction Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_seller.php" tabindex="-1" aria-disabled="true">Register Seller</a>
                </li>
                <li class="nav-item " id="log">
                    <a class="nav-link active" href="scaleManRegistration.php">Register Scale Man</a>
                </li>
                <li class="nav-item" id="log">
                    <a class="nav-link " href="farmRegistration.php">Register Farm</a>
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
                            <h5 class="text-center mb-4">Scale Man Registration Form</h5>
                            <form class="form-card" id="serializeForm">
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Admin Telegram ID</label>
                                        <?php while ($row = mysqli_fetch_array($admin_idQ)) {
                                            $admin_telegram_id = $row['telegram_id'];
                                            $company_name = $row['company_name'];
                                        ?>
                                            <input type="text" id="telegramId" name="telegramId" value=<?php echo $admin_telegram_id ?> placeholder=<?php echo $admin_telegram_id ?> readonly>
                                    </div>

                                <?php
                                        }
                                ?><div class="form-group col-sm-6 flex-column d-flex">
                                    <label class="form-control-label px-3">Company Name</label>
                                    <input type="text" id="company" name="company" value=<?php echo $company_name ?> placeholder=<?php echo $company_name ?> readonly>
                                </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">First name<span class="text-danger"> *</span></label>
                                        <input type="text" id="fname" name="fname" placeholder="Enter first name" required>
                                    </div>
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label>
                                        <input type="text" id="lname" name="lname" placeholder="Enter last name" required>
                                    </div>

                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Telegram Username<span class="text-danger"> *</span></label>
                                        <input type="text" id="tguser" name="tguser" placeholder="Enter Telegram Username" required>
                                    </div>
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Phone Number<span class="text-danger"> *</span></label>
                                        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
                                    </div>
                                </div>
                                <div class="row justify-content-between text-left">
                                    <div class="form-group col-sm-6 flex-column d-flex">
                                        <label class="form-control-label px-3">Woreda<span class="text-danger"> *</span></label>
                                        <input type="text" id="woreda" name="woreda" placeholder="Enter Woreda" required>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" id="button">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
        <script type="text/javascript">
            $(function() {
                $('.alert-danger').hide(0, function() {

                });
                $("#button").click(function() {
                    var fname = $("#fname").val();
                    var lname = $("#lname").val();
                    var tguser = $("#tguser").val();
                    var phone = $("#phone").val();
                    var woreda = $("#woreda").val();
                    var dataString = $("#serializeForm").serialize();
                    if (fname == "" || lname == "" || tguser == "" || woreda == "" || phone == "") {
                        $(".alert-danger").fadeIn();
                        $(".alert-danger").fadeOut(800);
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "savescaleman.php",
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
</body>

</html>