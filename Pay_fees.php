<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    $student=new _classes_\Student();
    
       if(isset($_POST[go])){
          
           header("location:fee_payment?student=$_POST[student]");
       }
        

?>

<?php require '_library_/_includes_/header.inc'; ?>
 

<link rel="stylesheet" type="text/css" href="autocompletion/jquery.autocomplete.css"  /> 
<div>
    <?php require '_library_/_includes_/menu.inc'; ?>
   <?php 
        $result = $sql->Prepare("SELECT  DISTINCT INDEXNO FROM tpoly_students   ORDER BY INDEXNO ASC  ");
$result_=$sql->Execute($result);
	$a = "";
		while($row = $result_->FetchRow()){
			 $a = $a . "'".$row['INDEXNO']."',";
		}
		
		echo "<script type='text/javascript'>
				var student_names = [".$a."];
				</script>
				";
				
   
   ?>
   
</div>
 
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			<div class="page-toolbar">
				 
			</div>
			<!-- END PAGE TOOLBAR -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			  
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
                              <?php $notify->Message();  ?>
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							Fee Payment
						</p>
                                                 
					  </div>
                                    
                                     
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
                                            
                                            <div align='center' style="margin-left: 18%">
                                                <form action="Pay_fees.php" method="POST" class="form-horizontal" role="form">
                                                 <div class="card-body card-padding">
                                                    
                                                     <div class="form-group">
                                                         <label for="inputEmail3s"    class="col-sm-2 control-label">Index Number</label>
                                                         <div class="col-sm-9">
                                                             <div class="fg-line">
                                                                 <input class="student form-control input-sm" name="student" id="student" required=""/>
                                                                    
                                                             </div>
                                                         </div>
                                                     </div>
                                                      
                                                 </div>
                                               
                                            
                                            <p></p>
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-5">
                                                <button type="submit" name="go" class="btn btn-warning">Continue</button>
                                            </div>
                                        </div>
                                            
                                </div><p></p>
                            </form>
                           
                                
                                                <div>
                                               
                                                </div>
                                           
                                            
                                            </div>
                                    
                                     
                                
                                </div>
                                        <!-- END PAGE CONTENT INNER -->
                                </div>
                </div>
	</div>
	<!-- END PAGE CONTENT -->

  </div>
<div class="page-footer" style="margin-top: 20%">
	<div class="container">
            <center><?php echo $help->copyright(); ?></center>
	</div>
</div>
       
        </div>
<!-- END PAGE CONTAINER -->
 
<!-- BEGIN FOOTER -->
</div>

<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
 
<?php include("_library_/_includes_/scripts.php");  ?>
<script type='text/javascript' src="autocompletion/jquery.js"></script>
<script type='text/javascript' src="autocompletion/jquery.autocomplete.js"></script>
<script type='text/javascript' src="autocompletion/localdata.js"></script>
<script type="text/javascript">

//var other_options =  ['Phone Numbers', 'Email', 'Address', 'Local Congregation','Males', 'Females' ];
 $().ready(function() {
		
	
	$("#student").autocomplete(student_names, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
	
	
	
		$("#student_name").autocomplete(student_names, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
	
 });
 </script> 
 
<?php include("_library_/_includes_/export.php");  ?>
 

</html>