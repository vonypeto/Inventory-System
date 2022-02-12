<?php
                           
require_once "../config.php";
session_start();
$restrict = $_SESSION["oauth"];
$content = '';
if($restrict != "Senior Staff"){
    
    $content = "";
}else{
  $content = "contenteditable";  
    
}

$output = '';
    $output = '                      <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
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
                    
                     <table id="datatable-buttons" style="overflow: auto" class="table table-striped jambo_table  bulk_action">
                        <thead>
                          <tr class="headings">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                            <th class="column-title">ID </th>
                            <th class="column-title">Name </th>
                            <th class="column-title">CatID </th>
                            <th class="column-title">SupID </th>
                       
                              <th class="column-title">ForSale </th>
                               <th class="column-title">Quantity on Hand </th>
                               <th class="column-title">$ Unit Price </th>
                               <th class="column-title">% Margin </th>';

                          if($restrict != "Senior Staff"){
    
                                   
                                  }else{
                                     $output .= ' <th class="column-title no-link last"><span class="nobr">Action</span>'  ; 
    
                                    }
                           
                     $output .= '       </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">';
                           
                              
                              
                              





                            if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT * FROM product";
                           
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                                 
                               $output .=  "<td  class='ID' name='ID'  data-id1='". $row["ID"] . "'>" .$row["ID"] . "</td>";
                               $output .=  "<td ".$content . " class='Name' name='Name'  data-id2='". $row["ID"] . "' >" .$row["Name"] . "</td>";  
                               $output .=  "<td   ".$content . " class='CatID' name='CatID'  data-id3='". $row["ID"] . "' >" .$row["CatID"] . "</td>";
                               $output .=  "<td  ".$content . " class='SupID' name='SupID'  data-id4='". $row["ID"] . "' >" .$row["SupID"] . "</td>";
                                   $output .=  "<td ".$content . " class='ForSale' name='ForSale'  data-id5='". $row["ID"] . "'>" .$row["ForSale"] . "</td>";
                                   $output .=  "<td ".$content . " class='Qty_On_Hand' name='Qty_On_Hand'  data-id6='". $row["ID"] . "'>" .$row["Qty_On_Hand"] . "</td>";
                                   $output .=  "<td ".$content . " class='UPrice' name='UPrice'  data-id7='". $row["ID"] . "'>$" .$row["UPrice"] . "</td>";
                                   $output .=  "<td ".$content . " class='Margin' name='Margin'  data-id8='". $row["ID"] . "' >" .$row["Margin"] . " %</td>";
                               
                                  if($restrict != "Senior Staff"){
    
                                   
                                  }else{
                                     $output .= " <td class='last'>  <button class='btn btn-primary' data-ids3='".$row["ID"] . "' name='btn_deletes' id='btn_deletes' >Delete</button>"   ; 
    
                                    }
                                  
                                  
                                  
                                  
                              
                               $output .=  "</tr>";
                              }
                              
                              }
                              







                              
                              
                              
                              
                             
                              
                              
                       
                     $output .= '     </tr>
                          
                         
                        </tbody>
                      </table>
      
                      <script>
                      
                      
                      
                        $(document).ready(function () {	
            
				$("#datatable-buttons tbody").on("click", "tr", function() {
					//get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
               
                    $("#ID").val(tableData[0]);
                    $("#name").val(tableData[1]);
                   $("#catid").val(tableData[2]);
                    $("#supid").val(tableData[3]);
                    $("#forsale").val(tableData[4]);
                    $("#quantity").val(tableData[5]);
                    var td = myTrim(tableData[6]);
                    var tds = myTrim(tableData[7]);
                    $("#uprice").val(td);
                    $("#margin").val(tds);
                    
                    
                    
               });	     
                    
             }); 
                      
                      
                      
                      </script>
           
                      
                   ';
echo $output;
                              ?>