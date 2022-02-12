<!DOCTYPE html>

<?php
require_once "config.php";
session_start();

if($_SESSION["oauth"] != "Senior Staff"){
    
    
    die("Wrong Credential");
}





$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['sub'])){
 
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
                header("location: log.php");
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
 
  </head>

     
    
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-flask"></i> <span>INTERPOLE</span></a>
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
                  <li ><a href="Product/" ><i class="fa fa-bar-chart-o"></i>Product<span ></span></a>
                   
                  </li>
                
                 <li ><a href="Stock.php" ><i class="fa fa-line-chart"></i>Stock<span ></span></a>
                   
                  </li>
                    <li><a href="Logs/" ><i class="fa fa-area-chart"></i>Order/Sales<span ></span></a>
                   
                  </li>
                    
                    
                  <li ><a href="Setting/" ><i class="fa fa-cog"></i>Settings<span ></span></a>
                   
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
                     
                      <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  <div id="id01" class="modal">

 <div class="center-wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="Reset_Pass.php" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input required=" " type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white; "<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirm Password</label>
                <input required=" " type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group"  style=" background-color: white;">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="Business.php">Cancel</a>
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
                <h3>Stock Holder</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                 
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

              
              
              
              <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Information </h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
           
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                   
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                  
                      
                      
                      
                      
                      <form class="form-label-left input_mask" method="post">

                     

                    
                          
                           <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 "> Product :</label>
                        <div class="col-md-9 col-sm-9 ">
                         <select name="supid" id="supid" class="form-control">
                          <?php
                              
                              if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT ID,Name FROM product";
                              $i=0;
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                            
                                  echo "  <option value=" .$row["ID"]. ">".$row["Name"]."</option>";
                             
                              }
                              
                              }
                              
                              ?>             
                   
                          </select>
                        </div>
                      </div>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Quantity on Hand :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number" class="form-control"  placeholder="Quantity" value="0" name="quantity" id="quantity" required= " ">
                        </div>
                      </div>
                     
                          
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Unit Price:</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number" step="0.00000000000000001" class="form-control" value="0" placeholder="Unit Price" name="uprice" id="uprice" required= " ">
                        </div>
                      </div>
                          
                   
                          
                          
                          
                          
                          
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                          <button class="btn btn-primary" name="del">Delete</button>
						   <button class="btn btn-primary" name="update" >Update</button>
                          <button type="submit" class="btn btn-success" name="ok">Submit</button>
                             <button type="reset" class="btn btn-success"  >Reset</button>
                          
                        </div>
                      </div>

                    </form>
                      
                      
                      
                      
                      <?php
                      
                      
                      
                      if(isset($_POST['ok'])){
                         $name =  trim($_POST["name"]);
                         $catid = trim($_POST["catid"]);
                         $supid = trim($_POST["supid"]);
                         $forsale = trim($_POST["forsale"]); 
                          $qty = trim($_POST["quantity"]);
                          $uprice = trim($_POST["uprice"]);  
                          $margin = trim($_POST["margin"]);
                          $sql = "insert into product(name,CatID,SupID,ForSale,Qty_On_Hand,UPrice,Margin)values(?,?,?,?,?,?,?);";
                            
                          if($stmt = mysqli_prepare($link, $sql)){
                   
                              mysqli_stmt_bind_param($stmt, "sssssss", $param_name,$param_catid,$param_supid,$param_forsale,$param_qty,$param_uprice,$param_margin);
            
                                $param_name = $name;
                                $param_catid = $catid;
                                $param_supid = $supid;
                                $param_forsale = $forsale;
                                $param_qty = $qty;
                                $param_uprice = $uprice;
                                $param_margin = $margin;
                           
            
                              if(mysqli_stmt_execute($stmt)){
                                echo "<meta http-equiv='refresh' content='1'>";
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
                          
                          
                      }else if(isset($_POST['update'])){
                          
                          
                          
                          
                          
                          
                          
                      }else if(isset($_POST['del'])){
                          
                          
                          
                          
                          
                          
                          
                      }
                      
                      
                      
                      
                      ?>
                      
                      
                      
                      
                      
                      
                      
                      
                  </div>
                </div>
              </div>
            </div>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel" >
                  <div class="x_title" >
                    <h2>New Stock</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                     
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    
                      <div class="row" style=" margin-bottom: 15px; padding-left: 15px;  ">
                         
                    
                      
                       
                          
                          
                          
                          
                          
                          
                          
                          
                          
                     
                          
                          
                          
                          
                          
                      
                      
                      
                      
                      </div>
                      <div class="row">
                      
                        <div class="table">
                      <table id="datatable-buttons"  class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                            <th class="column-title">ID </th>
                            <th class="column-title">Quantity </th>
                            <th class="column-title">Unit Price </th>
                          
                       
                              
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
                              $sql = "SELECT * FROM newstock";
                           
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                                 
                              echo "<td class=\" \" >" .$row["ID"] . "</td>";
                              echo "<td class=\" \" >" .$row["QTY"] . "</td>";  
                              echo "<td class=\" \" >$" .$row["UPrice"] . "</td>";
                             
                               
                              echo " <td class='last'><a href='#'>Select</a>"   ;
                              echo "</tr>";
                              }
                              
                              }
                              
                              ?>
                              
                             
                              
                       
                          </tr>
                          
                         
                        </tbody>
                      </table>
                    </div>
                      
                      <form class="form-label-left input_mask" method="post">
                       <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                        
                            <button type="submit" class="btn btn-success" name="resupply">Supply</button>
                        </div>
                      
                      
                      
                         
                      
                      </div>
                      
                      </form>
                  
               
                      
                      
                      
                      
                  
                    
                      
                      
                      
                      
                      
                      
                      
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                  </div>
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
  
           <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
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
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

   
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
                          <script>
                              
                              
// setTimeout(function(){
//   $( "#datatable" ).load( "Business.php #datatable" );
//}, 2000); 

                              
              function myTrim(x) {
  return x.replace(/[^0-9.]/g,'');
}                
                              
                              
                              
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
				$('#datatable-buttons tbody').on('click', 'tr', function() {
					//get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
                //    var td=tableData[0] +  '*' +  tableData[1] + '*' + tableData[2] + '*' +  tableData[3] + '*' + tableData[4];
               
                    $("#supid").val(tableData[0]);
                   
                    $("#quantity").val(tableData[1]);
                    var td = myTrim(tableData[2]);
              
                    $("#uprice").val(td);
             
                    
                    
                    
               });	     
                    
             });

                    </script>  
     
  </body>
</html>
