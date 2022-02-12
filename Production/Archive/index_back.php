<!DOCTYPE html>

<?php
require_once "../config.php";
session_start();

if ($_SESSION["oauth"] != "Senior Staff")
{

    die("Wrong Credential");
}

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";


if (isset($_POST['sub']))
{

  
    if (empty(trim($_POST["new_password"])))
    {
        $new_password_err = "Please enter the new password.";
    }
    elseif (strlen(trim($_POST["new_password"])) < 6)
    {
        $new_password_err = "Password must have atleast 6 characters.";
    }
    else
    {
        $new_password = trim($_POST["new_password"]);
    }

 
    if (empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm the password.";
    }
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }

   
    if (empty($new_password_err) && empty($confirm_password_err))
    {
        // Prepare an update statement
        $sql = "UPDATE admin SET PASSWORD = ? WHERE ID = ?";

        if ($stmt = mysqli_prepare($link, $sql))
        {
           
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

        
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

          
            if (mysqli_stmt_execute($stmt))
            {
               
                session_destroy();
                header("location: log.php");
                exit();
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    
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
                  <li ><a href="../Product/" ><i class="fa fa-bar-chart-o"></i>Product<span ></span></a>
                   
                  </li>
                
                 <li ><a href="../Stock/" ><i class="fa fa-line-chart"></i>Stock<span ></span></a>
                   
                  </li>
                 
                       <li ><a href="../Logs/" ><i class="fa fa-area-chart"></i>Order/Sales<span ></span></a>
                   
                  </li>
                    <li class="current-page"><a href="" ><i class="fa fa-archive"></i>Archive<span ></span></a>
                   
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
          <div class="" style="min-height: 902px;">
            <div class="page-title">
              <div class="title_left">
                <h3>Settings</h3>
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
                    <h2>Order</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                     
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    
                      <div class="row" style=" margin-bottom: 15px; padding-left: 15px;  ">
                         
                    
        
                      </div>
                      <div class="row">
                      
                        <div  style="overflow-y: hidden;overflow-x: auto" class="table"   id="live_datas">
                            
                            
                            
                            
                            
                            
                            
                      
                    </div>
                      </div>
                      
                      <form class="form-label-left input_mask" method="post">
                       <div class="form-group row">
                        <div class="col-md-9 col-sm-9  ">
                        
                            <button class="btn btn-success"  id="clear" name="clear">Clear Log</button>
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
        <footer>
          <div class="clearfix"></div>
        </footer>
      </div>
  
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
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

      
         
                          <script>
       // category                       
   
                              
                              
                              
               window.alert = function() {};

alert = function() {};
                                     
                              
                              
                              
             //     datatable-buttons            
                              
                              
                              
                          
                              
                                         
                 $(document).ready(function(){  
        
         function fetch_data()  
      {  
           $.ajax({  
                url:"Archive_Sel.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_datas').html(data);  
                }  
           });  
      }  
        
     fetch_data() ;
    
 });                  
                              
                        
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                      
                           $(document).ready(function(){  
        
       
    
    
     
      $(document).on('click', '#btn_deletes', function(){  
           var ID=$(this).data("ids3");  
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
                              
                              
                              
                              
      
                              
                              
                        $(document).ready(function(){         
                              
                              
              $(document).on('click', '#clear', function(){  
            var clear= "clear"; 
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"Order_Del.php",  
                     method:"POST",  
                     data:{clear:clear},  
                     dataType:"text",  
                     success:function(data){  
                          
                       
                          fetch_data();  
                     }  
                });  
               
              
           }  
                  
      });                 
                              
                              
});                         
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                           
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
