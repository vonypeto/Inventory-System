<?php
require_once "../config.php";


        $id = trim($_POST["ID"]);
         $name =  trim($_POST["Name"]);
                         $column = trim($_POST["column_name"]);
                 
                         
                         

                         $sql = "UPDATE newstock SET " .$column. "  = ? WHERE ID = ?";
                          
                          if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "ss", $param_name,$param_IDS);
            
                               
                                
                              
                               $param_name = $name;
                                $param_IDS = $id;
                               
                              if(mysqli_stmt_execute($stmt)){
                           
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

?>