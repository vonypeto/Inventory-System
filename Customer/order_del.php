<?php
require_once "config.php";

session_start();







    if(isset($_POST["ID"])){
        $ID=$_POST['ID'];
        $customer = $_SESSION["User_ID"];
        echo "Data Deleted";


          $sql = "DELETE FROM orders  WHERE ID = ? AND customer_id = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "ss", $param_ID,$param_customer);
                                  
                    
                 
                    $param_customer =    $customer;      
                    $param_ID = $ID;
                                
                 
                    mysqli_stmt_execute($stmt);
                             
               
                
                              }

            

        
    }
                                  
                                  

?>