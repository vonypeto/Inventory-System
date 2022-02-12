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
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
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
                        <div class="top-number"><p><i class="fa">Log in as: </i>  
                            
                            
                            <?php 
    
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                       
                        <li  class="active"><a href="product.php">Product</a></li>
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
                            
                   var modal = document.getElementById('id01');


window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
                            function switchs() {
                                
                                 document.getElementById('id01').style.display='block';
  
                                }                     
                              function switchs2() {
                                 document.getElementById('id02').style.display='block';
                               
                               
                                }    
                          















                        
                        
                        </script>
                        
                        
                        
            
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->
    <section id="portfolio">
        <div class="container">
            
        

            <ul class="portfolio-filter text-center">
                <li><a class="btn btn-default active" href="#" data-filter="*">Product Sales</a></li>
                
            </ul><!--/#portfolio-filter-->

            
            
            
            
            
            
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive" id="live_data">
                    
                
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
    
    

    
    
    <div id="id02" class="modal">
 <div class="center-wrapper">
<form class="form-label-left input_mask" action="order.php" method="post">

                     

                     
                      <div class="form-group row">
                       
                        <div class="col-md-9 col-sm-9 ">
                          <input type="hidden" class="form-control"   name="ID" id="ID">
                        </div>
                      </div>
                          
                          
                          <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Name :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control"  placeholder="Name" name="name" id="name" required= " ">
                            <input type="hidden" class="form-control"  placeholder="price" name="price" id="price" required= " ">
                        </div>
                      </div>
                          
                          
 
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Quantity to Buy:</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number" class="form-control" value="0" placeholder="Quantity" name="quantity" id="quantity" required= " ">
                        </div>
                      </div>
                     
  
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">VAT :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input disabled type="text" value="12"  class="form-control" value="12 \%"   name="vat" id="vat"  required= " ">
                        </div>
                      </div>
                          
                          
                          
                          
                          
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                          

                          <a  class="btn btn-primary" onclick="document.getElementById('id02').style.display='none'"  id="Submit" name="Submit">Add to cart</a>
                             <a  class="btn btn-primary" onclick="document.getElementById('id02').style.display='none'" >Cancel</a>
                        </div>
                      </div>

                    </form>         
                      
        </div>
                      
                      
                    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <input type="hidden" id="hdnSession" data-value="<?php 
                                                     
                                                     if(isset($_SESSION["User_ID"])){
                                                         
                                                         echo 1;
                                                         
                                                     }else{
                                                         echo 0;
                                                         
                                                     }
                                                     
                                                     
                                                     
                                                    ?> "/>

    
    
    
    
    
    
    
    <script>
        var global_qty = 0 ;
        
                        var modals = document.getElementById('id02');


window.onclick = function(event) {
  if (event.target == modals) {
    modals.style.display = "none";
  }
}

        
        
                       
        $(document).ready(function(){  
        
       
    
    
            
            
            $(document).on('click', '#Submit', function(){  
      //   alert(document.getElementById('name').value);
   //             alert(document.getElementById('quantity').value);
  //          alert(document.getElementById('vat').value);
                
                
             
            
      });  
            
            
            
            
            
            $(document).on('click', '#Submit', function(){  
           var name = document.getElementById('name').value;
                var ID = document.getElementById('ID').value;
           var quantity = document.getElementById('quantity').value;
            var vat = document.getElementById('vat').value;
                var price = document.getElementById('price').value;
               
        var submit = "";
          
       if(global_qty >= quantity && quantity > 0){
          
           $.ajax({  
                url:"product_add.php",  
                method:"POST",  
                data:{ID:ID,name:name,quantity:quantity,vat:vat,price:price,submit},  
                dataType:"text",  
                success:function(data)  
                {  
                    alert(data);
                     fetch_data();  
                }  
           })  
       }else{
           
           
           alert("Cannot Exceed the Quantity of the Original Quantity or Cannot get low to negative value");
           
           
       }
                
                
                
                
      });  
            
            
            
            
            
            
            
            
            
            
            
            
            
     
      $(document).on('click', '#order', function(){  
          
           var ID=$(this).data("ids3");  
            var name=$(this).data("id1");
          var sale=$(this).data("id2");
           var listsale =$(this).data("id22");
            var sessionValue= $("#hdnSession").data('value');
          global_qty = $(this).data("id9");
      
          if(sessionValue){
              
              if(sale){
                  
                  
             
               var modal = document.getElementById('id02'); 
            modal.style.display="block";
              document.getElementById("ID").value = ID;
                document.getElementById("name").value = name;
              
                  document.getElementById("price").value = listsale;
                  
                  
                  
                  
              }else
                  alert("Not For Sale");
                  
                  
                  
               
              
              
              
              
             
             }else{
                 
                 alert("Please Login to Order");
                 
             }
             
            
      });  
 });        
                              
       
        
        
        
        
        
        
        
          $(document).ready(function(){  
        
         function fetch_data()  
      {  
           $.ajax({  
                url:"product_sel.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
        
     fetch_data() ;
   
 });  
        
        
        
        
        
        
        
        
        
        
        
    </script>
    
</body>
</html>
