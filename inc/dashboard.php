<?php if (!defined("APP_NAME")) exit(); ?>
<?php $user = auth_user();
if ($user === null) exit();
?>
<?php
$connect = mysqli_connect("localhost", "root", "", "nebils");
$query = "SELECT * FROM stock_list ";
$result = mysqli_query($connect, $query);
?>
<div>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light " style="background-color:#ef6721;">
    <div class="container-fluid">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color:white"><?php echo "Welcome"  ?></a>
      </div>
      <div id="naew" class="navbar-collapse collapse">
        <li class="nav navbar-nav navbar-center">
          <a href="view.php" class="text-decoration-none ">HOME</a>
        </li>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <li class="nav navbar-nav navbar-right">
          <a href="logout.php" class="text-decoration-none ">Logout</a>
        </li>
      </div>

    </div>
  </nav>
</div>

<div class="card ">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href="#">Progress Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Upload</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div>
      <p>
      <h3>Some text here</h3>
      </p>
      <p>apnother long text sub topic </p>
    </div>

    <div id="report_table" class="table">
      
      <table class="table table-bordered " style="border-color: black; background-color:white; ">
        <tr style="background-color: #e7feff;">
          <th>First column</th>
          <th>second</th>
          <th>srd</th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
          <th>forth </th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["item_id"]; ?></td>
            <td><?php echo $row["quantity"]; ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
            <td><?php echo $row["unit"] ?></td>
          </tr>
        <?php
        }
        ?>
      </table>
      <br></br>

    </div>

  </div>
  
  