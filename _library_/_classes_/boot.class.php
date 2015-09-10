<?php


/**
 * Description of boot
 *
 * @author Senior Software Eng
 */
namespace _classes_;
use _classes_\Login;
class Boot {
    public function __construct(){
             $app=new \_classes_\Login();
             if($app->getMac()){
                 
             }
             else{
                 die("Server misconfigured");
             }
	}
    public function __clone(){
             
	}
    public function run(){
        ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Takoradi Polytechnic">
    <meta name="author" content="Takoradi Polytechnic">
    <title>SRMS | Welcome</title>
    <meta name="msapplication-TileColor" content="#9f00a7">
    
    <meta name="theme-color" content="#ffffff">
      
    <link rel="shortcut icon" href="favicon.png">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>  <![endif]-->
    <link href="assets/vendors.min.css" rel="stylesheet" />
    <link href="assets/styles.min.css" rel="stylesheet" />
     
  </head>
  <body class="page-login" init-ripples="">
    <div class="center">
        <center> <img src="assets/logo.png" style="width: 120px;height: 127px"/></center>
        &nbsp;
      <div class="card bordered z-depth-2" style="margin:0% auto; max-width:400px;">
        <div class="card-header">
          <div class="brand-logo">
            <div id="logo">
              <div class="foot1"></div>
              <div class="foot2"></div>
              <div class="foot3"></div>
              <div class="foot4"></div>
            </div> SRMS </div>
        </div>
        <div class="card-content">
           
            <form class="form-floating" action="index.php?action=login" method="post">
            <div class="form-group">
              <label for="inputEmail" class="control-label">Username</label>
              <input type="text" class="form-control" name="username" required=""> </div>
            <div class="form-group">
              <label for="inputPassword" class="control-label">Password</label>
              <input type="password" class="form-control" name="password" id="inputPassword" required=""> </div>
            
         
        </div>
        <div class="card-action clearfix">
          <div class="pull-right">
              <button type="submit" class="btn btn-success  ">Login</button>
            <button type="button" class="btn btn-link  ">Learn SRMS</button>
          </div>
        </div>
      </form>
      </div>
         <center><small>&copy;<?php echo date("Y") ?> | Powered by TPconnect</small></center>
    </div>
    
     
    
    <!--<script charset="utf-8" src="assets/vendors.min.js"></script> -->
    <script charset="utf-8" src="assets/app.min.js"></script>
  </body>
</html>
        <?php
        $app=new \_classes_\Login();
         
        if(isset($_GET['action'])=='login'){

          
          $app->signin($_POST['username'], $_POST['password']);
         
        } 
        
    }
     
}
