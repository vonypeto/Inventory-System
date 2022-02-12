<?php
require_once "../config.php";




$ID=$_POST['ID'];





        echo "Data Deleted";


          $sql = "DELETE FROM product  WHERE ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "s", $param_ID);
                                  
                    
                 
                             
                    $param_ID = $ID;
                                
                 
                    mysqli_stmt_execute($stmt);
                             
               
                
                              }

            

              $sql = "DELETE FROM sales  WHERE ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "s", $param_ID);
                                  
                    
                 
                             
                    $param_ID = $ID;
                                
                 
                    mysqli_stmt_execute($stmt);
                             
                 
                
                              }
               
                                  
                                  

?>