<!DOCTYPE html>

<?php
// Initialize the session
session_start();
 

 

require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
   if(isset($_POST['ok'])){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT User_ID, Username, passwords FROM customer WHERE Username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["User_ID"] = $id;
                            $_SESSION["Username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: product.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo "<script>alert('Wrong Password')</script>";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                        echo "<script>alert('Wrong Password')</script>";
                }
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
   
    <title>INTERPOLE STATE</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/ico/favicon.ico">
  
<body class="homepage">
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                       <div class="top-number"><p><i class="fa">Log in as: </i>   <?php 
    
    if(isset($_SESSION["Username"])){
   echo htmlspecialchars($_SESSION["Username"]);
                            
                            
    }else{
             echo "Guest";               
               
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" ></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                    
                       <li ><a href="product.php">Product</a></li>
                         <li><a  href="setting.php" >Setting</a></li> 
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
            </div>
        </nav>
		
    </header>

    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
               
            </ol>
            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/bg23.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1" style="font-size:50px;">We Offer Phones, Tablets, and Gadgets.</h1>
                                    <h2 class="animation animated-item-2">Fast and Efficient Delivery.</h2>
                                    <a class="btn-slide animation animated-item-3" href="product.php">Product</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                              
                            </div>

                        </div>
                    </div>
                </div>

                

                
            </div>
        </div>
    
    </section>

   


    


   

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h2>If any question from the customer?</h2>
                            <p>We provide 24/7 Customer service with good quality staff employment, we assure that you can get the best result from our Establishment just contact +63956 302 5521</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

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
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="#">Find a Store</a></li>
                            <li><a href="#">Location</a></li>     
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

             
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
    
</body>
</html>