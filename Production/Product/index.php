<!DOCTYPE html>

<?php
require_once "../config.php";
session_start();

if($_SESSION["oauth"] != "Senior Staff"){
    
    
    
    
    if($_SESSION["oauth"] != "Encoder"){
     echo "  Enter Valid Credential ";
   
        die(" <a href='../'> return to home page </a>");
       
    
}
    
    
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

    
 <link rel="shortcut icon" href="../images/ico/favicon.ico">
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
      
      <input type="hidden" id="oauth" value="<?php echo htmlspecialchars($_SESSION["oauth"]); ?>">
      
  
                          
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
                    <li class="active-sm"><a href="" ><i class="fa fa-bar-chart-o"></i>Product<span ></span></a>
                   
                  </li>
                
                 <li ><a href="../Stock/" ><i class="fa fa-line-chart"></i>Stock<span ></span></a>
                   
                  </li>
                 
                    <li ><a href="../Logs/" ><i class="fa fa-area-chart"></i>Order/Sales<span ></span></a>
                   
                  </li>
                     <li ><a href="../Archive/" ><i class="fa fa-archive"></i>Archive<span ></span></a>
                   
                  </li>
                    <li ><a href="../Setting/" ><i class="fa fa-cog"></i>Settings<span ></span></a>
                   
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
                <a class="btn btn-link" href="#" onclick="document.getElementById('id01').style.display='none'">Cancel</a>
            </div>
        </form>
    </div>    
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                    </div>
       
                </ul>
              </nav>
            </div>
          </div>
        <div class="right_col" role="main" style="min-height: 1500px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Product</h3>
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
                        <label class="col-form-label col-md-3 col-sm-3 ">ID :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input disabled type="text" class="form-control"  placeholder="ID"  name="ID" id="ID">
                        </div>
                      </div>
                          
                          
                          <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Name :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="text" class="form-control"  placeholder="Name" name="name" id="name" required= " ">
                        </div>
                      </div>
                          
                          
                          
                          
                          
                             <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 "> Category :</label>
                        <div class="col-md-9 col-sm-9 ">
                         <select name="catid" id="catid" class="form-control">
                          <?php
                              
                              if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT ID,NAME FROM category";
                              $i=0;
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                            
                                  echo "  <option value=" .$row["ID"]. ">".$row["NAME"]."</option>";
                             
                              }
                              
                              }
                              
                              ?>             
                   
                          </select>
                        </div>
                      </div>
                          
                          
                           <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 "> Supplier :</label>
                        <div class="col-md-9 col-sm-9 ">
                         <select name="supid" id="supid" class="form-control">
                          <?php
                              
                              if($link->connect_error){
                                  die("Connection failed: " . $link->connect_error);
                                  
                              }
                              $sql = "SELECT ID,NAME FROM suppliers";
                              $i=0;
                              
                              $result = $link->query($sql);
                              if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                          //    echo "<td class='a-center'><input type='checkbox' class='flat' name='table_records'> </td>";
                            
                                  echo "  <option value=" .$row["ID"]. ">".$row["NAME"]."</option>";
                             
                              }
                              
                              }
                              
                              ?>             
                   
                          </select>
                        </div>
                      </div>
                          
                          
                         
                          
                          
                             <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">For Sale :</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select name="forsale" id="forsale" class="form-control">
                               <option value="1"> For Sale</option>
                               <option value="0"> Not For Sale</option>
                               
                            </select>
                        </div>
                      </div>
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Quantity on Hand :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number" class="form-control" value="0" placeholder="Quantity" name="quantity" id="quantity" required= " ">
                        </div>
                      </div>
                     
                          
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Unit Price:</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number" class="form-control" value="0" placeholder="Unit Price" name="uprice" id="uprice"  step="0.00000000000000001" required= " ">
                        </div>
                      </div>
                          
                                  <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Margin Rate :</label>
                        <div class="col-md-9 col-sm-9 ">
                          <input type="number"  step="0.00000000000000001" class="form-control" value="0"  placeholder="Margin Rate" name="margin" id="margin"  required= " ">
                        </div>
                      </div>
                          
                          
                          
                          
                          
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                          

                          <button type="submit" class="btn btn-success" id="ok" name="ok">Submit</button>
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
                             
                              } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
                          
                          
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
                    <h2>Product Sales</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                     
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                        
                      
                      <div class="row" style=" margin-bottom: 15px; padding-left: 15px;  ">
         
                      </div>
                      <div class="row">
                      <!---   <th><input type="checkbox" id="check-all" class="flat"></th> ---> <!---   <th><input type="checkbox" id="check-all" class="flat"></th> ---> <!---   <th><input type="checkbox" id="check-all" class="flat"></th> ---> <!---   <th><input type="checkbox" id="check-all" class="flat"></th> ---> <!---   <th><input type="checkbox" id="check-all" class="flat"></th> --->
                          <div class="  offset-md-10">
                          

                          <button type="submit" class="btn btn-success"  name="release" id="release">Release Product Sales</button>
                             
                        </div>
                        <div class="table overflow-x" style="overflow-y: hidden;overflow-x: auto" id="live_data">
                      
                            
                            
                    </div>
                      
                      
                      
                      
                      
                      
                      
                      
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
      
           link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
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
//}, 2000); $(document).ready(function () {
             
                          function myTrim(x) {
  return x.replace(/[^0-9.]/g,'');
}                     
                              
                              
var modal = document.getElementById('id01');


