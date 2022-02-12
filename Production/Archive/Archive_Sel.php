<?php
                           
require_once "../config.php";

$output = '';
    $output .= ' <table id="datatable-buttons"  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                            <th class="column-title">ID </th>
                            <th class="column-title">Name </th>
                            <th class="column-title">Quantity </th>
                          <th class="column-title">Unit Price </th>
                        <th class="column-title">Date </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer"> ';
                           
                              
                              
                                if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT * FROM arcstock";
                           
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                                 
                                $output .=   "<td   class='ID' name='ID'  data-id1='". $row["ID"] . "'>" .$row["ID"] . "</td>";
                                $output .=   "<td  class='Name' name='Name'  data-id2='". $row["ID"] . "' >" .$row["Name"] . "</td>";  
                              $output .=   "<td  class='QTY' name='QTY'  data-id2='". $row["ID"] . "' >" .$row["QTY"] . "</td>";  
                              $output .=   "<td  class='UPrice' name='UPrice'  data-id2='". $row["ID"] . "' >" .$row["UPrice"] . "</td>";  
                                $output .=  "<td  class='dates' name='dates'  data-id2='". $row["ID"] . "' >" .$row["dates"] . "</td>"; 
                                    
                                 
                                  
                               $output .= "</tr>";   
                         
                              
                              
                              }
                              
                              }
                              
                              
                       
                     $output .= '  
                          </tr>
                          
                         
                        </tbody>
                      </table> 
                      
                      
                      
                                <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
      
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  
   <script src="../vendors/jquery/dist/jquery.min.js"></script>
 
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   
   
 

 
  
    <script src="../build/js/custom.min.js"></script>
      
      
      
         <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
   
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

   
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
                      
                      
                      
                      
                      
                      
                      
                      
                      ';
echo $output;
                              ?>