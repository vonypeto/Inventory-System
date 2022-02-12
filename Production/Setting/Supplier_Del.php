<?php
require_once "../config.php";




$ID=$_POST['ID'];








          $sql = "DELETE FROM suppliers  WHERE ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "s", $param_ID);
                                  
                    
                 
                             
                    $param_ID = $ID;
                                
                 
                    mysqli_stmt_execute($stmt);
                             
                 echo "Data Deleted";
                
                              }
                                  
                                  

?>