<!DOCTYPE html>
<?php
// Initialize the session
session_start();
 

 

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = "";






$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
























?>
<style>
    
    .modal {
  display: none;
  position: fixed;
  z-index: 1; 
  left: 0;
  top: 0;
 
  overflow: hidden; 
  margin: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px;
        
}
    .center-wrapper{
      
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  text-align: center;
    }
</style>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>X-COM</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
     
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head>
<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa">Log in as: </i>   <?php 
    
    if(isset($_SESSION["Username"])){
   echo htmlspecialchars($_SESSION["Username"]);
                            
                            
    }else{
              echo "   <a href='index.php'> return to home page </a>";
        die("Please Register or log in to access this pages");
           
    }
                            ?></p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                       
                        <li  ><a href="product.php">Product</a></li>
                         <li class="active"><a  href="setting.php" >Setting</a></li> 
                            <li ><a  href="order.php" >Order</a></li>
                       <?php 
                        
                        if(isset($_SESSION["Username"])){
                            
                            
                            
                        }else{
                            
                            
                            echo '<li><a href="#" onclick="switchs()"  >Login</a></li>  ';
                        }
                        
                        
                        ?> 
                        
                                         <div id="id01" class="modal">

 <div class="center-wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
             <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white;">
                <input id="ok" name="ok" type="submit" class="btn btn-primary" value="Submit">
                <button class="btn btn-link" id="cancel" name="cancel">Cancel</button>
            </div>
            <p>Don't have an account? <a onclick="switchs2()" href="register.php" >Sign up now</a>.</p>
        </form>
    </div>    
                      
                      
 
                      
                      
                    </div>
                        
                   
                        <script>
                            
                     
                            function switchs() {
                                
                                 document.getElementById('id01').style.display='block';
  
                                }                     
                              function switchs2() {
                                 document.getElementById('id02').style.display='block';
                               
                               
                                }    
                          
// When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                                if (event.target == modal) {
            modal.style.display = "none";
      
      
      
                                }
                            }




 $(document).ready(function(){  
        
        
      $(document).on('click', '#cancel', function(){  
           
            
            modal.style.display = "block";
     
        
          
           
      });  
      
      
      
    
 }); 









                        
                        
                        </script>
                        
                        
                        
            
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->
    <section id="portfolio">
        <div class="container">
            
        


            <?php
            
            
               if(isset($_POST['oke'])){
        // echo "<script>alert(1);</script>";
            $ID = $_POST['IDs'];
            $name = $_POST['names'];
           


                
                        
                        
                    
          $sql = "UPDATE customer SET Username = ?  WHERE User_ID = ?";
                          
          $stmt = mysqli_prepare($link,$sql);   
                              
                         if($stmt){
                        
                                  
                    mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_ID);
                                  
                    $param_username = $name;
                  
                             
                    $param_ID = $ID;
                      $_SESSION["Username"] =   $name;    
          
                    mysqli_stmt_execute($stmt);
                             
                 
                     
                              }
                   
                   
                     if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE admin SET PASSWORD = ? WHERE ID = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
                   
                   
                   
                 
               }
           ?>
            
            
            
            
            
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                  
                      <div class="center-wrapper">
                      
                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" data-parsley-validate class="form-horizontal form-label-left" method="post">

                      <div class="item form-group">
                        
                        <div class="col-md-6 col-sm-6 ">
                          <input  type="hidden" id="IDs"  name="IDs" required="required" class="form-control" value="<?php echo $_SESSION["User_ID"];  ?>    ">
                        </div>
                      </div>
                      <div class="item form-group">
                       <label>Username</label>

                       
                          <input type="text" id="last-name" style="text-align: center;" name="names" id="names" required="required" value="<?php echo  $_SESSION["Username"];  ?>" class="form-control">
                        
                      </div>
                      <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input  style="text-align: center;"  required=" " type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white; "<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirm Password</label>
                <input style="text-align: center;"   required=" " type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
                      
                      
                    
                      <div class="item form-group">
                      <center>  <div  >
                          <a  class="btn btn-primary" href="logout.php">Logout</a>
					
                          <button type="submit" name="oke" id="oke" class="btn btn-primary" value="oke">Update</button>
                        </div>
                          </center>
                      </div>

                    </form>
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    
                    
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

          
          

              
            </div>
            
            
            
            
            
            
            
            
            
            
            
   
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        
        
        </div>
    </section>
    
     <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Copyright</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Available Product</h3>
                        <ul>
                            <li><a href="#">Smartphone</a></li>
                            <li><a href="#">Tablet</a></li>
                            <li><a href="#">Laptop</a></li>
                            <li><a href="#">Game Console</a></li>
                            <li><a href="#">Computer</a></li>
                        
                        </ul>
                    </div>    
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="#">Find a Store</a></li>
                            <li><a href="#">Location</a></li>     
                        </ul>
                    </div>    
                </div>

             
            </div>
        </div>
    </section>
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    
  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">  
   <script src="vendors/jquery/dist/jquery.min.js"></script>
 
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="build/js/custom.min.js"></script>
      
      
      
   <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
   
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

   
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    
    <script>
        
        
        
        
        
                       
                           $(document).ready(function(){  
        
       
    
    
     
      $(document).on('click', '#order', function(){  
          
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"Order_Del_2.php",  
                     method:"POST",  
                     data:{ID:ID},  
                     dataType:"text",  
                     success:function(data){  
                           RefreshTable();
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });        
                              
         var modal = document.getElementById('id01');
        
        
        
        
        
    </script>
    
</body>
</html>
