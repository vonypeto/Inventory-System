<?php
require_once "../config.php";









        if(isset($_POST['ID'])){
            $ID=$_POST['ID'];
            

        
                          
          $sql = "DELETE FROM arcstock ";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                  
                                
                 
                    mysqli_stmt_execute($stmt);
                             
                 echo "Data Deleted";
                            
                
                              }
                
                              }
        
                                  
                                  

?>