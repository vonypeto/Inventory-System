<?php
require_once "../config.php";

$id = $_POST['ID'];
//  $id = 2;
  $product_uprice = 0;
  $product_qty = 0;
  $product_margin = 0;
  $check = "no data found";

  $sale_listprice = 0;
  $sale_qty = 0;
  $vat = 0;;
  
if ($link->connect_error)
{
    die("Connection failed: " . $link->connect_error);

}

$sql = "SELECT * FROM product WHERE ID = " . $id . "";
// PRODUCT
$result = $link->query($sql);
if ($result->num_rows == 1)
{
    $row = $result->fetch_assoc();

    $product_uprice = $row["UPrice"];
    $product_qty = $row["Qty_On_Hand"];
    $product_margin = $row["Margin"];
    $product_margin = ($product_margin /100) * $product_uprice;
    $product_uprice += $product_margin;
  
    
     
    
    
    
}


$sql = "SELECT * FROM sales WHERE ID = " . $id . "";

$result = $link->query($sql);
if ($result->num_rows == 1)
{
   // $row = $result->fetch_assoc();
   // $sale_listprice = $row["ListPrice"];
   // $sale_qty = $row["QTY"];
   // $vat = $row["VAT"];
   // echo $vat;
    
    
    
    
    $sql = "UPDATE sales SET ListPrice = ? , QTY = ? WHERE ID = ?";

        if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "sss", $param_price,$param_qty,$param_ID);
                          
                                $param_ID  = $id;
                                $param_qty = $product_qty;
                                $param_price =  $product_uprice; 
                              
                              if(mysqli_stmt_execute($stmt)){
                             
                              } else{
                                  
                                  echo "Something went wrong. Please try again later.";
                              }

           
                            mysqli_stmt_close($stmt);
                }
        
        }else{
    
   // $sql = "UPDATE sales SET ListPrice = ? , QTY = ? WHERE ID = ?";
    $sql = "INSERT INTO sales(`ID`, `ListPrice`, `QTY`, `VAT`) VALUES (?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ssss", $param_ID, $param_price,$param_qty,$param_vat);
                                $vat = 12;
                                $param_ID  = $id;
                                $param_qty = $product_qty;
                                $param_price =  $product_uprice; 
                                $param_vat = $vat;
            
            
                              
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                                  
                                  echo "Something went wrong. Please try again later.";
                              }

            // Close statement
                            mysqli_stmt_close($stmt);
                }
    
    }


//  $sql1 = "SELECT";



?>
