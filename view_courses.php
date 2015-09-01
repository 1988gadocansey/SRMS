<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    $help=new _classes_\helpers();
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
				<h4>Welcome <small>Start here</small></h4>
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
							Course Databank
						</p>
                                                <div style="margin-top:-3%;float:right">
                                                    <button id="sample_editable_1_new" class="btn green">
											Add New Course <i class="fa fa-plus"></i>
											</button>
                                                    <button class="btn btn-success"><i class="fa fa-cloud-upload"></i>Sync to Online Portal</button>
                                                <button class="btn btn-primary"><i class="fa fa-upload"></i>import course</button>
                                                 <button   class="btn btn-primary waves-effect waves-button dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'csv',escape:'false'});"><img src='img/icons/csv.png' width="24"/> CSV</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'txt',escape:'false'});"><img src='img/icons/txt.png' width="24"/> TXT</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'powerpoint',escape:'false'});"><img src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                                <li><a href="#" onClick ="$('#data-table-command').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li>
                                              </ul>
                                              </div>
                            
					</div>
                                    <div>
                                        
                                  <table  width=" " border="0">
                    <tr>
                    <form action="" method="post">
                     
                	    <td width="20%">

                                    <select class='form-control'  name='subject'  style="margin-left:0%; width:167% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?program='+escape(this.value);" >
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

                        <select class='form-control'  name='term'  style="margin-left:55%;  width:58% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?term='+escape(this.value);" >
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
                                            $progrm=$_SESSION[program];                                       
                                            $course=$_SESSION[course];
                                            $term=$_SESSION[term];
                                            $level=$_SESSION[levels];
                                            
                                            if($term=="All terms" or $term==""){ $term=""; }else {$term_=" and COURSE_SEMESTER = '$term' "  ;}
                                            if($level=="All level" or $level==""){ $level=""; }else {$level_=" and COURSE_LEVEL = '$level' "  ;}
                                            if($program=="All programs" or $program==""){ $program=""; }else {$program_=" and PROGRAMME = '$progrm' "  ;}
                                            if($course=="All Courses" or $course=="" ){ $course=""; }else {$course_=" and COURSE_CODE = '$course' "  ;}


                                            $query="SELECT  * FROM tpoly_courses  WHERE 1  $term_ $level_ $program_ $course_   ORDER BY COURSE_NAME ASC ";
                                            
                                                $page=new classes\OS_Pagination($query, $query) ;
                                                $stmt= $page->paginate() ;
                                            if($stmt->RecordCount()>0){
                                         ?>
                           
                    <div class="table-responsive">
                        <table id="data-table-command" class="table table-bordered table-vmiddle table-hover"  >
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
                                     
                                     <th data-column-id=" " data-order="" style="text-align:center" colspan="2">Actions</th>
                                      
                                </tr>
                            </thead>
                            <p align="center"style="color:red">Total Records - <?php echo $stmt->RecordCount() ?></p>
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
                                     <td><?php echo $rtmt[COURSE_NAME] ?></td>
                                    <td style="text-align:left"><?php  echo $rtmt[COURSE_CODE] ; ?></td>
                                    <td><?php echo $help->getProgram($rtmt[PROGRAMME]); ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["COURSE_CREDIT"] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["COURSE_LEVEL"] ?></td>
                                    <td style="text-align: center"><?php echo $sem ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["COURSE_TYPE"] ?></td>
                                     
                                    <td><a href=""><i class="fa fa-edit"></i>Edit</a><a href=""><i class="fa fa-trash">Delete</i></a> </td>
                                      
                                     
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

 
<?php include("_library_/_includes_/export.php");  ?>
 

</html>