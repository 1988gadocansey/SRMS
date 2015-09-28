<?php
    ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
   $sms=new _classes_\smsgetway();
   
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    if(isset($_POST[sms])){
         $q=$_SESSION[last_query];
        $query=$sql->Prepare($q);
        $rt=$sql->Execute($query);
        
        While($stmt=$rt->FetchRow()){
            $arrayphone=$stmt[TELEPHONENO];
        
        if($a=$sms->sendSMS1($arrayphone, $_POST[message])){
            $_SESSION[last_query]="";
        
            header("location:students?success=1");
            
            }
        }
    }
    if($_GET[program]){
        $_SESSION[program]=$_GET[program];
        }

        if($_GET[course]){
        $_SESSION[course]=$_GET[course];
        }
        
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }

        if($_GET[year]){
        $_SESSION[year]=$_GET[year];
        }
        if($_GET[status]){
        $_SESSION[status]=$_GET[status];
        }
        if($_GET[nation]){
        $_SESSION[nation]=$_GET[nation];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
        }
        if($_GET[level]){
        $_SESSION[levels]=$_GET[level];
        }

        // mount course
        
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
			 <div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Send SMS</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="students" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">Message</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                 <textarea required="" class="form-control" name="message" rows="9" ></textarea>                                    
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="sms" class="btn btn-success">Send <i class="fa fa-sm"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
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
                            <?php $notify->Message();  ?>
				<div class="col-md-12">
					<div class="note note-success note-bordered">
						<p>
							Students
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                    <form action="" method="post">
											 
                                                        <button type="submit" style="margin-left: -235px;"name="sync" class="btn btn-success">Sync to Online Portal<i class="fa fa-cloud-upload"></i></button>
                                                    </form>
                                                    <button  style="margin-top: -59px"   class="btn bgm-pink waves-effect"  data-target="#sms"  data-toggle="modal">Send SMS<i class="fa fa-mobile-phone"></i></button>
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
                     
                     
                             <td width="20%">

                                    <select class='form-control select2_sample1'  name='subject'  style="margin-left:-45%; width:137% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?program='+escape(this.value);" >
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
                                    <select class='form-control'  name='term'  style="margin-left:-1%;  width:26% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?level='+escape(this.value);" >
                                         <option value=''>Filter by level</option>
                                        <option value='All level'>All Levels</option>
                                        <option value='50'<?php if($_SESSION[levels]=='50'){echo 'selected="selected"'; }?>>50</option>
                                            <option value='100'<?php if($_SESSION[levels]=='100'){echo 'selected="selected"'; }?>>100</option>
                                            <option value='200'<?php if($_SESSION[levels]=='200'){echo 'selected="selected"'; }?>>200</option>
                                        <option value='300'<?php if($_SESSION[levels]=='300'){echo 'selected="selected"'; }?>>300</option>
                                        <option value='400'<?php if($_SESSION[levels]=='400'){echo 'selected="selected"'; }?>>400</option>

                                    </select>

                            </td>
                    <td width="25%">
                                   <select class='form-control' style="margin-left:-73%;  width:72% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?nation='+escape(this.value);"     >
                                       <option value=''>Filter by Nationalities</option>
                                        <option value='All nation'>All Nationalities</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM tbl_country");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['Name']; ?>"   <?php if($rows->NATIONALITY==$row['Name']){echo "selected='selected'";} ?>      ><?php echo $row['Name']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                            </td>     
                    <td>&nbsp;</td>
                      <td width="20%">

                        <select class='form-control'  name='term'  style="margin-left:-126%;  width:66% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?year='+escape(this.value);" >
                                         <option value=''>Filter by year group</option>
                                          <option value='All year'>All year groups</option>
                                                  <?php
                                                                                                               for($i=2008; $i<=4000; $i++){
                                                                                                                       $a=$i - 1 ."/". $i;?>
                                                                                                                                <option <?php if($_SESSION[year]==$a){echo 'selected="selected"'; }?>value='<?php echo $a ?>'><?php echo $a ?></option>";

                                                                                                                    <?php    } ?>


                                                                                                        ?>
                                    </select>

                     </td>
                     <td>&nbsp;</td>
                                <td width="25%">
                                    <select class='form-control'  name='term'  style="margin-left:-316%;  width:139% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?status='+escape(this.value);" >
                                         <option value=''>Filter by status</option>
                                        <option value='All status'>All status</option>
                                        <option value='1'<?php if($_SESSION[status]=='1'){echo 'selected="selected"'; }?>>Alumni</option>
                                        <option value='2'<?php if($_SESSION[status]=='2'){echo 'selected="selected"'; }?>>Deffered</option>
                                        <option value='3'<?php if($_SESSION[status]=='3'){echo 'selected="selected"'; }?>>Dead</option>
                                        <option value='4'<?php if($_SESSION[status]=='4'){echo 'selected="selected"'; }?>>Suspended</option>
                                        <option value='5'<?php if($_SESSION[status]=='5'){echo 'selected="selected"'; }?>>Rasticated</option>

                                    </select>

                     </td>
                      <td>&nbsp;</td>
                      <td width="25%">
                                    <select class='form-control'  name='term'   style="margin-left:-1001%;  width:478% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>Filter by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='M'<?php if($_SESSION[gender]=='M'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='F'<?php if($_SESSION[gender]=='F'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                      </td>
                      <td>&nbsp;</td>
                  <form action="students.php" method="post" >
                      <td width="25%">
                          
                                                         
                          <input type="text" name ="search" placeholder="search here"required="" style="margin-left:-585%;  width:618% " class="form-control" id=" "  >
                                                             
                      </td>
                      <td>&nbsp;</td>
                       <td width="25%">
                           <select class='form-control'  name='content' required="" style="margin-left:-56%;  width:478% "  >
                                         <option value=''>search by</option>
                                        
                                        <option value='SURNAME'<?php if($_SESSION[content]=='SURNAME'){echo 'selected="selected"'; }?>>Surname</option>
                                        <option value='FIRSTNAME'<?php if($_SESSION[status]=='FIRSTNAME'){echo 'selected="selected"'; }?>>First Name</option>
                                        <option value='INDEXNO'<?php if($_SESSION[status]=='INDEXNO'){echo 'selected="selected"'; }?>>Index No</option>
                                        <option value='PROGRAMMECODE'<?php if($_SESSION[status]=='PROGRAMMECODE'){echo 'selected="selected"'; }?>>Program</option>
                                        <option value='LEVEL'<?php if($_SESSION[status]=='LEVEL'){echo 'selected="selected"'; }?>>Level</option>

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
                                                $program=$_SESSION[program];                                       
                                                $course=$_SESSION[course];
                                                $gender=$_SESSION[gender];
                                                $level=$_SESSION[levels];
                                                $year=$_SESSION[year];
                                                $nation=$_SESSION[nation];
                                                $status=$_SESSION[status];
                                                $search=$_POST[search];
                                                $content=$_POST[content];
                                            

                                                if($level=="All level" or $level==""){ $level=""; }else {$level_=" and  LEVEL = '$level' "  ;}
                                                if($program=="All programs" or $program==""){ $program=""; }else {$program_="and PROGRAMMECODE = '$program' "  ;}
                                                if($gender=="All gender" or $gender=="" ){ $gender=""; }else {$gender_=" and SEX = '$gender' "  ;}
                                                if($year=="All year" or $year=="" ){ $year=""; }else {$year_=" and GRADUATING_GROUP = '$year' "  ;}
                                                if($nation=="All nation" or $nation=="" ){ $nation=""; }else {$nation_=" and COUNTRY = '$nation' "  ;}
                                                if($status=="All status" or $status=="" ){ $status=""; }else {$status_=" and STATUS = '$status' "  ;}
                                                if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '$search' "  ;}


                                                 $query="SELECT  * FROM tpoly_students   where 1 $program_  $level_  $search_ $gender_ $nation_ $status_ $year_" ;
                                               $_SESSION[last_query]=$query; 

                                                 $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                if (!$rs->EOF) 
                                     {
                                             ?>
                           
                    <div class="table-responsive">
                        <table  id="data-table-command" class="table table-striped table-vmiddle table-condensed"  >
                            <thead>
                                <tr>
                                    
                                     <th>NO</th>
                                     <th style="text-align: center">PIC</th>
                                     <th >INDEX</th>
                                      <th>NAME</th> 
                                      <th>PROGRAM</th>
                                   
                                      <th>LEVEL</th>
                                      <th>GENDER</th>
                                      <th>AGE</th>
                                      <th>PHONE</th>
                                     
                                      <th>NATIONALITY</th>
                                      <th>YEAR GROUP</th>
                                      <th>STATUS</th>
                                       <th>BILL</th>
                                      <th>CGPA</th>
                                       <th>ACTION</th>
                                      
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
                                     <td><a href="addStudent.php?indexno=<?php echo $rtmt[INDEXNO] ?>"><img <?php echo $help->picture("photos/students/$rtmt[INDEXNO].JPG",90)  ?>     src="<?php echo file_exists("photos/students/$rtmt[INDEXNO].JPG") ? "photos/students/$rtmt[INDEXNO].JPG":"photos/students/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                     <td style="text-align:left;text-transform: capitalize"><?php echo $rtmt[INDEXNO] ?></td>
                                    <td ><?php  echo $rtmt[SURNAME].", ".$rtmt[FIRSTNAME]." ".$rtmt[OTHERNAMES] ; ?></td>
                                    <td ><?php  echo $help->getProgram($rtmt[PROGRAMMECODE]) ; ?></td>
                                    <td  ><?php echo $rtmt[LEVEL]; ?></td> 
                                    <td style="text-align: center"><?php echo $rtmt["SEX"] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt[AGE] ?></td>
                                    <td style="text-align: center"><?php echo $rtmt["TELEPHONENO"] ?></td>
                                    <td style="text-align: "><?php echo $rtmt["COUNTRY"] ?></td>
                                    <td style="text-align:  "><?php echo   $rtmt["GRADUATING_GROUP"] ?></td>
                                    <td style="text-align:  "><?php echo $rtmt[STATUS]?></td>
                                      
                                     <td style="text-align:  "><?php echo $rtmt["0"] ?></td>
                                      <td style="text-align:  "><?php echo $rtmt["CGPA"] ?></td>
                                      <td style="text-align:left;width:  "><i class="md md-print" title="Print transcript"></i></td>
                                    </tr>
                                    <?php }?>
                                     
                            </tbody>
                          </table>  
                    <br/>
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