window.alert = function() {};

alert = function() {};
                              
                              
                              
                              
                              
                              
                              
                $(document).ready(function(){  
                    
                    
                    
                    
                    
                    
                                
$(document).on('click', '#release', function(){  
     var oauth = document.getElementById('oauth').value;      
    
    if(oauth != "Senior Staff"){
       
       confirm("Insufficient Privilege");
       
       
    
    
          }else{
               
                   var table = document.getElementById('datatable-buttons');
    for (var r = 1, n = table.rows.length; r < n; r++) {
        
        var ID =    table.rows[r].cells[0].innerHTML
        
        
       
        
              $.ajax({  
                url:"Business_In.php",  
                method:"POST",  
                data:{ID:ID},  
                dataType:"text",  
                success:function(data)  
                {  
                   
                     fetch_data();  
                    
                }  
           }) 
        
        
        
        
        
    }
                
       
                      
             confirm("Product Release Sucessful"); 
               
               
               }
        
    
      });  
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
        
         function fetch_data()  
      {  
           $.ajax({  
                url:"Business_Sel.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
        
     fetch_data() ;
      $(document).on('click', '#btn_add', function(){  
           var Name = $('#Name').text();  
            
        
          
           if(Name == '')  
           {  
               alert("Please Enter Name")  
                return false;  
           }  
          
           $.ajax({  
                url:"Setting_In.php",  
                method:"POST",  
                data:{Name:Name},  
                dataType:"text",  
                success:function(data)  
                {  
                     
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(ID, Name, column_name)  
      {  
           $.ajax({  
                url:"Business_Edit.php",  
                method:"POST",  
                data:{ID:ID, Name:Name, column:column_name},  
                dataType:"text",  
                success:function(data){  
                   
                }  
           });  
      }  
            
                    
                   $(document).on('blur', '.ID', function(){  
           var id = $(this).data("id1");  
          myTrim($(this).text());   
           edit_data(id, Name, "ID");  
        //   alert(Name); 
      });  
      $(document).on('blur', '.Name', function(){  
           var id = $(this).data("id2");  
           var Name = $(this).text();  
           edit_data(id,Name, "Name"); 
           
      });   
     
           $(document).on('blur', '.CatID', function(){  
           var id = $(this).data("id3");  
         var Name =  myTrim($(this).text());  
           edit_data(id,Name, "CatID"); 
           
      });  
                    
           $(document).on('blur', '.SupID', function(){  
           var id = $(this).data("id4");  
           var Name = myTrim($(this).text());  
           edit_data(id,Name, "SupID"); 
           
      });
                    
           $(document).on('blur', '.ForSale', function(){  
           var id = $(this).data("id5");  
           var Name = myTrim($(this).text());  
           edit_data(id,Name, "ForSale"); 
           
      });
                    
           $(document).on('blur', '.Qty_On_Hand', function(){  
           var id = $(this).data("id6");  
           var Name = myTrim($(this).text());  
           edit_data(id,Name, "Qty_On_Hand"); 
           
      });     
                    
         
          
                    
                        $(document).on('blur', '.UPrice', function(){  
           var id = $(this).data("id7");  
           var Name = myTrim($(this).text());  
           edit_data(id,Name, "UPrice"); 
           
      });  
                    
                       
      
                    
                             $(document).on('blur', '.Margin', function(){  
           var id = $(this).data("id8");  
           var Name = myTrim($(this).text());  
           edit_data(id,Name, "Margin"); 
           
      });          
                    
      $(document).on('click', '#btn_deletes', function(){  
           var ID=$(this).data("ids3");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"Business_Del.php",  
                     method:"POST",  
                     data:{ID:ID},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });                
                              
                              
                              
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
                    $("#ID").val(tableData[0]);
                    $("#name").val(tableData[1]);
                   $("#catid").val(tableData[2]);
                    $("#supid").val(tableData[3]);
                    $("#forsale").val(tableData[4]);
                    $("#quantity").val(tableData[5]);
                    var td = myTrim(tableData[6]);
                    var tds = myTrim(tableData[7]);
                    $("#uprice").val(td);
                    $("#margin").val(tds);
                    
                    
                    
               });	     
                    
             });                             
                              
                              
                              

                    </script>  
  </body>
</html>
