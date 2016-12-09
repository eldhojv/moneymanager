<?php
    ob_start();
    session_start();
    require_once 'dbconnect.php';
    
    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) ) {
        header("Location: home.php");
        exit;
    }
    // select loggedin users detail
    $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow=mysql_fetch_array($res);
?>

<!-- Form submission handling -->
<?php
if ( isset($_POST['submit']))
 {
  $userId=$userRow['userId'];
  $debit=$userRow['balance'];

  if (is_numeric($_POST['amount']))
  {
   $amount=$_POST['amount'];
   $debit=$debit+$amount;
  }
  else
  {
  $error=true;
  $errMSG="Enter numeric value ";
  }

//inserting into db
if( !$error ) 
{
 $sql = "UPDATE users ". "SET balance = $debit ". "WHERE userid = $userId" ;

 $res2 = mysql_query($sql);
  if ($sql) 
   {
   $errTyp = "success";
   $errMSG = "Successfully Added your debit";
   } 
   else 
   {
   $errTyp = "Error Dgr";
   $errMSG = "Something error in entering..."; 
   }

}
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
    $userRow=mysql_fetch_array($res);
} 
?>
<!-- End of form handling -->



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoneyManager Welcome-<?php echo $userRow['userEmail']; ?></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- STYLES-->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">MoneyManager</a> <hr>
                <div class="brand"  style="color:white;"><a href="www.flynlabs.tk";>By Flyn labs.</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="play.google.com">Android App</a></div><br />
                <!-- <div   style="color:white; position:centre;">Android app &nbsp;</div> -->
            </div>

 <div class="header"> 

<span class="glyphicon glyphicon-user"></span> <?php echo $userRow['userEmail']; ?>&nbsp;
<a href="logout.php?logout"  class="btn btn-danger square-btn-adjust">Logout</a>
</div>

        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <!-- <img src="assets/img/find_user.png" class="user-image img-responsive"/> -->
                    </li>
                
                    
                   <li>
                        <a  href="home.php"><i class="glyphicon glyphicon-home fa-3x"></i> Dashboard</a>
                    </li>
                    <li  >
                        <a  href="form.php"><i class="fa fa-edit fa-3x"></i> Add Expense </a>
                    </li>   
                      <li>
                        <a  href="formdebit.php"><i class="fa fa-edit fa-3x"></i> Add Debit/Credit</a>
                    </li>
                     <li  >
                        <a  href="chart.php"><i class="fa fa-bar-chart-o fa-3x"></i>Weekly Expense Chart</a>
                    </li> 
                    <li  >
                        <a  href="chartmonth.php"><i class="fa fa-bar-chart-o fa-3x"></i>Monthly Expense Chart</a>
                    </li>   
                      <li  >
                        <a  href="table.php"><i class="fa fa-table fa-3x"></i> Expense Details</a>
                    </li>
                    <li  >
                        <a  href="formaccount.php"><i class="glyphicon glyphicon-user fa-3x"></i> Manage Account </a>
                    </li>                  
                    

               
            </div>
            
        </nav>  
        <!-- NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Debits/Credits</h2>   
                        <h5>Welcome <?php echo $userRow['userEmail']; ?>, Love to see you back. </h5>
                    </div>
                </div>              
                       
                 
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Keep your debit record
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Add debit</h3>

                                    <?php
                                    if ( isset($errMSG) ) { ?>
                                     <div class="form-group">
                                     <div class="alert alert-danger">
                                     <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                                     </div>
                                     </div>
                                     <?php  }  ?>

                                     <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                                        <div class=" form-group input-group input-group-lg">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" name="amount" class="form-control" placeholder="eg:250" />
                                        <span class="input-group-addon">.00</span>
                                        </div>
                                        
                                        
                                        <button type="submit" name="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>

                                    </form>
        </div>
                                
                            
<div class="col-md-3 col-sm-12 col-xs-12 ">    
<div style="float:right">                       
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-money fa-3x"></i>
                            <h3><?php echo $userRow['balance']; ?> </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                           Wallet Balance
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-money fa-3x"></i>
                            <h3><?php echo $userRow['spend']; ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Spendings
                            
                        </div>
                    </div>                         
</div>                                
</div>                               
                <!-- new row -->
                <div class="row">
                    <div class="col-md-12">
                        
                         <p>
                        Add your debits here, we will keep track of your credits(Note: Auto retrieval of dates).
                        </p>
                    </div>
                </div>
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
