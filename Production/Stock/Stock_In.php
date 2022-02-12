<?php
require_once "../config.php";

$id = $_POST['ID'];
//   $id = 1;
$uprice = '';
$price = '';
$qty = '';
$Product_QTY = '';
$Total_QTY = 0;
if ($link->connect_error)
{
    die("Connection failed: " . $link->connect_error);

}

$sql = "SELECT * FROM newstock WHERE ID = " . $id . "";

$result = $link->query($sql);
if ($result->num_rows == 1)
{
    $row = $result->fetch_assoc();

    $uprice = $row["UPrice"];
    $qty = $row["QTY"];
    //  echo $uprice;
    

    
}

$sqls = "SELECT * FROM product WHERE ID = " . $id . "";

$result = $link->query($sqls);
if ($result->num_rows == 1)
{
    $row = $result->fetch_assoc();

    $price = $row["UPrice"];
    $Product_QTY = $row["Qty_On_Hand"];

}

$Total_QTY = $Product_QTY + $qty;

$sq = "UPDATE product SET UPrice = ?, Qty_On_Hand = ?  WHERE ID = ?";

$stmt = mysqli_prepare($link, $sq);

if ($stmt)
{

    mysqli_stmt_bind_param($stmt, "sss", $param_uprice, $Qty_On_Hand, $param_ID);

    $tmp = 0;

    if ($price < $uprice)
    {
        $param_uprice = $uprice;

    }
    else
    {

        $param_uprice = $price;

    }

    $Qty_On_Hand = $Total_QTY;
    $param_ID = $id;

    mysqli_stmt_execute($stmt);

}

$sqlss = "DELETE FROM newstock  WHERE ID = ?";

$stmt = mysqli_prepare($link, $sqlss);

if ($stmt)
{

    mysqli_stmt_bind_param($stmt, "s", $param_ID);

    $param_ID = $id;

    mysqli_stmt_execute($stmt);

 

}

//  $sql1 = "SELECT";



?>
