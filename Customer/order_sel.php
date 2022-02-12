<?php
                           
require_once "config.php";


$USER_ID = 0;
session_start();
if(isset($_SESSION["User_ID"])){
    
   $USER_ID = $_SESSION["User_ID"];
    
}
$output = '';
    $output = '                      <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">  
   <script src="vendors/jquery/dist/jquery.min.js"></script>
 
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="build/js/custom.min.js"></script>
      
      
      
   <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
   
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

   
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
                    
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                        <th style="display:none;">ID</th>
                          <th>Name</th>
                         
                          <th>List Price</th>
                          <th>Quantity</th>
                          <th>Action</th>
                       
                        </tr>
                      </thead>


                      <tbody>
                     
                        <tr>';
                           
                              
                              


if ($link->connect_error)
{
    die("Connection failed: " . $link->connect_error);

}
$sql = "select  product.ID, product.Name , orders.ListPrice, orders.QTY   FROM product INNER JOIN orders ON product.ID = orders.ID WHERE orders.customer_id = ".$USER_ID."";

$result = $link->query($sql);
if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
        //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
         $output .= "<td style='display:none;' data-id0='".$row["ID"] . "' class=\" \" >" . $row["ID"] . "</td>";
        $output .= "<td data-id1='".$row["Name"] . "' class=\" \" >" . $row["Name"] . "</td>";

          
        
        
        
        $output .= "<td class=\" \" >" . $row["ListPrice"] . "</td>";
        
      
        
        $output .= "<td class=\" \" >" . $row["QTY"] . "</td>";
     
        $output .= " <td class='last'> <center> <button class='btn btn-primary' data-id3='".$row["ID"] . "' name='btn_deletes' id='btn_deletes' >Delete</button> </center>"   ; 
        
        
       

        $output .= "</tr>";
    }

}


                       







                              
                              
                              
                              
                             
                              
                              
                       
                     $output .= '        </tr>
                        
                      </tbody>
                    </table>
      
                      
           
                      
                   ';
echo $output;
                              ?>