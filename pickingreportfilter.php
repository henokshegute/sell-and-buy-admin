<?php require_once 'app/config.php'; ?>
<?php
$userData = $_SESSION["user"];
$farmData = $userData["assigned_farm"];
$export = '';
$export .= "<div class='col-md-3'>";
$export .= "<input type='button' id='dataExport' data-type='excel' name='Export' id='Export' value='Export' class='btn btn-info' /></div>";
$export .= "<script src='tableExport/tableExport.js'></script>";
$export .= "<script type='text/javascript' src='tableExport/jquery.base64.js'></script>";
$export .= "</div></br></br></br>";
echo $export;
echo "<script>
     $(document).ready(function() {
         $('#dataExport').click(function() {
             var exportType = $(this).data('type');
             $('#dataTable').tableExport({
                 type: exportType,
                 escape: 'False',
                 ignoreColumn: [],
             });
         });
     });
      </script>";
if (isset($_POST["from_date"], $_POST["to_date"])) {
    include "app/DBfetch.php";
    $output = '';
    $query = "SELECT c.collecting_id,c.zone,c.neighborhood,c.farm_name,c.picker_name,c.quantity,c.rate,c.total,c.collecting_date,c.time,company_users.firstname,
    company_users.lastname FROM collecting AS c INNER JOIN company_users ON c.buyer_telegram_id = company_users.telegram_id  WHERE collecting_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' 
      ";
    $result = mysqli_query($connect, $query);
    $output .= '  
           <table id="dataTable" class="table table-bordered">  
           <thead>
                <tr bgcolor="#dbe9f4">  
                <th style="text-align: center; padding:20px">Transaction Number</th>
                <th style="text-align: center; padding:20px">Scale Man</th>
                <th style="text-align: center; padding:20px">Zone</th>
                <th style="text-align: center; padding:20px">Neighborhood</th>
                <th style="text-align: center; padding:20px">Farm Name</th>
                <th style="text-align: center; padding:20px">Seller Name</th>
                <th style="text-align: center; padding:20px">Quantity</th>
                <th style="text-align: center; padding:20px">Price 1kg</th>
                <th style="text-align: center; padding:20px">Total Price</th>   
                <th style="text-align: center; padding:20px">Date</th>
                <th style="text-align: center; padding:20px">Time</th>
                </tr>  
               </thead> 
      ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $fullname = $row["firstname"] . " " . $row["lastname"];
            $output .= '  
            <tr>  
            <td>' . $row["collecting_id"] . '</td> 
            <td>' . $fullname . '</td>  
            <td>' . $row['zone'] . '</td>   
            <td>' . $row["neighborhood"] . '</td>
            <td>' . $row["farm_name"] . '</td>
            <td>' . $row["picker_name"] . '</td>
            <td>' . $row["quantity"] . '</td>  
            <td>' . $row["rate"] . '</td>  
            <td>' . $row["total"] . '</td> 
            <td>' . $row["collecting_date"] . '</td> 
            <td>' . $row["time"] . '</td> 
       </tr>
               ';
        }
    } else {
        $output .= '  
                <tr>  
                     <td colspan="9">No Order Found</td>  
                </tr>  
           ';
    }
    $output .= '</table>';
    echo $output;
}
