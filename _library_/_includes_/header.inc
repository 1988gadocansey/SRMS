<!DOCTYPE html>
 <?php include("Session.php"); ?>
<html lang="en">

<head>
<meta charset="utf-8"/>
<title>Student Records Management Systems | SRMS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="Takoradi Polytechnic"/>
 
<!-- BEGIN GLOBAL MANDATORY STYLES -->
 
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/font-awesome/css/material-design-iconic-font.mine7ea.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/font-awesome/css/materialadminb0e2.css" rel="stylesheet" type="text/css">
 <link href="assets/global/plugins/font-awesome/css/app.min.css" rel="stylesheet" type="text/css"> 
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/bootgrid/jquery.bootgrid.min.css" rel="stylesheet">
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/main.min.css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
<link href="assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.png"/>
<style>
    #data-table-command  tr:hover{
        
        background-color: #FFFCBE;
    }
    #assesment  tr:hover{
        
        background-color: #FFFCBE;
    }
    #bill  tr:hover{
        
        background-color: #FFFCBE;
    }
</style>
<script>
      function check(ids,box){
		  
		  var input=document.getElementById(ids).value-0;
		  var checker=document.getElementById(box).value-0;
	   
                    if(input>checker){

                    alert('Score can not be greater than '+checker);
                    document.getElementById(ids).value="";
                    document.getElementById(ids).focus();
                          
                      return false;
                    }
	  
	  }

        function check70(ids){
                  if(document.getElementById(ids).value >100 ){

                  alert('Score can not be greater than 100');
                  document.getElementById(ids).value="";
                  document.getElementById(ids).focus();
                                                 

                    return false;
                  }

	  }
      
      </script>
    <script>
         function recalculateSum()
            {
                var num1 = parseFloat(document.getElementById("pay").value);
                var num2 = parseFloat(document.getElementById("bill").value);
                 
                  
                     
                        document.getElementById("amount_left").value =( num2-  num1)    ;
                     
                    
            }         
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}      
						
function printpage()
{
   type=document.getElementById("type").value;
      draft=document.getElementById("draft").value;

  if(draft==''){ alert('PLEASE TYPE DRAFT NO');
  return false;
  }
  
  if(type==''){ alert('PLEASE SELECT PAYMENT TYPE');
  return false;
  }
  
   pay=document.getElementById("pay").value;
   stuid=document.getElementById("indexno").value;
   receipt=document.getElementById("receiptno").value;
   draft=document.getElementById("draft").value;
  
   
	 
	
	 

 
}
      </script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-md page-header-menu-fixed">
<!-- BEGIN HEADER -->
<?php  // include top.php; ?>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
        <div class="page-header">
         