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
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
<meta charset="utf-8"/>
<title>Students Records And Management System | Welcome </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="Takoradi Polytechnic"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/admin/pages/css/login2.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->

<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <div class="logo">
	<a href="index.php">
	<img src="assets/logo.png" style=" width:102px;height: 109px; margin-top: 5% " alt=""/>
	</a>
</div>
	<!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="index.php?action=login" method="post" autocomplete="off">
		<div class="form-title">
                    <center><span class="form-title">SRMS - Takoradi Polytechnic</span></center>
			 
		</div>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" required="" autocomplete="off" placeholder="Username" name="username"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
                        <input class="form-control form-control-solid placeholder-no-fix" required="" type="password" autocomplete="off" placeholder="Password" name="password"/>
		</div>
		<div class="form-actions">
                    <center><button type="submit" class="btn btn-success  uppercase">Login</button></center>
		</div>
		 
		 
	</form>
	 
 </div>
<div class="copyright" style="font-size: 11px">
	  &copy<?php echo date("Y"); ?> Takoradi Polytechnic | Powered by Tpconnect Team
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>

</html>
        <?php
        $app=new \_classes_\Login();
         
        if(isset($_GET['action'])=='login'){

          
          $app->signin($_POST['username'], $_POST['password']);
         
        } 
        
    }
     
}
