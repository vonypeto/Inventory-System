<?php
require_once "../config.php";




$ID= $_POST['ID'];
$name= $_POST['Name'];





          $sql = "UPDATE suppliers SET NAME = ?  WHERE ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_ID);
                                  
                    $param_username = $name;
                  
                             
                    $param_ID = $ID;
                                
                   
                    mysqli_stmt_execute($stmt);
                             
                 
                     
                              }
                                  
                                  

?>