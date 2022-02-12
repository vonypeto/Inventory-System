<?php
                           
require_once "../config.php";

$output = '';
    $output = '       
                     <table id="datatable-buttons"  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                    
                            <th class="column-title">ID </th>
                            <th class="column-title">Quantity </th>
                            <th class="column-title">Unit Price </th>
                          
                       
                              
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
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
                              $sql = "SELECT * FROM newstock";
                           
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                                 
                                $output .=   "<td  value=".$row["ID"] ." id='ID' class='IDS' name='IDS'  data-id1='". $row["ID"] . "'>" .$row["ID"] . "</td>";
                                $output .=  "<td value=" .$row["QTY"] ." id='QTY' contenteditable class='QTY' name='QTY'  data-id2='". $row["ID"] . "' >" .$row["QTY"] . "</td>";  
                             $output .=  "<td       value=" .$row["UPrice"] ."      contenteditable id='UPrice' class='UPrice' name='UPrice'  data-id3='". $row["ID"] . "' >" .$row["UPrice"] . "</td>";  
                             
                               
                               $output .= " <td class='last'>  <button class='btn btn-primary' data-ids3='".$row["ID"] . "' name='btn_deletes' id='btn_deletes' >Delete</button>"   ;       
                                 
                                  
                               $output .= "</tr>";
                              }
                              
                              }
                        
                              
                              
                          
                             
                              
                                        
                       
                     $output .= '    </tr>
                          
                         
                        </tbody>
                      </table>
                      
       
   
 


   

                      
                
                      
                   ';
                echo $output;
                              ?>