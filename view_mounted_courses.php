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
    if($_GET[program]){
        $_SESSION[program]=$_GET[program];
        }

        if($_GET[course]){
        $_SESSION[course]=$_GET[course];
        }

        if($_GET[year]){
        $_SESSION[year]=$_GET[year];
        }

        if($_GET[term]){
        $_SESSION[term]=$_GET[term];
        }
        if($_GET[level]){
        $_SESSION[levels]=$_GET[level];
        }

        // mount course
         if (isset($_POST['go'])){
              
             $course=$help->getCourse($_POST[course]);
             $type=$help->getCourseType($_POST[course]);
             $year=$notify->getyear();
             print_r($query=$sql->Prepare("INSERT INTO tpoly_mounted_courses SET  COURSE_NAME=".$sql->Param('a').", COURSE_CODE=".$sql->Param('b')."  , COURSE_CREDIT=".$sql->Param('c').", COURSE_SEMESTER=".$sql->Param('d').",COURSE_LEVEL=".$sql->Param('e').",COURSE_TYPE=".$sql->Param('f').",PROGRAMME=".$sql->Param('g')." ,LECTURER=".$sql->Param('h').",COURSE_YEAR=".$sql->Param('i').""));

           if( $query=$sql->Execute( $query,array($course,$_POST[course] ,$_POST[credit],$_POST[term],$_POST[level],$type,$_POST[program],$_POST[lecturer],$_POST[year]))){
              
              header("location:view_mounted_courses?success");
              }
         }
         if(isset($_POST[sync])){
             if($help->ping("www.google.com",80,20)){
             $string=$sql->Prepare($_SESSION[last_query]);
             $row2=$sql->Execute($string);
                                    
                while($row=$row2->FetchRow()){
                     set_time_limit(500);
                    $course_name= $row[COURSE_NAME] ;$course_code=$row[COURSE_CODE];$credit=$row[COURSE_CREDIT];$level=$row[COURSE_LEVEL];
                    $semester=$row[COURSE_SEMESTER];$year=$row[COURSE_YEAR];$program=$row[PROGRAMME];$lecturer=$row[LECTURER];$type=$row[COURSE_TYPE];

                     $ins=" COURSE_NAME='$course_name', COURSE_CODE='$course_code',  COURSE_CREDIT='$credit', COURSE_LEVEL='$level', COURSE_SEMESTER='$semester', COURSE_YEAR='$year', COURSE_TYPE='$type', PROGRAMME='$program', LECTURER='$lecturer'";
                      
                    $post = array('type'=>'mounted_courses','data'=>$ins,'user'=>$_POST['headings'],'pass'=>$_POST['footing']);
                    $result=$help->sync_to_online($url, $post);
                    if($result ){  
	
                   $query=$sql->Prepare("UPDATE tpoly_mounted_courses SET SYNC='1'  where ID='$row[ID]'");
                    if($sql->Execute($query)){
                        header("location:view_mounted_courses?success");
                    }
                       
	 
                    }
                }
                       
             }
             else{
                   header("location:view_mounted_courses?no_internet");
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
                                            <h4 class="modal-title">Course Mounting</h4>
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
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							Course Databank
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                    <form action="" method="post">
											 
                                                        <button type="submit" style="margin-left: -235px;"name="sync" class="btn btn-success">Sync to Online Portal<i class="fa fa-cloud-upload"></i></button>
                                                    </form>
                                                    <button  data-target="#mount"style="margin-top: -59px" data-toggle="modal" class="btn bgm-pink waves-effect">Mount Course<i class="fa fa-tasks"></i></button>
                                                 <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
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
                                        
                                  <table  width=" " border="0">
                    <tr>
                    <form action="" method="post">
                     
                	    <td width="20%">

                                    <select class='form-control'  name='subject'  style="margin-left:-38%; width:167% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?program='+escape(this.value);" >
                                <option value=''>Filter by programme</option>
                                        <option value='All programs'>All Programs</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT * FROM tpoly_programme");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[program]==$row['PROGRAMMECODE']){echo 'selected="selected"'; }?> value="<?php echo $row['PROGRAMMECODE']; ?>"        ><?php echo $row['PROGRAMME']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             <td>&nbsp;</td>
                             
				 <td width="25%">
                        <select class='form-control'  name='subject'  style="margin-left:57%; width:140% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?course='+escape(this.value);" >
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
      
                        </td>
                      <td>&nbsp;</td>
                                <td width="25%">
                                    <select class='form-control'  name='term'  style="margin-left:92%;  width:58% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?level='+escape(this.value);" >
                                         <option value=''>Filter by level</option>
                                        <option value='All level'>All Levels</option>
                                        <option value='50'<?php if($_SESSION[levels]=='50'){echo 'selected="selected"'; }?>>50</option>
                                            <option value='100'<?php if($_SESSION[levels]=='100'){echo 'selected="selected"'; }?>>100</option>
                                            <option value='200'<?php if($_SESSION[levels]=='200'){echo 'selected="selected"'; }?>>200</option>
                                        <option value='300'<?php if($_SESSION[levels]=='300'){echo 'selected="selected"'; }?>>300</option>
                                        <option value='400'<?php if($_SESSION[levels]=='400'){echo 'selected="selected"'; }?>>400</option>

                                    </select>

                            </td>
                             
                    <td>&nbsp;</td>
                      <td width="20%">

                        <select class='form-control'  name='term'  style="margin-left:92%;  width:58% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?term='+escape(this.value);" >
                                         <option value=''>Filter by semester</option>
                                        <option value='All terms'>All semesters</option>
                                            <option value='1'<?php if($_SESSION[term]=='1'){echo 'selected="selected"'; }?>>1st</option>
                                            <option value='2'<?php if($_SESSION[term]=='2'){echo 'selected="selected"'; }?>>2nd</option>
                                        <option value='3'<?php if($_SESSION[term]=='3'){echo 'selected="selected"'; }?>>3rd</option>

                                    </select>

                     </td>
                    <td>&nbsp;</td>
                    
                      
        
                    <td>

                       <!-- <div class="form-action ">
                                <button type="submit" name="submit" class="btn ink-reaction btn-raised btn-primary">Search</button>

                        </div> -->
                    </td>
        
                    </tr>  
                </form>
                </table>
                                    </div>
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							 
							<div class="tools">
							</div>
						</div>
			<div class="portlet-body">
                                            <?php 
                                            $program=$_SESSION[program];                                       
                                            $course=$_SESSION[course];
                                            $term=$_SESSION[term];
                                            $level=$_SESSION[levels];
                                            
                                            if($term=="All terms" or $term==""){ $term=""; }else {$term_=" and COURSE_SEMESTER = '$term' "  ;}
                                            if($level=="All level" or $level==""){ $level=""; }else {$level_=" and COURSE_LEVEL = '$level' "  ;}
                                            if($program=="All programs" or $program==""){ $program=""; }else {$program_=" and PROGRAMME = '$program' "  ;}
                                            if($course=="All Courses" or $course=="" ){ $course=""; }else {$course_=" and COURSE_CODE = '$course' "  ;}


                                            $query="SELECT  * FROM tpoly_mounted_courses  WHERE 1  $term_ $level_ $program_ $course_   ORDER BY COURSE_NAME ASC ";
                                            $_SESSION[last_query]=$query; 
                                                $page=new classes\OS_Pagination($query, $query) ;
                                                $stmt= $page->paginate() ;
                                            if($stmt->RecordCount()>0){
                                         ?>
                           
                    <div class="table-responsive">
                        <table   id="data-table-command" class="table table-striped table-vmiddle"  >
                            <thead>
                                <tr>
                                    
                                     <th  data-order="asc">NO</th>
                                     <th data-column-id="Course" data-type=" " data-toggle="tooltip">COURSE</th>
                                     <th data-column-id="Course Code" data-type=" " data-toggle="tooltip">CODE</th>
                                      <th data-column-id="Programme" data-type=" " data-toggle="tooltip">PROGRAMME</th> 
                                    <th style="text-align:center" data-type="string" data-column-id="Class" style="text-align:center">CREDIT</th>
                                   
                                    <th data-column-id="Level" data-order="asc" style="text-align:center">LEVEL</th>
                                    <th data-column-id="Semester" style="text-align:center">SEMESTER</th>
                                     <th data-column-id="Type">TYPE</th>
                                     
                                     <th data-column-id=" " data-order="" style="text-align: center" colspan="2">ACTIONS</th>
                                      
                                </tr>
                            </thead>
                            <p align="center"style="color:red">  <?php echo $stmt->RecordCount() ?> Records </p>
                            <tbody>
                                <?php
                                
                                   $count=0;
                                    while($rtmt=$stmt->FetchRow()){
                                                            $count++;
                                                        if($rtmt["COURSE_SEMESTER"]==1){
                                                            $sem="1st"; 
                                                        } 
                                                       elseif($rtmt["COURSE_SEMESTER"]==2){
                                                            $sem="2nd"; 
                                                        } 
                                                        else{$sem="3rd";}
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td style="text-align:left;text-transform: capitalize"><?php echo $help->getCourse( $rtmt[COURSE_CODE] )?></td>
                                    <td ><?php  echo $rtmt[COURSE_CODE] ; ?></td>
                                  <td style="text-transform: capitalize"><?php echo strtoupper($help->getProgram($rtmt[PROGRAMME])); ?></td> 
                                    <td style="text-align: center"><?php echo $rtmt["COURSE_CREDIT"] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["COURSE_LEVEL"] ?></td>
                                    <td style="text-align: center"><?php echo strtoupper($sem) ?></td>
                                    <td style="text-align: center"><?php echo strtoupper( $rtmt["COURSE_TYPE"]) ?></td>
                                     
                                    <td><a href=""><i style="color: green" class=" md-mode-edit">Edit</i></a></td>
                                    <td><a href=""><i style="color: red" class="md md-clear">Delete</i></a> </td>
                                      
                                     
                                    </tr>
                                    <?php }?>
                                     
                            </tbody>
                          </table>  
<br/>
                         <center><div class="pagination"> <?php echo $page->renderFullNav() ?> </div></center>
</div>
                                    <?php }else{
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                Oh snap! Something went wrong. No record to display! Please 
                            </div>";
             }?>
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
<?php include("_library_/_includes_/scripts.php");  ?>

<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   TableAdvanced.init();
});
</script>
<?php include("_library_/_includes_/export.php");  ?>
 

</html>