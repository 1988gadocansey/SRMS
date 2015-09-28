<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    if (isset($_GET[delete])) {

            $query = $sql->Prepare("DELETE FROM tpoly_auth WHERE USERNAME='$_GET[delete]'");
            if ($sql->Execute($query)) {
                header("location:users?success=1");
            } else {
                header("location:users?error=1");
            }
        }
        if (isset($_GET[block])) {

            $query = $sql->Prepare("UPDATE tpoly_auth SET ACTIVE='0' WHERE USERNAME='$_GET[block]'");
            if ($sql->Execute($query)) {
                 
                header("location:users?success=1");
            } else {
                header("location:users?error=1");
            }
        }
        if (isset($_GET[enable])) {

            $query = $sql->Prepare("UPDATE tpoly_auth SET ACTIVE='1' WHERE USERNAME='$_GET[enable]'");
            if ($sql->Execute($query)) {
                header("location:users?success=1");
            } else {
                header("location:users?error=1");
            }
        }

        

?>

<?php require '_library_/_includes_/header.inc'; ?>
<div>
    <?php require '_library_/_includes_/menu.inc'; ?>
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
			 
			 <div class="modal fade" id="mount" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add User</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="view_mounted_courses" method="POST" class="form-horizontal" role="form">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputEmail3s"    class="col-sm-2 control-label">Program</label>
                                                         <div class="col-sm-10">
                                                             <div class="fg-line">
                                                                 <select class='select2_category form-control input-sm'  name='program' required="" style="" >
                                                                     <option value=''>Select program</option>
                                                                        
                                                                    <?php 
                                                                      global $sql;

                                                                          $query2=$sql->Prepare("SELECT * FROM tpoly_programme ");


                                                                          $query=$sql->Execute( $query2);


                                                                       while( $row = $query->FetchRow())
                                                                         {

                                                                         ?>
                                                                         <option <?php ?> value="<?php echo $row['PROGRAMMECODE']; ?>"        ><?php echo $row['PROGRAMME']; ?></option>

                                                                  <?php }?>
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputEmaisl3"    class="col-sm-2 control-label">Course</label>
                                                         <div class="col-sm-10">
                                                             <div class="fg-line">
                                                                <select class='select2_category form-control input-sm'  name='course'  style="" >
                                                                <option value=''>Filter Courses</option>
                                                                        <option value='All Courses'>All Courses</option>
                                                                    <?php 
                                                                      global $sql;

                                                                          $query2=$sql->Prepare("SELECT * FROM tpoly_courses ");


                                                                          $query=$sql->Execute( $query2);


                                                                       while( $row = $query->FetchRow())
                                                                         {

                                                                         ?>
                                                                         <option <?php if($_SESSION[course]==$row['COURSE_CODE']){echo 'selected="selected"'; }?> value="<?php echo $row['COURSE_CODE']; ?>"        ><?php echo $row['COURSE_NAME']; ?></option>

                                                                  <?php }?>
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3dd" class="col-sm-2 control-label">Credit</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control input-sm'  name='credit'  style="  " required="" >
                                                                    <option value=''>select credit hour</option>
                                                                   
                                                                       <option value='1'<?php if($_SESSION[tedrm]=='1'){echo 'selected="selected"'; }?>>1</option>
                                                                       <option value='2'<?php if($_SESSION[tderm]=='2'){echo 'selected="selected"'; }?>>2</option>
                                                                   <option value='3'<?php if($_SESSION[terms]=='3'){echo 'selected="selected"'; }?>>3</option>

                                                               </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPasasword3" class="col-sm-2 control-label">Year</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control'  name='year'  required="" >
                                                                            <option value=''>select academic year</option>
                                                                            
                                                                                <?php
                                                                                                               for($i=2008; $i<=date("Y")+1; $i++){
                                                                                                                       $a=$i - 1 ."/". $i;?>
                                                                                                                                <option <?php if($_SESSION[year]==$a){echo 'selected="selected"'; }?>value='<?php echo $a ?>'><?php echo $a ?></option>";

                                                                                                                    <?php    } ?>


                                                                                                        ?>

                                                                       </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPasswsord3" class="col-sm-2 control-label">Semester</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control input-sm'  name='term'  style="" required="" >
                                                                        <option value=''>select semester</option>
                                                                        
                                                                           <option value='1'<?php if($_SESSION[tedrm]=='1'){echo 'selected="selected"'; }?>>1st</option>
                                                                           <option value='2'<?php if($_SESSION[termd]=='2'){echo 'selected="selected"'; }?>>2nd</option>
                                                                       <option value='3'<?php if($_SESSION[terdm]=='3'){echo 'selected="selected"'; }?>>3rd</option>

                                                                   </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                   
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">Level</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  <select class='form-control input-sm'  name='level'  style="" >
                                                                        <option value=''>Filter by level</option>
                                                                        
                                                                       <option value='50'<?php if($_SESSION[levelss]=='50'){echo 'selected="selected"'; }?>>50</option>
                                                                           <option value='100'<?php if($_SESSION[levelss]=='100'){echo 'selected="selected"'; }?>>100</option>
                                                                           <option value='200'<?php if($_SESSION[levesls]=='200'){echo 'selected="selected"'; }?>>200</option>
                                                                       <option value='300'<?php if($_SESSION[levelxs]=='300'){echo 'selected="selected"'; }?>>300</option>
                                                                       <option value='400'<?php if($_SESSION[levelss]=='400'){echo 'selected="selected"'; }?>>400</option>

                                                                   </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                                         
                                                
                                             
                                       
                                                       <div class="form-group">
                                                         <label for="inputEmail3ds"    class="col-sm-2 control-label">Lecturer</label>
                                                         <div class="col-sm-10">
                                                             <div class="fg-line">
                                                                 <select class='select2_category form-control input-sm tagsinput'  name='lecturer'  required=""  >
                                                                <option value=''>Select lecturer</option>
                                                                       
                                                                    <?php 
                                                                      global $sql;

                                                                          $query2=$sql->Prepare("SELECT * FROM tpoly_workers WHERE designation ='Lecturer' ");


                                                                          $query=$sql->Execute( $query2);


                                                                       while( $row = $query->FetchRow())
                                                                         {

                                                                         ?>
                                                                         <option value="<?php echo $row['ids']; ?>"        ><?php echo $row['Name']." ".$row['surname']; ?></option>

                                                                  <?php }?>
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                </div>
                                        <div class="modal-footer">
                                                      
                                                        <button type="submit" name="go" class="btn btn-primary">Save</button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-warning">Close</button>
                                                </div>
                               </form>
                                    </div>
                                </div>
                            </div>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
                             <div><?php $notify->Message(); ?></div>
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							User Accounts
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                    <button  data-target="#mount" data-toggle="modal" class="btn bgm-pink waves-effect">
											Add New User <i class="fa fa-plus"></i>
											</button>
                                                    <button class="btn btn-success">Sync to Online Portal<i class="fa fa-cloud-upload"></i></button>
                                                
                                                 
                                                 <button   class="btn btn-primary waves-effect waves-button dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'csv',escape:'false'});"><img src='assets/icons/csv.png' width="24"/> CSV</a></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'txt',escape:'false'});"><img src='assets/icons/txt.png' width="24"/> TXT</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'excel',escape:'false'});"><img src='assets/icons/xls.png' width="24"/> XLS</a></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'doc',escape:'false'});"><img src='assets/icons/word.png' width="24"/> Word</a></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'powerpoint',escape:'false'});"><img src='assets/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'png',escape:'false'});"><img src='assets/icons/png.png' width="24"/> PNG</a></li>
                                                            <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'pdf',escape:'false'});"><img src='assets/icons/pdf.png' width="24"/> PDF</a></li>
                                                          </ul>
                                                          </div>
                            
					</div>
                                    <div>
                                        
                                   
                                    </div>
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							 
							<div class="tools">
							</div>
						</div>
			<div class="portlet-body">
                                           
                           
                            <div class="table-responsive">
                                <div ng-app="myApp" ng-controller="customersCtrl"> 

                                        <table  id="data-table-command" class="table table-striped table-hover">
                                        <tr>
                                            <thead>
                                             
                                            <th style="text-align:">WORKER</th>
                                            <th>ROLE</th>
                                            <th>USER SINCE</th>
                                            <th>IP ASSIGNED</th>
                                            <th>LAST LOGIN</th>
                                            <th>ONLINE</th>
                                            <th>ACCOUNT STATUS</th>
                                            <th colspan="3" style="text-align: center">ACTION</th>
                                            </thead>
                                        </tr>
                                      <tr ng-repeat="x in names">
                                        <td>{{x.user}}</td>
                                          <td>{{x.type}}</td>
                                        <td style="text-align:">{{x.since}}</td>
                                         <td>{{x.ip}}</td>
                                         <td>{{x.last_login}}</td>
                                         <td>{{x.online}}</td>
                                         <td>{{x.active}}</td>
                                         <td><a href="users?delete={{x.user}}" onclick="return confirm(confirm('Are you sure you want to delete this account??'))"><i class="fa fa-trash"  title="Delete this account"></i></a></td>
                                         <td><a href="users?enable={{x.user}}"  onclick="return confirm(confirm('Are you sure you want to enable this account??'))"><i class="fa fa-unlock" title="Enable this account"></i></a></td>
                                           <td><a href="users?block={{x.user}}"  onclick="return confirm(confirm('Are you sure you want to block this account??'))"><i class="fa fa-lock"  title="Block this account"></i></a></td>
                                      </tr>
                                    </table>

                                    </div>
         
                                <br/>
                             
                    </div>
                                        
                                                       
                        </div>
					 
					<!-- END EXAMPLE TABLE PORTLET-->

					 
				</div>
			</div>
                </div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
 
<!-- BEGIN FOOTER -->
<div class="page-footer" style="">
	<div class="container">
            <center><?php echo $help->copyright(); ?></center>
	</div>
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
<script src= "assets/ajax.googleapis.com_ajax_libs_angularjs_1.3.14_angular.min.js"></script>
<?php include("_library_/_includes_/scripts.php");  ?>

<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
    
});
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("user_json.php")
   .success(function (response) {$scope.names = response.records;});
});
</script>
<?php include("_library_/_includes_/export.php");  ?>
 

</html>