<?php
require_once "../config.php";









        if(isset($_POST['ID'])){
            $ID=$_POST['ID'];
            

        
                          
          $sql = "DELETE FROM sales  WHERE ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "s", $param_ID);
                                  
                    
                 
                             
                    $param_ID = $ID;
                                
                 
                    mysqli_stmt_execute($stmt);
                             
                 echo "Data Deleted";
                            
                
                              }
                
                              }
        
                                  
                                  

?>