<!DOCTYPE html>

<?php
require_once "../config.php";
session_start();

if($_SESSION["oauth"] != "System Admin"){
    
    
    die("Wrong Credential");
}






$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["resetpass"])){
 
    // Validate new password
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
                header("location: ../log.php");
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INTERPOLE</title>
         <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
      
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  
   <script src="../vendors/jquery/dist/jquery.min.js"></script>
 
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   
   
 

 
  
    <script src="../build/js/custom.min.js"></script>
      
      
      
         <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
   
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

   
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-flask"></i> <span>INTERPOLE</span></a>
            </div>
            <div class="clearfix"></div>  
            <div class="profile clearfix">
              <div class="profile_info" style="width: 170px;">
                  <span><b ><?php echo htmlspecialchars($_SESSION["oauth"]); ?> : </b> <?php echo htmlspecialchars($_SESSION["username"]); ?> </span>
                
                  
                  
                  
              </div>
              <div class="clearfix"></div>
            </div>
            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class="active-sm"><a href="" ><i class="fa fa-home"></i>Maintenance<span ></span></a>
                   
                  </li>
                
                
                 
                 
                </ul>
              </div>
            

            </div>

          </div>
        </div>

        <!-- top navigation -->
              <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false" style="margin-right: 10px;">
                    <?php echo htmlspecialchars($_SESSION["username"]); ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" onclick="document.getElementById('id01').style.display='block'"  href="javascript:;"> Reset Password</a>
                     
                      <a class="dropdown-item"  href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  <div id="id01" class="modal">

 <div class="center-wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="../Reset_Pass.php" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white; "<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white;">
                <input type="submit" class="btn btn-primary" name="resetpass" value="Submit">
                <a class="btn btn-link" href="Maintenance.php">Cancel</a>
            </div>
        </form>
    </div>    
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                    </div>
       
                </ul>
              </nav>
            </div>
          </div>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Maintenance</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                 
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel" >
                  <div class="x_title" >
                    <h2>User Authentication Management</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                     
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    
                      <div class="row" style=" margin-bottom: 15px; padding-left: 15px;  ">
                         
                    
                      
                       
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          <form class="form-inline" action="update.php" method="post">
                
                              <div class="form-group" style="padding-right: 15px" >
                    <label for="ex3" class="col-form-label">ID : </label>
                    <input type="text" id="ID"  class="form-control" name="ID" required=" " readonly>
                  </div>
                              
                              <div class="form-group" style="padding-right: 15px">
                    <label for="ex3" class="col-form-label">Username : </label>
                    <input type="text" id="user"  class="form-control" name="user" required=" ">
                  </div>
                  <div class="form-group" style="padding-right: 15px">
                    <label for="ex4" class="col-form-label">New Password:</label>
                     <input type="password" id="pass" required = " " class="form-control " name="pass" >
                  </div>
                              
                    <div class="form-group" style="padding-right: 15px">
                    <label for="ex4" class="col-form-label">Oauth:</label>
                    
                        
                        
                        
                        
                        
                        
                        
                        <select class="form-control" id="oauth" class="form-control " name="oauth" >
                            <option value="Senior Staff">Senior Staff</option>
                            <option  value="System Admin">System Admin</option>
                            <option  value="Encoder">Encoder</option>
                         
                          </select>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                  </div>
                              <br>
                 <div class="col-md-right" style="padding-top: 15px">
                   <button type="submit" class="btn btn-success" name="Submit">Submit</button>
                               <button class="btn btn-primary"  name="Delete">Delete</button>
                        </div>
                     </form>
                          
                          
                          
                          
                          
                      
                      
                      
                      
                      </div>
                      <div class="row">
                      
                        <div class="table">
                      <table id="datatable"  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                            <th class="column-title">ID </th>
                            <th class="column-title">USERNAME </th>
                            <th class="column-title">OAUTH </th>
                            <th class="column-title">PASSWORD </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">
                           <?php
                              
                              if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT * FROM admin";
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                              echo "<td class=\" \" >" .$row["ID"] . "</td>";
                              echo "<td class=\" \" >" .$row["USERNAME"] . "</td>";  
                              echo "<td class=\" \" >" .$row["OAUTH"] . "</td>";
                              echo "<td class=\" \" >" .$row["PASSWORD"] . "</td>";
                              echo " <td class='last'><a href='#'>Select</a>"   ;
                              echo "</tr>";
                              }
                              
                              }
                              
                              ?>
                              
                             
                              
                       
                          </tr>
                          
                         
                        </tbody>
                      </table>
                    </div>
                      
                      
                      
                      
                      
                      
                      
                      
                      </div>
                      
                      
                  
               
                      
                      
                      
                      
                  
                    
                      
                      
                      
                      
                      
                      
                      
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                  </div>
                </div>
              </div>
                
        
                
                
            </div>
             
              
              
              
              
              
              <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create User </h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                      <?php
             $username = $password = $confirm_password = "";
                $username_err = $password_err = $confirm_password_err = "";
                $ouath ;
                
            if(isset($_POST['SUBMIT_1'])){
                
          //      echo "<script>alert(1)</script>";
                
                
                 $ouath = trim($_POST["ouath"]);
                
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT ID FROM admin WHERE USERNAME = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
      
        // Prepare an insert statement
        $sql = "INSERT INTO admin (USERNAME,PASSWORD, OAUTH) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username,$param_password,$param_ouath);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_ouath = $ouath;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "<meta http-equiv='refresh' content='1'>";// Redirect to login page
                
                
                
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
               
        }
    }
    
    // Close connection
    mysqli_close($link);
               
            }
            
            
            ?>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                   
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                       <form  id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="item form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Username: </label>
                  <div class="col-md-6 col-sm-6 ">
                <input type="text" name="username" class="form-control" required= " " value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
                </div>
            </div>    
            <div class="item form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Password</label>
                  <div class="col-md-6 col-sm-6 ">
                <input type="password" name="password" class="form-control" required= " "  value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
                </div>
            </div>
            <div class="item form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Confirm Password</label>
                  <div class="col-md-6 col-sm-6 ">
                <input type="password" name="confirm_password"  required= " " class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
            </div>
            <div class="item form-group">
                 
            
                      
                      
                      
                       <label for="ouath" class="col-form-label col-md-3 col-sm-3 label-align">Oauth :</label>
                         <div class="col-md-6 col-sm-6 ">
                        <select name="ouath" id="ouath" class="form-control"  name="ouath" id="Staff">
                            <option name="ouath" value="Senior Staff">Senior Staff</option>
                            <option name="ouath" value="Encoder">Encoder</option>
                            <option name="ouath" value="System Admin">System Admin</option>
                           
                        </select>
                      </div>
                      
                      
                      
                      
                      
           
              
            </div>
           <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                      <center>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name="SUBMIT_1">Submit</button>
                          </center>
                        </div>
                      </div>
        </form>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                  </div>
                </div>
              </div>
            </div>

              
           
              
              
              
              
              
              
              
              
              
              
              
          </div>
        </div>
        <footer>
          <div class="clearfix"></div>
        </footer>
      </div>
  

                          <script>
