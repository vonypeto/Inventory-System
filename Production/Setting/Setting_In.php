<?php
require_once "../config.php";






$name=$_POST['Name'];






          $sql = "INSERT INTO category(NAME)VALUES(?)";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                                  
                    $param_username = $name;
                  
                             
           
                                
                    
                    mysqli_stmt_execute($stmt);
                             
          
                   
                              }
                                  
                                  

?>