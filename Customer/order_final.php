<?php
require_once "config.php";
session_start();

if(isset($_POST["ID"])){
    
        $customer = $_SESSION["User_ID"];
        $id =  trim($_POST["ID"]);
        $newqty = trim($_POST["qty"]);
        $old_qty = 0;
     
   

    
    
    
    
    
    $result = mysqli_query($link,"SELECT * FROM sales WHERE ID = " . $id . "");
    $row = mysqli_fetch_assoc($result);
    $old_qty =  $row['QTY'];
   
    $result = mysqli_query($link,"SELECT * FROM product WHERE ID = " . $id . "");
    $row = mysqli_fetch_assoc($result);
    $old_qtys =  $row['Qty_On_Hand'];
    
    
    
    if($newqty > $old_qty){
        
        
        
        echo "The current quantity of the product  exceed the limited quantity";
        
        
        
        
    }else{
            // echo "The current quantity of the product  exceed the limited quantity";
        
        
         $old_qtys -= $newqty;
          $sql = "UPDATE product SET Qty_On_Hand = ? WHERE ID = ?";
        
       
       
        if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ss", $param_qty,$param_IDS);
            
                               
                                
                              
                               $param_IDS = $id;
                               $param_qty = $old_qtys;
                             
                           //    echo "Add to cart successful";
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } 
        
         $old_qty -= $newqty;
        
        
        $sql = "UPDATE sales SET QTY = ? WHERE ID = ?";
        
        
       
        if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ss", $param_qty,$param_IDS);
            
                               
                                
                              
                               $param_IDS = $id;
                               $param_qty = $old_qty;
                             
                           //    echo "Add to cart successful";
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } 
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
           $sql = "DELETE FROM orders WHERE ID = ? AND customer_id = ?";
        
        $old_qty -= $newqty;
       
        if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ss",$param_IDS,$param_custom);
            
                               
                                
                              
                               $param_IDS = $id;
                               $param_custom = $customer;
                             
                           //    echo "Add to cart successful";
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } 
        
        
        
        
        
    }
    
    
    
    
    
    
    
    
 echo "Sending Order";
                          
                         
    
    
    
    
    
    
}   else{    
   
    
}

?>