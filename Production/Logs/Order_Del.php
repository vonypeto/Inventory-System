<?php
require_once "../config.php";




//$ID=$_POST['IDs'];




        if(isset($_POST['clear'])){

            

          $sql = "DELETE FROM orders  ";
                          
          $stmt = mysqli_prepare($link,$sql);   
                         
                    mysqli_stmt_execute($stmt);
                             
                 echo "Data Deleted";
                
                              }
        
                                  
                                  

?>