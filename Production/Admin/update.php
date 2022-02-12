<?php
                      
require_once "../config.php";
session_start();






                          if($link->connect_error){
                              
                              die("Connection failed". $link-connect_error);
                          }
                          
                          
                          if(isset($_POST['Submit'])){
                              
                              $oauth = trim($_POST["oauth"]);
                               $user = trim($_POST["user"]);
                               $pass = trim($_POST["pass"]);
                              $ID = trim($_POST["ID"]);
                          
                              if($pass == ""){
                                  
                                  
                                  
                                  
                                  
                                  $sql = "UPDATE admin SET USERNAME = ? , OAUTH = ?  WHERE ID = ?";
                          
                          $stmt = mysqli_prepare($link,$sql);   
                              
                              if($stmt){
                              //      mysqli_stmt_bind_result($stmt, $param_username,$param_oauth,$hashed_password);
                                  
                                  mysqli_stmt_bind_param($stmt, "sss", $param_username,$param_oauth,$param_ID);
                                  
                                  $param_username = $user;
                                  $param_oauth = $oauth;
                             
                                  $param_ID = $ID;
                                
                                   $stmt->execute();
                                  
                                  mysqli_stmt_execute($stmt);
                                  header("Location: index.php");
                              }
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                              }else{
                                  
                                  
                                  
                                  
                                  
                                  
                                  $sql = "UPDATE admin SET USERNAME = ? , OAUTH = ? , PASSWORD = ? WHERE ID = ?";
                          
                          $stmt = mysqli_prepare($link,$sql);   
                              
                              if($stmt){
                              //      mysqli_stmt_bind_result($stmt, $param_username,$param_oauth,$hashed_password);
                                  
                                  mysqli_stmt_bind_param($stmt, "ssss", $param_username,$param_oauth,$param_pass,$param_ID);
                                  
                                  $param_username = $user;
                                  $param_oauth = $oauth;
                                  $param_pass = password_hash($pass, PASSWORD_DEFAULT);
                                  $param_ID = $ID;
                                
                                   $stmt->execute();
                                  
                                  mysqli_stmt_execute($stmt);
                                  header("Location: index.php");
                              }
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                              }
                          
                         
                          }else if(isset($_POST['Delete'])){
                              
                           
                              $ID = trim($_POST["ID"]);
                              
                               $sql = "DELETE FROM admin WHERE ID = ?";
                               $stmt = mysqli_prepare($link,$sql);   
                              mysqli_stmt_bind_param($stmt, "s", $param_ID);
                              $param_ID = $ID;
                                $stmt->execute();
                                  
                                  mysqli_stmt_execute($stmt);
                                  header("Location: index.php");
                          }

 
             
            
       







                          
                          ?>
                          
                          
                          