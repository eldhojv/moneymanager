﻿<?php
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
                <a class="navbar-brand" href="home.php">MoneyManager</a> 
                <div class="andmsg" style="color:white;"><a href="www.semicolon.com";>By semiColon Tech.</a></div>
                <div class="andmsg" style="color:white;">Android app will be availabe soon &nbsp;</div>
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
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dashboard</h2>   
                        <h5>Welcome <?php echo $userRow['userEmail']; ?>, Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6"><a href="chart.php">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-inr"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"></a>450</p>
                    <p class="text-muted">Weekly Exp.</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6"> <a href="chartmonth.php">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-inr"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"></a>1600</p>
                    <p class="text-muted">Monthly Exp.</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">  <a href="form.php">          
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-money"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"></a></p>
                    <p class="text-muted">Add Debit/Credit</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">  <a href="formaccount.php">          
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-money"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"></a></p>
                    <p class="text-muted">Add Expense</p>
                </div>
             </div>
		     </div>
			</div>
                
<!-- Dougnut Chart -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Wallet Chart
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>
                    
                   
 <!-- Bar chart   -->
                <div class="row"> 
                    
                      
                <div class="col-md-9 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category Spending Bar Chart 
                        </div>
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                        </div>
                    </div>            
                </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">                       
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>120 Rs </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                           Week Highest Spending
                            
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>20,000 Rs </h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Month Highest Spending
                            
                        </div>
                    </div>                         
                    </div>
                
           </div>

                
                 

                       
                         
                    
                      
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
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
