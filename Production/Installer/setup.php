<?php



                 
 define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'phpmyadmin');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
                         

                         $sql = "SELECT SCHEMA_NAME
                         FROM INFORMATION_SCHEMA.SCHEMATA
                         WHERE SCHEMA_NAME = 'inventory_system'";

    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    if(isset($row['SCHEMA_NAME'])){
          echo "Database already exist";
        echo "<br>";
          echo "If this is your first time installing and a Database already exist, delete the  database(<i>inventory_system</i>) from the phpmyadmin panel and rerun this setup again ";
      //  $sql = "drop DATABASE inventory_system ";
       // if($stmt = mysqli_prepare($link, $sql)){                          
       //                       if(mysqli_stmt_execute($stmt)){
        //                      } else{      
        //                          echo "Something went wrong. Please try again later.";
          //                    }
           //                 mysqli_stmt_close($stmt);
         //       }
    }else{
        
        
        
        
           $sql = "create DATABASE inventory_system ";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        $DB_NAME_1 = "inventory_system";
            $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, $DB_NAME_1);
        
        $sql = "create table ADMIN(ID INT AUTO_INCREMENT NOT NULL,USERNAME VARCHAR(255),OAUTH VARCHAR(255),PASSWORD VARCHAR(255),PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
    $sql = " CREATE TABLE arcstock(ID INT NOT NULL AUTO_INCREMENT,Name varchar(255),QTY INT(255),UPrice double,dates varchar(255),PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
        
        
        
$sql = " Create table category(ID INT AUTO_INCREMENT NOT NULL,
                     NAME VARCHAR(255),PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }

        
       
        
        $sql = " create table customer(User_ID int not null AUTO_INCREMENT,Username varchar(255),passwords varchar(255),PRIMARY KEY(User_ID))";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
           
        $sql = "create table newstock(ID INT,QTY INT(255),UPrice double,PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
          $sql = "CREATE table orders(ID int ,QTY int(255),ListPrice double,customer_id int(255));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
          $sql = "create table product(ID INT AUTO_INCREMENT NOT NULL,
                    Name VARCHAR(255),
                    CatID int(255),
                    SupID int(255),
                    ForSale int(255),
                    Qty_On_Hand int(255),
                    UPrice double,
                    Margin int(255),PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
          $sql = "CREATE table sales(ID int ,ListPrice double,QTY int(255),VAT DOUBLE);";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
           $sql = "CREATE TABLE SUPPLIERS(ID INT AUTO_INCREMENT NOT NULL, NAME VARCHAR(255),PRIMARY KEY(ID));";
        if($stmt = mysqli_prepare($link, $sql)){                          
                              if(mysqli_stmt_execute($stmt)){
                                    echo "Installation Successful, delete this file after installating";
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
        
        
        
        
        $password = 'password';
     
        
          $sql = "INSERT INTO admin (USERNAME,PASSWORD, OAUTH) VALUES ('admin', ?, 'System Admin')";
        if($stmt = mysqli_prepare($link, $sql)){   
             mysqli_stmt_bind_param($stmt, "s", $param_pass);
                          
                                $param_pass  = password_hash($password, PASSWORD_DEFAULT);
                              if(mysqli_stmt_execute($stmt)){
                                  
                                
                              } else{      
                                  echo "Something went wrong. Please try again later.";
                              }
                            mysqli_stmt_close($stmt);
                }
        
        
    }
    
                          
                  
?>