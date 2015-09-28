<?php
    ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
   
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    $condition = $notify->getyear();
    $year = $condition->YEAR;
    $semester = $condition->TERM;
     $student= new _classes_\Student();
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }

        if($_GET[student_type]){
        $_SESSION[student_type]=$_GET[student_type];
        }
        if($_GET[bill_type]){
        $_SESSION[bill_type]=$_GET[bill_type];
        }

        if($_GET[year]){
        $_SESSION[year]=$_GET[year];
        }

        if($_GET[semester]){
        $_SESSION[term]=$_GET[semester];
        }
        if($_GET[bill_status]){
        $_SESSION[bill_status]=$_GET[bill_status];
        
        
        
        }
              // creating bills
  if(isset($_GET['sub'])){
   $type=$_POST['type']; 
   $description=$_POST['description'];
    $bill_type=$_POST['bill_type'];
    $level=$_POST['level'];
    $resident=$_POST['resident'];
    $nationality=$_POST['nationality'];
    $program=$_POST['program'];
    $amount=$_POST['amount'];

    $query="insert into tpoly_bill_manager (type,description,stuType,level,amount,nationality,program,bill_type,semester,year) VALUES('$type', '$description','$resident',  '$level','$amount','$nationality','$program','$bill_type', '$semester','$year')";

   $stmt=$sql->Prepare($query);  
    if($sql->Execute($stmt)){
        header("location:bill.php?success=1");
    }

  }
  /*
   * Deleting bills , if bills is pending its only deleted from the bills table
   * else it is update to 0 as pending again and the amount of the bill is 
   * subtracted from the respective students
   */
  if(isset($_GET[delete])){
      //$amount=$_GET[amount];
      
     
      if($_GET['stat']=="Pending"){
             
            print_r($query=$sql->Prepare("DELETE FROM tpoly_bill_manager WHERE id='$_GET[delete]'"));

            if($sql->Execute($query)){
                header("location:bill.php?success=1");
            }
           
      }
      elseif($_GET['stat']=="Applied "){
          // do bulk reverse /update on student table with the weight of the bills
           
              $query2=$sql->Prepare("SELECT id,sex,amount,nationality,type,level,bill_type,stuType,semester,year,program,semester FROM tpoly_bill_manager WHERE Applied='0' AND id='$_GET[applied]'");
      $query1=$sql->Execute($query2);
      while($row=$query1->FetchRow()){
         $amount=$row[amount];
          $type=$row[type];
          $level= $row[level];
          $resident=$row[stuType];
          $student_category=$row[bill_type]; // continuing or freshers
          $year=$row[year];
          $semester=$row[semester];
          $program=$row[program];
            $nationality=$row[nationality];
          if($program!="All program"){
              $program="AND PROGRAMMECODE='$program'";
          }
          else{
              $program="";
          }
           if($level!="All level"){
              $level="AND LEVEL='$level'";
          }
          else{
              $level="";
          }
            if($resident!="All resident"){
              $resident="AND STUDENT_TYPE='$resident'";
          }else{
               $resident="";
          }
           if($student_category!="All category"){
              $student_category="AND STATUS='$student_category'";
          }else{
               $student_category="";
          }
          if($nationality!="All nation"){
              $nationality="AND NATIONALITY='$nationality'";
          }else{
               $nationality="";
          }
          if($type=='Academic'){
              $amount_acadmic=$amount;
          }
          else{
              $others=$amount;
          }
          
          $total_bill=$amount_acadmic+$others;
          if($row[level]!="all"){
          
         print_r( $query=$sql->Prepare("UPDATE tpoly_students SET BILLS=BILLS-'$total_bill',OTHERS=OTHERS-'$others' WHERE LEVEL='$level' $program $student_type $resident $nationality"));
          
         print_r( $stmt=$sql->Prepare("UPDATE tpoly_bill_manager SET Applied='0' WHERE id='$row[id]' "));
           $a= $sql->Execute($query);
           $b=$sql->Execute($stmt);
            if($a && $b ){
                header("location:bill.php?success=1");
               }
          }
          else{
              $level_= $student->gettotal_by_level($level);
              for($i=0;$i<$level_;$i++){
              //$total_bill=$amount_pta+$amount_acadmic+$others;
              $sentinel=$level_;
                print_r( $query=$sql->Prepare("UPDATE tpoly_students SET BILLS=BILLS-'$total_bill',OTHERS=OTHERS-'$others' WHERE LEVEL='$sentinel'"));
                $a= $sql->Execute($query);
                
              }
                print_r( $stmt=$sql->Prepare("UPDATE tpoly_bill_manager SET Applied='0' WHERE id='$row[id]' "));
              
               $b=$sql->Execute($stmt);
               if($a && $b ){
                header("location:bill.php?success=1");
               }
          }
        }
      }
  }
  /*
   * Affecting the created bills to respective students
   */
   if(isset($_GET[applied])){
       
   print_r(   $query2=$sql->Prepare("SELECT id,sex,amount,type,nationality,level,bill_type,stuType,semester,year,program,semester FROM tpoly_bill_manager WHERE Applied='0' AND id='$_GET[applied]'"));
      $query2_=$sql->Execute($query2);
      while($row=$query2_->FetchRow()){
          $amount=$row[amount];
          $type=$row[type];
          $level= $row[level];
          $resident=$row[stuType];
          $student_category=$row[bill_type]; // continuing or freshers
          $year=$row[year];
          $semester=$row[semester];
          $program=$row[program];
          $nationality=$row[nationality];
          if($nationality!="All nation"){
              $nationality="AND NATIONALITY='$nationality'";
          }else{
               $nationality="";
          }
          if($program!="All program"){
              $program="AND PROGRAMMECODE='$program'";
          }
          else{
              $program="";
          }
           if($level!="All level"){
              $level="AND LEVEL='$level'";
          }
          else{
              $level="";
          }
            if($resident!="All resident"){
              $resident="AND STUDENT_TYPE='$resident'";
          }else{
               $resident="";
          }
           if($student_category!="All category"){
              $student_category="AND STATUS='$student_category'";
          }else{
               $student_category="";
          }
          if($type=='Academic'){
              $amount_acadmic=$amount;
          }
          else{
              $others=$amount;
          }
          
          if($row[level]!="all"){
          $total_bill= $amount_acadmic+$others;
         print_r( $query=$sql->Prepare("UPDATE tpoly_students SET BILLS=BILLS+'$total_bill',OTHERS=OTHERS+'$others' WHERE LEVEL='$level' $program $resident $nationality $student_category"));
        // print_r( $query_=$sql->Prepare("UPDATE tbl_classes SET academic_fee=academic_fee+'$amount_acadmic',pta_fees=pta_fees+'$amount_pta',others=others+'$others' WHERE name='$level' AND semester='$semester' AND year='$year'"));
         print_r( $stmt=$sql->Prepare("UPDATE tpoly_bill_manager SET Applied='1' WHERE id='$row[id]' "));
           $a= $sql->Execute($query);
           $b=$sql->Execute($stmt);
            if($a && $b ){
                header("location:bill.php?success=1");
               }
          }
          else{
              $level_= $student->gettotal_by_level($level);
              for($i=0;$i<$level_;$i++){
              $total_bill=$amount_acadmic+$others;
              $sentinel=$level;
                print_r( $query=$sql->Prepare("UPDATE tpoly_students SET BILLS=BILLS+'$total_bill', OTHERS=OTHERS+ '$others' WHERE LEVEL='$sentinel'"));
                $a= $sql->Execute($query);
                
              }
                print_r( $stmt=$sql->Prepare("UPDATE tpoly_bill_manager SET Applied='1' WHERE id='$row[id]' "));
              
               $b=$sql->Execute($stmt);
               if($a && $b ){
                header("location:bill.php?success=1");
               }
          }
          
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
			 <div class="modal fade" id="bill" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Bill</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="bill?sub=1" method="POST" class="form-horizontal" role="form">
                                                 <div class="card-body card-padding">
                                                      <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Bill type</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select required=""class='form-control'  onClick="beginEditing(this);" onBlur="finishEditing();"    name="type"  >
                                                                     <option>-select-</option>
                                                                     <option value='Academic'>Academic</option>
                                                                     <option value="PTA">PTA</option>
                                                                     <option value="Others">Others</option> 
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Student categories</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select required=""class='form-control'       name="bill_type"  >
                                                                     <option>-select-</option>
                                                                     <option value="All">All students</option>
                                                                     <option value='Fresh Students'>Fresh Students</option>
                                                                     <option value="Continuing Students">Continuing Students</option>
                                                                      
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                               
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <input class="form-control" name="description" required=""/>
                                                             </div>
                                                         </div>
                                                     </div>
                                                      
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Amount</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <input class="form-control" name="amount" required=""/>
                                                             </div>
                                                         </div>
                                                     </div>
                          
                                                     <div class="form-group">
                                                         <label for="inputEmail3"    class="col-sm-2 control-label">Level</label>
                                                         <div class="col-sm-10">
                                                             <div class="fg-line">
                                                                 <select class='form-control'  name='level' required=""  >
                                                            <option value=''>Filter by level</option>
                                                           <option value='All'>All Levels</option>
                                                           <option value='50'<?php if($_SESSION[lesvels]=='50'){echo 'selected="selected"'; }?>>50</option>
                                                               <option value='100'<?php if($_SESSION[lesvels]=='100'){echo 'selected="selected"'; }?>>100</option>
                                                               <option value='200'<?php if($_SESSION[lesvels]=='200'){echo 'selected="selected"'; }?>>200</option>
                                                           <option value='300'<?php if($_SESSION[lesvels]=='300'){echo 'selected="selected"'; }?>>300</option>
                                                           <option value='400'<?php if($_SESSION[lsevels]=='400'){echo 'selected="selected"'; }?>>400</option>

                                                       </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Program</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control select2_sample1' required=""  name='program'>
                                                                <option value=''>Filter by programme</option>
                                                                        <option value='All'>All Programs</option>
                                                                    <?php 
                                                                      global $sql;

                                                                          $query2=$sql->Prepare("SELECT * FROM tpoly_programme");


                                                                          $query=$sql->Execute( $query2);


                                                                       while( $row = $query->FetchRow())
                                                                         {

                                                                         ?>
                                                                         <option <?php if($_SESSION[prograsm]==$row['PROGRAMMECODE']){echo 'selected="selected"'; }?> value="<?php echo $row['PROGRAMMECODE']; ?>"        ><?php echo $row['PROGRAMME']; ?></option>

                                                                  <?php }?>
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Student Residential Status</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control'   required=""    name="resident"  >
                                                                     <option value=''>select student types</option>
                                                                     <option value="All">All students</option>
                                                                     <option value="1">Residents</option>
                                                                     <option value="0">Non Residents</option>
                                                                         <!-- comes through ajax -->
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Nationality</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                 <select class='form-control'   required=""    name="nationality"  >
                                                                     <option value=''>select nationality</option>
                                                                     <option value="All">All students</option>
                                                                     <option value="Ghanaian">Ghanaian</option>
                                                                     <option value="Foriegners">Foriegners</option>
                                                                         
                                                                      </select>
                                                             </div>
                                                         </div>
                                                     </div>
                                                      
                                                 </div>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning">Save changes</button>
                                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                   </form>
                                    </div>
                                </div>
                            </div>
			                 
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
                                      <?php $notify->Message();  ?>
					<div class="note note-success note-bordered">
						<p>
							Prepare Bills
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                     
                                                    <button  style="margin-top: -2px"  data-target="#bill"  data-toggle="modal"  class="btn bgm-pink waves-effect">Create Bill<i class="fa fa-plus-circle"></i></button>
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

                                    <select class='form-control select2_sample1'  name='subject'  style="margin-left:-43%; width:137% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?program='+escape(this.value);" >
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
                                 <select class='form-control'   id='stssatus' name="clssass"   style="margin-left:-1%;  width:50%" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?bill_type='+escape(this.value);">
                                  
                                          <option value='All bill types'>All bill types</option>
                                      <?php 
                                global $sql;

                                      $query2=$sql->Prepare("SELECT DISTINCT type FROM tpoly_bill_manager");


                                      $query=$sql->Execute( $query2);


                                   while( $row = $query->FetchRow())
                                     {

                                     ?>
                                     <option value="<?php echo $row['type']; ?>"  <?php if($_SESSION[bill_type]==$row['type']){echo 'selected="selected"'; }?>      ><?php echo $row['type']; ?></option>

                               <?php }?>
                                        </select>
      
                     </td>
                               
                             
		<td width="25%">
                    <select class='form-control'  name='student_type'  style="margin-left:-50%; width:61% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?student_type='+escape(this.value);" >
                      
                                        <option value='All Students'>All Students Types</option>
                                            <option value='Fresh'<?php if($_SESSION[student_type]=='Fresh'){echo 'selected="selected"'; }?>>Freshers</option>
                                            <option value='Continuing Student'<?php if($_SESSION[student_type]=='Continuing Student'){echo 'selected="selected"'; }?>>Continuing Student</option>
                                         
                            </select>
      
                 </td>
                 <td width="25%">
                    <select class='form-control'  name='student_type'  style="margin-left:-88%; width:52% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?nationality='+escape(this.value);" >
                      
                                        <option value='All nationality'>All nationalities</option>
                                            <option value='Fresh'<?php if($_SESSION[nation]=='Foriegners'){echo 'selected="selected"'; }?>>Foriegners</option>
                                            <option value='Continuing Student'<?php if($_SESSION[nation]=='Ghanaian'){echo 'selected="selected"'; }?>>Ghanaians</option>
                                         
                            </select>
      
                 </td>
                  <td width="25%">
                    <select class='form-control'  name='student_type'  style="margin-left:-638%; width:230% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?resident='+escape(this.value);" >
                      
                                        <option value='All resident'>All Residents</option>
                                            <option value='Resident'<?php if($_SESSION[resident]=='Resident'){echo 'selected="selected"'; }?>>Resident</option>
                                            <option value='Non Resident'<?php if($_SESSION[resident]=='Non Resident'){echo 'selected="selected"'; }?>>Non Resident</option>
                                         
                            </select>
      
                 </td>
                 <td width="25%">
                    <select class='form-control'  name='student_type'  style="margin-left:-1023%; width:381% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?bill_status='+escape(this.value);" >
                      
                                         <option value='All Bill Status'>Bill status</option>
                                            <option value='1'<?php if($_SESSION[bill_status]=='1'){echo 'selected="selected"'; }?>>Applied Bill</option>
                                            <option value='0'<?php if($_SESSION[bill_status]=='0'){echo 'selected="selected"'; }?>>Pending Bill</option>
                                         
                     </select>
      
                 </td>
                      
                     
                      <td width="25%">
                                    <select class='form-control'  name='semester'  style="margin-left:-727%;width:414% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?level='+escape(this.value);" >
                                         <option value=''>Filter by level</option>
                                        <option value='All level'>All Levels</option>
                                        <option value='50'<?php if($_SESSION[levels]=='50'){echo 'selected="selected"'; }?>>50</option>
                                            <option value='100'<?php if($_SESSION[levels]=='100'){echo 'selected="selected"'; }?>>100</option>
                                            <option value='200'<?php if($_SESSION[levels]=='200'){echo 'selected="selected"'; }?>>200</option>
                                        <option value='300'<?php if($_SESSION[levels]=='300'){echo 'selected="selected"'; }?>>300</option>
                                        <option value='400'<?php if($_SESSION[levels]=='400'){echo 'selected="selected"'; }?>>400</option>

                                    </select>

                            </td>
                      <td>&nbsp;&nbsp;&nbsp</td>
                      <td width="20%">

                          <select class="form-control"   id='statuss'style="margin-left:-442%;width:486%" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?semester='+escape(this.value);">
                              <option value="All Terms">-select semester--</option>
                              <option value="1" <?php if($_SESSION[term]=='1'){echo 'selected="selected"'; }?>>1st semester</option>
                              <option value="2" <?php if($_SESSION[term]=='2'){echo 'selected="selected"'; }?>>2nd semester</option>
                              <option value="3" <?php if($_SESSION[term]=='3'){echo 'selected="selected"'; }?>>3rd semester</option>
                          </select>

                      </td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp</td>
                    <td width="20%" >

                        <select class="form-control"   name='year'  style="margin-left:-82%;width: 518%  " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?year='+escape(this.value);" >
                                         <option value=''>  by academic year</option>
                                        <option value='All Years'>All Years</option>
                                             <?php
                                                                                                               for($i=2008; $i<=4000; $i++){
                                                                                                                       $a=$i - 1 ."/". $i;?>
                                                                                                                                <option <?php if($_SESSION[year]==$a){echo 'selected="selected"'; }?>value='<?php echo $a ?>'><?php echo $a ?></option>";

                                                                                                                    <?php    } ?>


                                                                                                        ?>
                                    </select>

                      </td>
        
                    </tr>  
                  
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
              
                $level=$_SESSION[classes];
                $semester=$_SESSION[semester];
               
                $bill_type=$_SESSION[bill_type];
                $bill_status=$_SESSION[bill_status];
                $student_type=$_SESSION[student_type];
                $nationality=$_SESSION[nationality];
                $year=$_SESSION[year];
                if($semester=="All Terms" or $semester==""){ $semester=""; }else {$semester=" and  semester = '$semester' "  ;}
                if($student_type=="All Students" or $student_type==""){ $inse=""; }else {$inse=" and stuType = '$student_type' "  ;}
                if($year=="All Years" or $year==""){ $yr=""; }else {$yr=" and year = '$year' "  ;}
                if($bill_type=="All bill types" or $bill_type==""){ $bill=""; }else {$bill=" and type = '$bill_type' "  ;}
                if($bill_status=="All Bill Status" or $bill_status==""){ $ins=""; }else {$ins=" and Applied = '$bill_status' "  ;}
                if($level=="All Classes" or $level=="" ){ $in=""; }else {$in=" and level = '$level' "  ;}
                $query="SELECT * FROM tpoly_bill_manager where 1 $semester $inse $ins $in $bill $yr";
                  
             
               print_r( $_SESSION[last_query]=$query); 

                                                 $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                if (!$rs->EOF) 
                                     {
                                              echo "<br/><p align='center' style='color:red;font-weight:bold'>Total Record(s) - " .$recordsFound."
                  <hr></hr><p>";
             ?>
              
                    <div class="table-responsive">
                        <table id="data-table-command" class="table table-striped table-vmiddle table-condensed"  >
                            <thead>
                                <tr>
                                    
                                    <th>No</th>
                                        <th data-column-id="ID" visible='false'  style='display:none' data-toggle="tooltip">ID</th>
                                        <th data-column-id="Type"   data-toggle="tooltip">Bill Type</th>
                                        <th data-column-id="Subject" data-type=" " data-toggle="tooltip">Bill Description</th>
                                        <th data-column-id="Subject" data-type=" " data-toggle="tooltip">Programme</th>
                                        <th style="text-align:center" data-type="string" data-column-id="Class" style="text-align:center">Level</th>

                                        <th data-column-id="Gender" data-order="asc" style="text-align:center">Resident Type</th>
                                        <th data-column-id="Subject" data-type=" " data-toggle="tooltip">Nationality</th>
 
                                        <th data-column-id="Status" data-order="asc" >Status</th>
                                        <th data-column-id="semester" data-order="asc" style="text-align:center">Term</th>
                                        <th data-column-id="year" data-order="asc" style="text-align:center">Year</th>
                                         <th data-column-id="Total Students" data-order="asc" style="text-align:center">Total Students</th>
                                        <th data-column-id="Amount" data-order="asc" >Amount</th>
                                       
                                        <th data-column-id="Total amount" data-order="asc" style="text-align:center">Total Accrued Amount</th>
                                        <th  data-column-id="link" data-levelatter="link" colspan="2" style="text-align: center" colspan="2">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $count=0;
                                   $pupil=0;
                                     while($rtmt=$rs->FetchRow()){
                                                            $count++;
								$total+=$rtmt[amount];	
                                                                if($rtmt[Applied]==1){
                                                                    $status="<span class='color-block bgm-green'>Applied</span>";
                                                                    $stat="Applied";
                                                                }
                                                                else{
                                                                    $status="<span class='fc-title'>Pending</span>";
                                                                    $stat="Pending";
                                                                }
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td style="display:none"><?php echo $rtmt[id] ?></td>
                                    <td style="text-align:left"><?php  echo $rtmt[type]; ?></td>
                                    <td><?php echo $rtmt[description] ?></td>
                                    <td><?php echo $help->getProgram($rtmt[program]) ?></td>
                                    <td><?php  echo   $rtmt[level]  ?></td>
                                    <td><?php echo $rtmt[stuType] ?></td>
                                    <td><?php echo $rtmt[nationality] ?></td>
                                     <td><?php echo $status ?></td>
                                     <td> <?php echo ($rtmt[semester]); ?> </td>
                                     <td> <?php echo ($rtmt[year]); ?> </td>
                                  
                                   
                                    <td><?php  if($rtmt[level]!="all"  || $rtmt[program]!="All program" ){ $level=$student->getTotalStudent_by_Class($rtmt[level],$rtmt[program]);echo $level;}else{$level=$student->getTotalStudent();echo $level;}$pupil+=$level; ?></td>
                                     <td><?php $amt+=$rtmt[amount];echo $rtmt[amount] ?></td>
                                    
                                     <td ><?php echo $level*$rtmt[amount];$truetotal+=($level*$rtmt[amount]); ?></td>
                                      
                                     
                                     <td style="text-align: center"> <a href="bill?delete=<?php echo ($rtmt[id]); ?>&&stat=<?php echo $stat; ?>&&type=<?php echo $rtmt[type]; ?>&&amount=<?php echo $rtmt[amount]; ?>&&form=<?php echo $rtmt[level]; ?>">  <i class="fa fa-trash" title="delete bill" onclick="return confirm('Are you sure you want to delete this bill?')"></i></a> </td>
                                     <td style="text-align: center"> <a href="bill?applied=<?php echo ($rtmt[id]); ?>">  <i class="fa fa-paperclip" title="Apply this bill" onclick="return confirm('Are you sure you want to apply this bill?')"></i></a> </td>
                                    </tr> 
                           
              <?php 
				  
                  } ?>
              <tr bgcolor="#FF9800" bordercolor="#AED7FF" >
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                 <td >&nbsp;</td>
                     <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                
                
                 
                <td width="130"  ><div align="center" class="style9">Total </div></td>
               
                 <td><div align="centerh"><strong><?php echo $pupil ?>&nbsp;</strong></div></td>

                 <td><?php echo number_format($amt, 2, '.', ',') ?></td>
                
                  
                 <td  ><strong><?php echo number_format($truetotal, 2, '.', ',') ?></strong></td>
                 
                </tr>    
                                     
                                    
                            </tbody>
                          </table>
                         
                    </div>
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