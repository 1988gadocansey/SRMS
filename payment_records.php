<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    $help=new _classes_\helpers();
     $notify=new _classes_\Notifications();
     if($_GET[program]){
        $_SESSION[program]=$_GET[program];
        }

        if($_GET[type]){
        $_SESSION[type]=$_GET[type];
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
        if($_GET[bank]){
        $_SESSION[bank]=$_GET[bank];
        }
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
        if (isset($_GET[delete])) {

            $query = $sql->Prepare("DELETE FROM tpoly_courses WHERE ID='$_GET[delete]'");
            if ($sql->Execute($query)) {
                header("location:view_courses?success=1");
            } else {
                header("location:view_courses?error=1");
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
                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Import Bulk Courses</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="view_courses.php" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">select csv file</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                          <input type="file" required="" class="form-control" name="name"  >                                     
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                        <button type="submit" name="import" class="btn btn-success">Save</button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
			 <!--//////////////////////////////////////////////////// -->
			 <div class="modal fade" id="course" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Statement</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="view_courses?add=1" method="POST" class="form-horizontal" role="form">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputEmail3"    class="col-sm-2 control-label">Name</label>
                                                         <div class="col-sm-10">
                                                             <div class="fg-line">
                                                                 <input type="text" class="form-control input-sm" id="" name="course"placeholder="course name" required="">
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Code</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <input type="text" name ="code" required="" class="form-control input-sm" id=" " placeholder="course code">
                                                             </div>
                                                         </div>
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Credit</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                <select class='form-control input-sm'  name='type'  style="  " required="" >
                                                                    <option value=''>select course type</option>
                                                                   
                                                                       <option value='Elective'<?php if($_SESSION[tedrm]=='1'){echo 'selected="selected"'; }?>>Elective</option>
                                                                       <option value='Core'<?php if($_SESSION[tderm]=='2'){echo 'selected="selected"'; }?>>Course</option>
                                                                   

                                                               </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">credit</label>
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
                                                      
                                                 </div>
                                             
                                        </div>
                                        <div class="modal-footer">          
                                            <button name="go" type="submit" class="btn btn-success">Save<i class="fa fa-save"></i></button>
                                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>

                                        </div>
                                   </form>
                                    </div>
                                </div>
                            </div>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
                                    <div><?php $notify->Message(); ?></div>
					<div class="note note-success note-bordered">
						<p>
							Course Folder
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                    
                                                    
                                                <button class="btn  btn-pink waves-effect waves-button"  data-target="#import" data-toggle="modal">import bank statement csv<i class="fa fa-file-excel-o"></i></button>
                                                 
                                                 <button   class="btn btn-success waves-effect waves-button dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
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
                                                  <form action="" method="post">
											 
                                                        <button  type="submit" style="margin-top:-11%;margin-left:-234px"name="sync" class="btn  btn-success waves-effect waves-button">Sync to Online Portal<i class="fa fa-cloud-upload"></i></button>
                                                    </form>
                                              </div>
                            
					</div>
                                    <div>
                                        
                                  <table  width=" " border="0">
                    <tr>
                    <form action="" method="post">
                     
                	    <td width="20%">

                                    <select class='form-control'  name='subject'  style="margin-left:-43%; width:130% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?program='+escape(this.value);" >
                                <option value=''>by programme</option>
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
                        <select class='form-control'  name='subject'  style="margin-left:-11%; width:57% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?bank='+escape(this.value);" >
                      <option value=''>Filter by Banks</option>
                              <option value='All Bank'>All Bank</option>
                          <?php 
                            global $sql;

                                $query2=$sql->Prepare("SELECT * FROM tpoly_banks ");


                                $query=$sql->Execute( $query2);


                             while( $row = $query->FetchRow())
                               {

                               ?>
                               <option <?php if($_SESSION[bank]==$row['NAME']){echo 'selected="selected"'; }?> value="<?php echo $row['NAME']; ?>"        ><?php echo $row['NAME']. " - ".$row['ACCOUNT_NUMBER']; ?></option>

                        <?php }?>
                            </select>
      
                        </td><td width="25%">
                        <select class='form-control'  name='subject'  style="margin-left:-53%; width:66% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?type='+escape(this.value);" >
                      <option value=''>by Payment types</option>
                              <option value='All type'>All Payment types</option>
                          <?php 
                            global $sql;

                                $query2=$sql->Prepare("SELECT DISTINCT PAYMENTDETAILS FROM tpoly_feedetails ");


                                $query=$sql->Execute( $query2);


                             while( $row = $query->FetchRow())
                               {

                               ?>
                               <option <?php if($_SESSION[type]==$row['PAYMENTDETAILS']){echo 'selected="selected"'; }?> value="<?php echo $row['PAYMENTDETAILS']; ?>"        ><?php echo $row['PAYMENTDETAILS']; ?></option>

                        <?php }?>
                            </select>
      
                        </td>
                      <td>&nbsp;</td>
                       <td width="20%">

                        <select class='form-control'  name='term'  style="margin-left:-109%;  width:61% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?year='+escape(this.value);" >
                                         <option value=''>by year</option>
                                          <option value='All year'>All years</option>
                                                  <?php
                                                                                                               for($i=2005; $i<=4000; $i++){
                                                                                                                       $a= $i;?>
                                                                                                                                <option <?php if($_SESSION[year]==$a){echo 'selected="selected"'; }?>value='<?php echo $a ?>'><?php echo $a ?></option>";

                                                                                                                    <?php    } ?>


                                                                                                        ?>
                                    </select>

                     </td>
                                <td width="25%">
                                    <select class='form-control'  name='term'  style="margin-left:-282%;  width:116% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?level='+escape(this.value);" >
                                         <option value=''>by level</option>
                                        <option value='All level'>All Levels</option>
                                        <option value='5'<?php if($_SESSION[levels]=='5'){echo 'selected="selected"'; }?>>50</option>
                                            <option value='1'<?php if($_SESSION[levels]=='1'){echo 'selected="selected"'; }?>>100</option>
                                            <option value='2'<?php if($_SESSION[levels]=='2'){echo 'selected="selected"'; }?>>200</option>
                                        <option value='3'<?php if($_SESSION[levels]=='3'){echo 'selected="selected"'; }?>>300</option>
                                        <option value='4'<?php if($_SESSION[levels]=='4'){echo 'selected="selected"'; }?>>400</option>

                                    </select>

                            </td>
                             
                    <td>&nbsp;</td>
                      <td width="20%">

                        <select class='form-control'  name='term'  style="margin-left:-898%;  width:390% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?term='+escape(this.value);" >
                                         <option value=''>by sem</option>
                                        <option value='All term'>All semesters</option>
                                            <option value='1'<?php if($_SESSION[term]=='1'){echo 'selected="selected"'; }?>>1st</option>
                                            <option value='2'<?php if($_SESSION[term]=='2'){echo 'selected="selected"'; }?>>2nd</option>
                                        <option value='3'<?php if($_SESSION[term]=='3'){echo 'selected="selected"'; }?>>3rd</option>

                                    </select>

                     </td>
                    <td>&nbsp;</td>
                  <form action="" method="post" >
                      <td width="25%">
                          
                                                         
                          <input type="text" name ="search" placeholder="search here"required="" style="margin-left:-546%;  width:620% " class="form-control" id=" "  >
                                                             
                      </td>
                      <td>&nbsp;</td>
                       <td width="25%">
                           <select class='form-control'  name='content' required="" placeholder="search here" style="margin-left:12%;  width:412% "  >
                                         <option value=''>search by</option>
                                         
                                        <option value='INDEXNO'<?php if($_SESSION[status]=='INDEXNO'){echo 'selected="selected"'; }?>>Index No</option>
                                        <option value='PROGRAMMECODE'<?php if($_SESSION[status]=='PROGRAMMECODE'){echo 'selected="selected"'; }?>>Program</option>
                                        <option value='YR'<?php if($_SESSION[status]=='LEVEL'){echo 'selected="selected"'; }?>>Level</option>

                                    </select>

                      </td>
                       
                      <td>&nbsp;</td>
                      <td width="25%">
                            <button type="submit"  name="go" style="margin-left:105%;width: 81px " class="btn btn-success">Search <i></button>
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
			<div class="portlet-body table-responsive basic-table" >
                                            <?php 
                                           $program=$_SESSION[program];                                       
                                                $bank=$_SESSION[bank];
                                                $type=$_SESSION[type];
                                                $level=$_SESSION[levels];
                                                $year=$_SESSION[year];
                                                 $term=$_SESSION[term];
                                                $search=$_POST[search];
                                                $content=$_POST[content];
                                            

                                                if($level=="All level" or $level==""){ $level=""; }else {$level_=" and  YR = '$level' "  ;}
                                                if($program=="All programs" or $program==""){ $program=""; }else {$program_="and PROGRAMMECODE = '$program' "  ;}
                                                if($type=="All type" or $type=="" ){ $type=""; }else {$type_=" and PAYMENTDETAILS = '$type' "  ;}
                                                if($year=="All year" or $year=="" ){ $year=""; }else {$year_=" and ACADYEAR = '$year' "  ;}
                                                if($bank=="All bank" or $bank=="" ){ $bank=""; }else {$bank_=" and BANK = '$bank' "  ;}
                                                if($term=="All term" or $term=="" ){ $term=""; }else {$term_=" and SEM = '$term' "  ;}
                                                if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '$search' "  ;}


                                            $query="SELECT  * FROM tpoly_feedetails  WHERE 1  $term_ $level_ $program_ $bank_ $type_ $year_ $search_  ORDER BY TRANSDATE ASC ";
                                             
                                               $_SESSION[last_query]=$query; 
                                                 $rs= $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                if (!$rs->EOF) 
                                                {
                                             ?>
                           
                    <div class="table-responsive">
                        <table   id="data-table-command" class="table table-striped table-vmiddle"  >
                            <thead>
                                <tr>
                                    
                                     <th  data-order="asc">NO</th>
                                       <th data-column-id="Course" data-type=" "style="text-align:center" data-toggle="tooltip">PIC</th>
                                     <th data-column-id="Course" data-type=" " data-toggle="tooltip">STUDENT</th>
                                    
                                      <th data-column-id="Programme" data-type=" " data-toggle="tooltip">PROGRAMME</th> 
                                    
                                    <th data-column-id="Level" data-order="asc" style="text-align:center">LEVEL</th>
                                    
                                    <th data-column-id="Semester" style="text-align:center">SEMESTER</th>
                                     <th data-column-id="Type" style="text-align:center">YEAR</th>
                                     <th data-column-id="Type" style="text-align:c r">BANK</th>
                                     <th data-column-id="Type" style="text-align:center">PAYMENT TYPE</th>
                                    <th data-column-id="Type" style="text-align:">PAYMENT PLACE</th>
                                    <th data-column-id="Type" style="text-align:center">RECEIPT NO.</th>
                                    <th data-column-id="Type" style="text-align:center">AMOUNT</th>
                                     <th data-column-id=" " data-order="" style="text-align: center" colspan="2">ACTIONS</th>
                                      
                                </tr>
                            </thead>
                            <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                            <tbody>
                                <?php
                                
                                   $count=0;
                                    while($rtmt=$rs->FetchRow()){
                                                            $count++;
                                                        if($rtmt["LEVEL"]==1){
                                                            $sem="1st"; 
                                                        } 
                                                       elseif($rtmt["LEVEL"]==2){
                                                            $sem="2nd"; 
                                                        } 
                                                        else{$sem="3rd";}
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td><a href="addStudent.php?indexno=<?php echo $rtmt[INDEXNO] ?>"><img <?php echo $help->picture("photos/students/$rtmt[INDEXNO].JPG",90)  ?>     src="<?php echo file_exists("photos/students/$rtmt[INDEXNO].JPG") ? "photos/students/$rtmt[INDEXNO].JPG":"photos/students/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                     <td ><?php  echo $rtmt[INDEXNO] ; ?></td>
                                      <td style="text-transform: capitalize"><?php echo  $help->getProgram($rtmt[PROGRAMMECODE]); ?></td> 
                                     <td style="text-align:left;text-transform: capitalize"><?php echo $rtmt[YR] ?></td>
                                      <td style="text-align:left;text-transform: capitalize"><?php echo $sem ?></td>
                                       <td ><?php  echo $rtmt[ACADYEAR] ; ?></td>
                                       <td style=""><?php  echo $rtmt[BANK] ; ?></td>
                                  <td style="text-transform: capitalize"><?php echo  $rtmt[PAYMENTTYPE]; ?></td> 
                                    <td style="text-align:  "><?php echo $rtmt["PAYMENTPLACE"] ?></td>
                                    
                                    <td style="text-align: center"><?php echo $rtmt["RECEIPTNO"]  ?></td>
                                    <td style="text-align: center"><?php echo   $rtmt["FEES"] ?></td>
                                     
                                    
                                    <td><a href="view_courses?delete=<?php  echo $rtmt[ID] ; ?>" onclick="return confirm('Are you sure you want to delete this record??')"><i style=" " class="md md-delete">Delete</i></a> </td>
                                     
                                     
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