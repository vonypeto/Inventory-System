<?php
require_once "config.php";
session_start();

if(isset($_POST["submit"])){
    
        $customer = $_SESSION["User_ID"];
        $id = trim($_POST["ID"]);
        $name =  trim($_POST["name"]);
        $quantity = trim($_POST["quantity"]);
        $vat = trim($_POST["vat"]);
        $price = trim($_POST["price"]);
        $vat = ($vat /100) ;
        $price = round($price *(1+$vat),2); 
        
        $old_qty=0;
    
    
    $sql = "SELECT * FROM orders WHERE ID = " . $id . " AND customer_id = ". $customer ."";

$result = $link->query($sql);
if ($result->num_rows == 1)
{
    $result = mysqli_query($link,"SELECT * FROM orders WHERE ID = " . $id . " AND customer_id = ". $customer ."");
$row = mysqli_fetch_assoc($result);
    $old_qty =  $row['QTY'];
    $quantity += $old_qty;
    
    
    
     $sql = "UPDATE `orders` SET `QTY`= ? WHERE ID = ? and customer_id = ?";
                          
                          if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "sss", $param_qty,$param_IDS,$param_customer_id);
            
                               
                                
                              
                               $param_IDS = $id;
                               $param_qty = $quantity;
                              
                               $param_customer_id = $customer;
                               echo "Add to cart successful";
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    
    
    
}else{
    
    
    
    $sql = "INSERT INTO `orders`(`ID`, `QTY`, `ListPrice`, `customer_id`) VALUES (?,?,?,?)";
                          
                          if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ssss", $param_IDS,$param_qty,$param_price,$param_customer_id);
            
                               
                                
                              
                               $param_IDS = $id;
                               $param_qty = $quantity;
                               $param_price = round($price, 2);
                               $param_customer_id = $customer;
                               echo "Add to cart successful";
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
    
    
    
    
    
    
    
    
    
    
}else{
    
    echo "Log in to Order";
    
}

?>