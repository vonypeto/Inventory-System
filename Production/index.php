<!DOCTYPE html>
<?php
require_once "config.php";
//error_reporting(0);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Maintenance.php");
   exit;
}
    ob_start();
   session_start();

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    
     if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    
     if(empty($username_err) && empty($password_err)){
       
    
    $sql = "SELECT ID, USERNAME, PASSWORD , OAUTH FROM admin  WHERE USERNAME = ?";
    $stmt = mysqli_prepare($link,$sql);    
        
        if($stmt){
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              $param_username = $username; 
                 
             if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                 
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                   mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password,$oauth);
                
                        
                        
                        
                      if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                          
                          
                            
                          
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["oauth"] = $oauth;    
                       
                            if($oauth == "System Admin"){
                                 header("location: Admin/");
                                
                            }else  if($oauth == "Senior Staff" || $oauth == "Encoder"){
                                 header("location: Product/");
                                
                            }
                            
                           
                        } else{
                           
                            $password_err = "The password you entered was not valid.";
                        }
                    }    
                        
                        
                        
                        
                        
                } else{
                    
                    $username_err = "No account found with that username.";
                }
                 
                 
                 
                 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }     
            
            
                 
             }
         
         
         
         mysqli_stmt_close($stmt);
            
            
            
        }    
                
                
 }
    
    
     
    










?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INTERPOLE</title>
 <link rel="shortcut icon" href="images/ico/favicon.ico">
 
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  
   
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <br>
              <br>
              <br>
              <br>
             
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <h1>Login Form</h1>
              <div   class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" >
                <input type="text" class="form-control" placeholder="Username"  name="username" id="username" />
                     <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" class="form-control" placeholder="Password"   id="password" name = "password" />
                  <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div>
                <input class="btn btn-info" type="Submit" value="Login in" style="
    margin-left: 125px;">
                
                  
              
              </div>
                  <div>
                       
                </div>
              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-flask"></i> INTERPOLE STATE INC.</h1>
                 
                </div>
              </div>
            </form>
              

              
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div    >
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-info" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  
                  <p>©2016 All Rights Reserved.  Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

  
