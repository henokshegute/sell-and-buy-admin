
<?php
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
if (isset($_POST["filter_farm"])) {
    include "app/DBfetch.php";
    $output = '';
    $query = "SELECT transaction.transaction_id,transaction.zone,transaction.neighborhood,transaction.contract_name,transaction.seller_name,
transaction.quantity,transaction.price,transaction.total,transaction.longitude,transaction.latitude,company_users.firstname,company_users.lastname FROM transaction INNER JOIN company_users ON transaction.buyer_telegram_id = company_users.telegram_id  WHERE contract_name = '" . $_POST["filter_farm"] . "'   
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
                <th style="text-align: center; padding:20px">Location</th>
                </tr>  
               </thead> 
      ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $latlong = $row['latitude'] . "_" . $row['longitude'];
            $fullname = $row["firstname"] . " " . $row["lastname"];
            // $buyerID = $row["buyer_telegram_id"];
            $output .= '  
                    <tr>  
                         <td>' . $row["transaction_id"] . '</td> 
                         <td>' . $fullname . '</td>  
                         <td>' . $row['zone'] . '</td>   
                         <td>' . $row["neighborhood"] . '</td>
                         <td>' . $row["contract_name"] . '</td>
                         <td>' . $row["seller_name"] . '</td>
                         <td>' . $row["quantity"] . '</td>  
                         <td>' . $row["price"] . '</td>  
                         <td>' . $row["total"] . '</td> 
                         <td>' . $row["total"] . '</td> 
                         <td><a href=map.php?cordinates=' . $latlong . '>' . "View" . '</a></td>
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
