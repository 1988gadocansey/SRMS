<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    $url="http://www.tpolyonline.com/Portal/sync_from_local.php";
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    $student=new _classes_\Student();
    $condition=$notify->getyear();
    //$help->generateAccount();
         if(isset($_POST[sync])){
             if($help->ping("www.google.com",80,20)){
             $string=$sql->Prepare("SELECT * FROM `tpoly_log_portal` WHERE ON_PORTAL='0'" );
             $row2=$sql->Execute($string);
                                    
                while($row=$row2->FetchRow()){
                     set_time_limit(500);
                      $index=$row[USERNAME];
                      $level=$row[LEVEL];
                      $program=$row[PROGRAMME];
                      $utype=$row[USER_TYPE];
                      $real_pass=$row[REAL_PASSWORD];
                      $id=$row[ID];
                      $year=$condition[YEAR];
                      $semester=$condition[TERM];
                      $password=$row[PASSWORD];
                        $stmt=" USERNAME='$index', PASSWORD='$password',  REAL_PASSWORD='$real_pass', LEVEL='$level', PROGRAMME='$program', ID='$id', YEAR='$year', SEMESTER='$semester', USER_TYPE='$utype'";
                      
                        $post = array('type'=>'portal_password','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
                        $result=$help->sync_to_online($url, $post);
                            if($result ){  

                           $query=$sql->Prepare("UPDATE tpoly_log_portal SET ON_PORTAL='1'  where USERNAME='$row[USERNAME]'");
                            if($sql->Execute($query)){
                                header("location:portal_password?success");
                            }
                       
	 
                       }
                }
                       
             }
             else{
                   header("location:portal_password?no_internet");
             }
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
				  <?php $notify->Message();  ?>
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
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							Generate Student's Portal Password
						</p>
                                                
                                                <div style="margin-top:-2.2%;float:right">
                                                    <form action="" method="post">
											 
                                                        <button type="submit" style="margin-left: -235px;"name="sync" class="btn btn-success">Sync with Online Portal<i class="fa fa-cloud-upload"></i></button>
                                                    </form>
                                                    <a href="bulk_angular" target="_"  style="margin-top: -55px"   class="btn bgm-pink waves-effect">Bulk Password Print<i class="fa fa-print"></i></a>
                                                 
                                                          </div>
					  </div>
                                    
                                     
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
                                            
                                            <div align='center' style="margin-left: 18%">
                                                  <form action="" method="POST" class="form-horizontal" role="form">
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
                                                <button type="submit" name="go" class="btn btn-warning">Generate</button>
                                            </div>
                                        </div>
                                            
                                </div><p></p>
                            </form>
                           
                                
                                                <div>
                                                    <?php  if(isset($_POST[go])){
                                    
                                    $person=$student->getStudentAccount($_POST['student'])  ; // returns array of student details

                                    ?>
                         
                             
                                
                                    <?php
                                         
                                        
                                        if(!empty($person)){
                                        echo "<table  class='table'>";//start table

                                         echo" <thead>";
                                        echo "<th>No.</th>";

                                        echo "<th data-toggle='true'>INDEX NUMBER</th>";
                                        echo "<th data-toggle='true'>NAME</th>";
                                        echo "<th data-toggle='true' >PROGRAMME</th>";
                                        echo "<th data-hide='phone'> LEVEL</th>";
                                        echo "<th>PASSWORD</th>";
                                        echo "</tr></thead>";
                                         $count=0;
                                         

                                            
                                            $count++;
                                            if($LEVEL=='100'){
                                                $class="label label-success status-active";
                                            }
                                                elseif($person->LEVEL=='200'){$class="label label-default status-disabled";}
                                                elseif($person->LEVEL=='300'){$class="label label-warning status-suspended";}
                                                 else{$class="label label-success status-disabled";}
                                                echo"<tr>";
                                                echo "<td>$count</td>";
                                                echo "<td>$person->USERNAME</td>";
                                                echo"<td>".$help->getName($person->USERNAME)."</td>";
                                                 echo "<td>$person->PROGRAMME</td>";
                                                 echo "<td data-value='$LEVEL'><span class='$class'  >$person->LEVEL</span></td>";
                                                  echo "<td>$person->REAL_PASSWORD</td>";
                                                 echo "</tr></table>";
                                              
                                            }
                                            else{
                                                 echo("  

                                                <div class='alert alert-dismissable alert-warning'>
                                                <strong>No Record! </strong>   Data now available. Try later
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                </div>");

                                              }
                                          
                                          
                                          
                                }
                                          ?>
                                    
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