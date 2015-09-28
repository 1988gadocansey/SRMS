<?php
    ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
   
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    
     
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }

        if($_GET[department]){
        $_SESSION[department]=$_GET[department];
        }
        if($_GET[status]){
        $_SESSION[status]=$_GET[status];
        }
        if($_GET[position]){
        $_SESSION[position]=$_GET[position];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
        }
         if($_GET[grade]){
        $_SESSION[grade]=$_GET[grade];
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
							Staff Data
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                     
                                                    <button  style="margin-top: -2px"   class="btn bgm-pink waves-effect">Send SMS<i class="fa fa-mobile-phone"></i></button>
                                                 <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -2px" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
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
                     
                     
                             <td width="20%">

                                    <select class='form-control select2_sample1'  name='subject'  style="margin-left:-43%; width:137% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?department='+escape(this.value);" >
                                <option value=''>Filter by department</option>
                                        <option value='All department'>All departments</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT * FROM tpoly_department");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[department]==$row['DEPTCODE']){echo 'selected="selected"'; }?> value="<?php echo $row["DEPTCODE"]; ?>"        ><?php echo $row['DEPARTMENT']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             
				 
                      <td>&nbsp;</td>
                 
                    <td width="25%">
                                   <select class='form-control' style="margin-left:-2%;  width:86% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?position='+escape(this.value);"     >
                                       <option value=''>Filter by Position</option>
                                        <option value='All position'>All Positions</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM tpoly_position");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['id']; ?>"   <?php if($_SESSION[position]==$row['id']){echo "selected='selected'";} ?>      ><?php echo $row['position']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                            </td>     
                            <td width="20%">
             
             
                     <select  class='form-control' style="margin-left:51%;Width:80%"   onchange="document.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?grade='+escape(this.value);">
                                             
                                    <option value=''>Select grade</option>
                                    <option value='All grade'>All</option>

                                    <?php 
                           global $sql;

                                 $query2=$sql->Prepare("SELECT id, grade FROM tpoly_workersgrade");


                                 $query=$sql->Execute( $query2);


                              while( $row = $query->FetchRow())
                                {

                                ?>
                                <option value="<?php echo $row['id']; ?>"   <?php if($_SESSION[grade]==$row['id']){echo "selected='selected'";} ?>><?php echo $row['grade']; ?></option>

                          <?php }?>
                        </select>

             
        </td>
                     <td>&nbsp;</td>
                                <td width="25%">
                                    <select class='form-control'  name='term'  style="margin-left:28%;  width:52% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?status='+escape(this.value);" >
                                         <option value=''>Filter by status</option>
                                        <option value='All status'>All status</option>
                                        <option value='1'<?php if($_SESSION[status]=='1'){echo 'selected="selected"'; }?>>On Leave</option>
                                        <option value='2'<?php if($_SESSION[status]=='2'){echo 'selected="selected"'; }?>>In office</option>
                                        <option value='3'<?php if($_SESSION[status]=='3'){echo 'selected="selected"'; }?>>Dead</option>
                                        <option value='4'<?php if($_SESSION[status]=='4'){echo 'selected="selected"'; }?>>Suspended</option>
                                       

                                    </select>

                     </td>
                      <td>&nbsp;</td>
                      <td width="25%">
                                    <select class='form-control'  name='term'   style="margin-left:-478%;  width:131% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>Filter by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='M'<?php if($_SESSION[gender]=='M'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='F'<?php if($_SESSION[gender]=='F'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                      </td>
                      <td>&nbsp;</td>
                                <form action="staff" method="post" >
                      <td width="25%">
                          
                                                         
                          <input type="text" name ="search" placeholder="search here"required="" style="margin-left:-585%;  width:618% " class="form-control" id=" "  >
                                                             
                      </td>
                      <td>&nbsp;</td>
                       <td width="25%">
                           <select class='form-control'  name='content' required="" style="margin-left:-56%;  width:478% "  >
                                         <option value=''>search by</option>
                                        
                                        <option value='surname'<?php if($_SESSION[content]=='surname'){echo 'selected="selected"'; }?>>Surname</option>
                                        <option value='Name'<?php if($_SESSION[content]=='Name'){echo 'selected="selected"'; }?>>First Name</option>
                                        <option value='emp_number'<?php if($_SESSION[content]=='emp_number'){echo 'selected="selected"'; }?>>Staff ID</option>
                                         
                                    </select>

                      </td>
                      <td>&nbsp;</td>
                      <td width="25%">
                            <button type="submit" name="go" style="margin-left:105%;width: 81px " class="btn btn-primary">Go</button>
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
                                                
                                                $gender=$_SESSION[gender];
                                                $department=$_SESSION[department];
                                             
                                                $position=$_SESSION[position];
                                                $status=$_SESSION[status];
                                                 $grade=$_SESSION[grade];
                                                $search=$_POST[search];
                                                $content=$_POST[content];
                                            

                                                if($department=="All department" or $department==""){ $department=""; }else {$department_=" and  DEPARTMENT = '$department' "  ;}
                                                if($grade=="All grade" or $grade==""){ $grade=""; }else {$grade_="and grade = '$grade' "  ;}
                                                if($gender=="All gender" or $gender=="" ){ $gender=""; }else {$gender_=" and sex = '$gender' "  ;}
                                           
                                                if($position=="All position" or $position=="" ){ $position=""; }else {$position_=" and position = '$position' "  ;}
                                                if($status=="All status" or $status=="" ){ $status=""; }else {$status_=" and empStatus = '$status' "  ;}
                                                if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '$search' "  ;}


                                                 $query="SELECT  * FROM tpoly_workers   where 1 $grade_  $department_  $search_ $gender_ $position_ $status_   ORDER BY `designation` DESC" ;
                                              print_r( $_SESSION[last_query]=$query); 

                                                 $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                if (!$rs->EOF) 
                                     {
                                             ?>
                           
                    <div class="table-responsive">
                        <table  id="data-table-command" class="table table-striped table-vmiddle"  >
                            <thead>
                                <tr>
                                    
                                        <th>NO</th>
                                        <th style="text-align: center">PIC</th>
                                        <th>STAFF ID</th>
                                        <th>TITLE</th>
                                        <th>NAME</th> 
                                        <th>DESIGNATION</th>
                                        <th>GENDER</th>
                                        <th>AGE</th>

                                        <th>MARITAL STATUS</th>
                                        <th>PHONE</th>
                                        <th>DATE HIRED</th>
                                        <th>EMAIL</th>
                                        <th>DEPARTMENT</th>
                                        <th>STATUS</th>
                                        <th>GRADE</th>
                                        <th>POSITION</th>
                                      
                                </tr>
                            </thead>
                            <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                            <tbody>
                                <?php
                                
                                   $count=0;
                                    while($rtmt=$rs->FetchRow()){
                                                            $count++;
                                                         
                                                         
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td><a href="addstaff.php?no=<?php echo $rtmt[ids] ?>"><img <?php echo $help->picture("photos/workers/$rtmt[emp_number].JPG",90)  ?>       src="<?php echo file_exists("photos/workers/$rtmt[emp_number].jpg") ? "photos/workers/$rtmt[emp_number].JPG":"photos/workers/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                     <td style="text-align:left;text-transform: capitalizes"><?php echo $rtmt[emp_number] ?></td>
                                    <td  ><?php echo $rtmt[title]; ?></td>
                                     <td ><?php  echo $rtmt[surname].", ".$rtmt[Name]." ".$rtmt[OTHERNAMES] ; ?></td>
                                    
                                    <td  ><?php echo $rtmt[grade]; ?></td> 
                                    <td style="text-align: center"><?php echo $rtmt[sex] ?></td>
                                    <td style="text-align: center"><?php echo $help->age(date('d/m/Y', $rtmt[dob]),'eu'); ?></td>
                                    
                                    <td style="text-align: "><?php echo $rtmt[marital] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt[phone] ?></td>
                                    <td style="text-align:  "><?php echo   date("d/m/Y",$rtmt[dateHired]); ?></td>
                                    <td style="text-align:  "><?php echo $rtmt[email]?></td>
                                      
                                    <td style="text-align:  "><?php echo $help->getdepartment($rtmt[department]) ?></td>
                                      <td style="text-align:  "><?php echo $rtmt[empStatus] ?></td>
                                      <td style="text-align:  "><?php echo $rtmt[grade] ?></td>
                                     <td style="text-align:  "><?php echo $rtmt[position] ?></td>
                                    </tr>
                                    <?php }?>
                                     
                            </tbody>
                          </table>  
                   <center><?php
                         $GenericEasyPagination->setTotalRecords($recordsFound);
	  
                        echo $GenericEasyPagination->getNavigation();
                        echo "<br>";
                        echo $GenericEasyPagination->getCurrentPages();
                      ?></center>

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
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>

<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   
});
</script>
<?php include("_library_/_includes_/export.php");  ?>
 

</html>