<?php
                           
require_once "../config.php";
session_start();
if(isset($_SESSION["oauth"])){
$restrict = $_SESSION["oauth"];

if($restrict != "Senior Staff"){
    
    $content = "";
}else{
  $content = "contenteditable";  
    
}
}
$output = '';
    $output = '  
                      <table id="datatable"  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                            <th class="column-title">ID </th>
                            <th class="column-title">Name </th>
                            
                          
                       
                              
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody >
                          <tr class="even pointer">';
                           
                              
                              
                              
                              
                                if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT * FROM suppliers";
                           
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                                 
                                $output .=   "<td   class='IDS' name='IDS'  data-ids1='". $row["ID"] . "'>" .$row["ID"] . "</td>";
                                $output .=  "<td contenteditable class='Names' name='Names'  data-ids2='". $row["ID"] . "' >" .$row["NAME"] . "</td>";  
                             
                             
                                    if($restrict != "Senior Staff"){
                                        $output .= ' <td class="last">  <button class="btn btn-primary" onclick=javascript:alert("Insufficient_Privilege") >Delete</button>'  ; 
                                
                             }else{
                                  $output .= " <td class='last'>  <button class='btn btn-primary' data-ids3='".$row["ID"] . "' name='btn_deletes' id='btn_deletes' >Delete</button>"   ; 
    
                             }
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                               
                                   
                                 
                                  
                               $output .= "</tr>";
                              }
                              
                              }
                              
                              
                              
                              
                              
                             
                              
                              
                       
                     $output .= '     </tr>
                            <tr>
                              <td id="ID" value="999" style="opacity: 0;">999999</td>
                                 <td id="Names" name="Names" required  contenteditable></td>
                                <td><button type="button" name="btn_adds" id="btn_adds" class="btn btn-xs btn-success">+</button></td>  

                          </tr>
                         
                        </tbody>
                      </table>
                   ';
echo $output;
                              ?>