var modal = document.getElementById('id01');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
          
       $(document).ready(function () {	
                //=================================================================
                //click on table body
				//$("#tableMain tbody tr").click(function () {
         //  $("#username").val("");
				$('#datatable tbody').on('click', 'tr', function() {
					//get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
                //    var td=tableData[0] +  '*' +  tableData[1] + '*' + tableData[2] + '*' +  tableData[3] + '*' + tableData[4];
                    $("#user").val(tableData[1]);
                    $("#oauth").val(tableData[2]);
                   var tds = $("#ID").val(tableData[0]);
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    var tables = [
    document.getElementById(tds),
  
];

document.getElementById('oauth').onchange = function() {
    // hide all tables
    for (var i in tables) {
        tables[i].style.display = "none";
    }
    // get selected value and show it's table
    var selectedValue = this[this.selectedIndex].value;
    if (selectedValue) {
        document.getElementById(selectedValue).style.display = "block";
    }
};
                    
                    
                    
                    
                    
                    
                    
                    
                 //   alert(td);
				});
				
				$("#thebutton").click(function () {
					$('#tableMain > tbody').append('<tr class="datarow"><td>11111</td><td>22222</td><td>33333</td><td>44444</td><td>55555</td></tr>')
				})
			});	

                    </script>  
  </body>
</html>
