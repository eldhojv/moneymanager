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
   <!-- calendar -->
   <link rel="stylesheet" href="assets/css/calendarview.css">
   <link rel="stylesheet" href="assets/css/cal.css">
   <script src="assets/js/prototype.js"></script>
    <script src="assets/js/calendarview.js"></script>
<script>
      function setupCalendars() {
        // Embedded Calendar
        Calendar.setup(
          {
            dateField: 'embeddedDateField',
            parentElement: 'embeddedCalendar'
          }
        )

        // Popup Calendar
        Calendar.setup(
          {
            dateField: 'popupDateField',
            triggerElement: 'popupDateField'
          }
        )
      }

      Event.observe(window, 'load', function() { setupCalendars() })
    </script>




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

        <!-- NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Expense/Spendings</h2>   
                        <h5>Welcome <?php echo $userRow['userEmail']; ?>, Love to see you back. </h5>
                    </div>
                </div>              
                       
                 
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Keep your expense record
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Add expense</h3>
                                    <form role="form">
                                        <div class=" form-group input-group input-group-lg">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" placeholder="eg:250" />
                                        <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group">
                                            
                                            <label>Keyword</label>
                                            <input class="form-control" placeholder="Enter Keyword" />
                                        </div>



                                        <!-- <div style="height: 400px; background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
        <h3 style="text-align: center; background-color: white; -webkit-border-radius: 10px; -moz-border-radius: 10px; margin-top: 0px; margin-bottom: 20px; padding: 8px">
          Embedded Calendar
        </h3>
        <div id="embeddedExample" style="">
          <div id="embeddedCalendar" style="margin-left: auto; margin-right: auto">
          </div>
          <br />
          <div id="embeddedDateField" class="dateField">
            Select Date
          </div>
          <br />
        </div>
      </div>
    
                                         -->
                                        
                                        
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Choose Category</label>
                                            <select class="form-control">
                                                <option>One Vale</option>
                                                <option>Two Vale</option>
                                                <option>Three Vale</option>
                                                <option>Four Vale</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>

                                    </form>
        </div>
                                
                               
<div class="col-md-3 col-sm-12 col-xs-12 "> 
<div style="float:right;">                       
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-money fa-3x"></i>
                            <h3>120 Rs </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                           Wallet Balance
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-money fa-3x"></i>
                            <h3>20,000 Rs </h3>
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
                        Add your expense here, we will keep track of your spendings
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
