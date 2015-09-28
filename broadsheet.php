<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    
    $help=new _classes_\helpers();
    $notify=new _classes_\Notifications();
    $security=new _classes_\cryptCls();
    $year=$_GET[year];
    $level=$_GET[level];
    $sem=$_GET[sem];
    $course=$_GET[course];
    if(isset($_POST[submit])){
    // for grade guild table -- it represents the values set for calculations
          // sets for each course in a term and in an academic year
                  $qu1=$_POST[quiz1];
		  $qu2=$_POST[quiz2];
		  $qu3=$_POST[quiz3];
		  $qu4=$_POST[quiz4];
                   $stmt=$sql->Prepare("select id from tbl_gradesguide where year='$sem' and term='$sem' and course='".$course."' and level='".$level."'");
            
                  $stmt=$sql->Execute($stmt);
                  if($stmt->RecordCount()>0){
                      $stmt_=$sql->Prepare("Update tbl_gradesguide set quiz1='$qu1',quiz2='$qu2',quiz3='$qu3' ,quiz4='$qu4' where year='$year' and term='$sem' and course='".$course."'  and level='".$level."'");
                        $sql->Execute($stmt_);
                   }
                   else{
                        $stmt_=$sql->Prepare("insert into  tbl_gradesguide set quiz1='$qu1',quiz2='$qu2',quiz3='$qu3' ,quiz4='$qu4',  year='$year'  ,term='$sem' ,course='".$course."',   level='".$level."'");
                        $sql->Execute($stmt_);
                   }
            /// ////////////////////////////////////////////////////////////
             // grade table area //
            ////////////////////////////////////////////////////////////////
           $count=$_POST[counter];
           $student_id=$_POST[stuid];
           $indexno=$_POST[indexno];
           $quiz1=$_POST[q1];
           $quiz2=$_POST[q2];
           $quiz3=$_POST[q3];
            $quiz4=$_POST[q4];
           $exam=$_POST[exam];
           $sixty=$_POST[sixty];
           $grade_value=$_POST[grade];
           $comment=$_POST[comment];
           for($i=0;$i<$count;$i++){
               // getting each array
                $student_id_=$student_id[$i];
                $indexno_=$indexno[$i];
                $grade_value_=$grade_value[$i];
                
                $quiz1_=number_format($quiz1[$i], 2, '.', ',');
                $quiz2_=number_format($quiz2[$i], 2, '.', ',');
                $quiz3_=number_format($quiz3[$i], 2, '.', ',');
                $quiz4_=number_format($quiz4[$i], 2, '.', ',');
                $exam_=number_format($exam[$i], 2, '.', ',');
                $sixty_=number_format($sixty[$i], 2, '.', ',');
                 $total=(($quiz1_+ $quiz2_+ $quiz3_+$quiz4_)/100 * 40 )+ $sixty_;
                 ////////////////////////////////////////////
                //update students total score in that class for that year inside the class records which is == to the total of all scores in all courses taken in that year
	       //first select the total of total scores of all scores in all subject in that year
                
                    
                    
                    $rtmt=$sql->Prepare("UPDATE tpoly_academic_records SET quiz1='$quiz1_',quiz2='$quiz2_',quiz3='$quiz3_',quiz4='$quiz4_',exam='$exam_',total='$total',  grade='$grade_value_' WHERE stuId='$indexno_'") ;
                    $sql->Execute($rtmt);
                    
                    // if the student have E,F then update the issue in student table showing that he has an issue
                    if($help->getGradeValue($total)=="F9" || $help->getGradeValue($total)=="E8" ){
                        $issue=1;
                        $query=$sql->Prepare("UPDATE tpoly_students SET ISSUES=ISSUES + '$issue' WHERE INDEXNO='$indexno_'");
                    
                       if($query->Execute($query)){
                           
                           header("location:class_list?success=1");
                       }
                    }
                     
                  
      
               }
           
          }
          
          //////////////////////////////////////////////////////////////////////
          // upload excel csv result starts here  ie using the parsecsv library//
          //////////////////////////////////////////////////////////////////////
         if(isset($_POST['import'])){	

             
              	//check if file path is empty
            $extension= end(explode(".", basename($_FILES['file']['name'])));
            // check if file is csv
             if($extension== 'csv'){

                    if (!$_FILES["file"]["name"]) {
                       echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                       $error = 1;
                   }

                   $name = $_FILES["file"]["name"];
                   //$var= $name.$_SESSION[area];

                   
           

               $destination = "upload/$name.csv";
               move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
               if (move_uploaded_file) {

                   # create new parseCSV object.
                   $csv = new parseCSV();
       # Parse '_books.csv' using automatic delimiter detection...
                   $csv->auto($destination);


                   //print_r($csv->data);

                   foreach ($csv->data as $key => $row) { {

                           $s1 = "Quiz1($qz1)";
                           $s2 = "Quiz2($qz2)";
                           $s3 = "Quiz3($qz3)";
                           $s4 = "Qui4($qz4)";
       //$exam=number_format($_POST[$], 1, '.', ',');
                           $quiz1 = number_format($row[$s1], 1, '.', ',');
                           $quiz1 = number_format($row[$s2], 1, '.', ',');
                           $quiz1 = number_format($row[$s3], 1, '.', ',');
                           $exam = number_format($row['Exam'] * .70, 1, '.', ',');
                           $indexno = $row[IndexNo];



                           $tot = $quiz1 + $exam;


                           //update grades in quizes and exam and total

                         $query=$sql->Prepare( "select id from tpoly_academic_records where stuId='$indexno' and coursecode='$courseid' and level='$level'  and year='$year' and term='$sem'");
                         $stmt=$sql->Execute($query);

                           if ($stmt->RecordCount()==1) {
                               $query=$sql->Prepare("update tpoly_academic_records set quiz1='$quiz1',quiz2='$quiz2',quiz4='$quiz3',quiz4='$quiz4',exam='$exam',total='$tot' where  stuId='$indexno' and coursecode='$courseid' and level='$level' and term='$sem'");
                              if($sql->Execute($query)){
                                  header("location:class_list?success=1");
                              }

                           }

                       }
                  }
             }
           
         }
         
           
         header("location:class_list?file=error");
         
         
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
                                            <h4 class="modal-title">Import Grades</h4>
                                        </div>
                                        <div class="modal-body">
                                            <a href="uploads/tpoly_academic_records">click to view csv template</a>
                                            <form action="class_list" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
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
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
                                      <div><?php $notify->Message(); ?></div>
					<div class="note note-success note-bordered">
						<p>
							Class List
						</p>
                                                <div style="margin-top:-2.2%;float:right">
                                                     
                                                    <button  data-target="#import"style="margin-top:0px" data-toggle="modal" class="btn bgm-pink waves-effect">Upload grades from excel(csv)<i class="fa fa-file-excel-o"></i></button>
                                                 <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: 0px" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                            
                                                <li class="divider"></li>
                                                <li><a href="#" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});"><img src='assets/icons/xls.png' width="24"/> XLS</a></li>
                                                 
                                                <li><a href="#" onClick ="$('#assesment').tableExport({type:'pdf',escape:'false'});"><img src='assets/icons/pdf.png' width="24"/> PDF</a></li>
                                              </ul>
                                              </div>
                            
					</div>
                                     
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							 
							<div class="tools">
							</div>
						</div>
                                                <div class="portlet-body">
                                                    
                       <form action="" method="post">
                        <div  class="table-responsive">
                          <center><table id="assesment" class="table table-striped table-vmiddle" style="width:90%" >
                            <thead>
                            <th style="text-align: center">#</th>
                            <th style="text-align:  ">INDEX NO</th>
                            <th>STUDENT</th>
                             <?php 
                            
                            $stmt=$sql->Prepare("select * from tbl_gradesguide where year='$year' and term='$sem' and course='$course' and level='$level'") ;
                            $stmt=$sql->Execute($stmt);
                            while($row=$stmt->FetchRow()){
                                $quiz1=$row["quiz1"];
                                $quiz2=$row["quiz2"];
                                $quiz3=$row["quiz3"];
                                $quiz4=$row["quiz4"];
                            }
                            ?>
                            <th style="text-align: center" ><div align="center">
                                <label for="quiz1"></label>
                                <input name="quiz1" type="text" style="width:62%" id="quiz1" size="2" value="<?php echo $quiz1; ?>" />
                              </div></th>
                              <th style="text-align: center" ><div align="center">
                                <input name="quiz2" type="text" style="width:62%" id="quiz2" size="2" value="<?php echo $quiz2; ?>" />
                              </div></th>
                              <th style="text-align: center" ><div align="center">
                                  <input name="quiz3" type="text" style="width:62%" id="quiz3" size="2" value="<?php echo $quiz3; ?>"/>
                              </div></th>
                               <th style="text-align: center" ><div align="center">
                                  <input name="quiz4" type="text" style="width:62%" id="quiz4" size="2" value="<?php echo $quiz4; ?>"/>
                              </div></th>
                               <th style="text-align: center" >Total Class score</th>
                              <th style="text-align: center" >40% Class score</th>
                              <th style="text-align: center" >Exam Score</th>
                              <th style="text-align: center" >60% </th>
                              <th style="text-align: center" >Total (40% + 60%)</th>
                              <th style="text-align: center" >Grade</th>
                             
                               
                            </thead>
                            <tbody>
                                <?php
                                  $query=$sql->Prepare("SELECT    tpoly_academic_records.id AS id,total, stuId ,tpoly_students.INDEXNO AS stid,tpoly_students.SURNAME AS surname,tpoly_students.OTHERNAMES AS othernames,tpoly_students.FIRSTNAME AS fname ,quiz1,quiz2,quiz3,quiz4,total,exam FROM tpoly_students,tpoly_academic_records,tpoly_mounted_courses where tpoly_academic_records.year='$_GET[year]' AND tpoly_academic_records.level='$_GET[level]' AND tpoly_academic_records.term='$_GET[sem]' AND  tpoly_academic_records.stuId=tpoly_students.INDEXNO AND tpoly_academic_records.coursecode=tpoly_mounted_courses.COURSE_CODE AND tpoly_academic_records.level=tpoly_mounted_courses.COURSE_LEVEL AND tpoly_mounted_courses.COURSE_CODE='$_GET[course]'  ");
                                  $_SESSION[last_query]=$query; 
                                                 $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                 $recordsFound = $rs->_maxRecordCount;    // total record found
                                                $count=0;
                                    while($rt=$rs->FetchRow()){
                                                            $count++;
                                    $count++;
                                    ?>
                                    <input type="hidden" value="<?php echo $recordsFound; ?>" name="counter"/>
                                     <input type="hidden" name="indexno[]" id="stu" value="<?php echo $rt[stid];?>" />
                                     <input type="hidden" name="stuid[]" id="idd" value="<?php echo $rt[stid];?>" />
                                    <tr>
                                        <td style="text-align: center"><?php echo $count ?></td>
                                        <td style="text-align:  "><?php echo $rt[stid] ?></td>
                                        <td style="text-align: left"><?php echo $rt[surname].",".$rt[fname]." ".$rt[othernames] ?></td>
                                        <td style="text-align: center"><input name="q1[]"  onblur="return check(this.id,'quiz1')" type="text" id="q1<?php echo $thecounter ?>" size="5" maxlength="4" value="<?php echo $rt[quiz1]; ?>" /></td>
                                        <td style="text-align: center"> <input name="q2[]"  onblur="return check(this.id,'quiz2')" type="text" id="q2<?php echo $thecounter ?>" size="5" maxlength="4" value="<?php echo $rt[quiz2]; ?>" /></td>
                                        <td style="text-align: center"><input name="q3[]"  onblur="return check(this.id,'quiz3')" type="text" id="q3<?php echo $thecounter ?>" size="5" maxlength="4" value="<?php echo $rt[quiz3]; ?>" /></td>
                                        <td style="text-align: center"><input name="q4[]"  onblur="return check(this.id,'quiz4')" type="text" id="q4<?php echo $thecounter ?>" size="5" maxlength="4" value="<?php echo $rt[quiz4]; ?>" /></td>
                                        <td style="text-align: center"><div align="center"><strong><?php echo ($rt[quiz1]+$rt[quiz2]+$rt[quiz3]+$rt[quiz4]); ?></strong></td>
                                        <td style="text-align: center"><div align="center"><strong><?php   $forty=(($rt[quiz1]+$rt[quiz2]+$rt[quiz3]+$rt[quiz4])/100 * 40);echo $forty ?></strong></td>
                                        <td style="text-align: center"><input name="exam[]" type="text" onblur="return check70(this.id)" id="exam<?php echo $thecounter ?>" size="10" maxlength="4" value="<?php echo $rt[exam] ?>" /></td>
                                        
                                        <td style="text-align: center"><div align="center"><strong><input type="hidden" value="<?php  $six= (($rt[exam])/100) * 60; echo $six ?>" name="sixty[]"><?php echo ($rt[exam])/100 * 60 ?></strong></div></td>
                                        <td style="text-align: center"><div align="center"><strong><?php echo   $six + $forty//($rt[total]); ?></strong></td>
                                        <td style="text-align: center"><?php $rmt= $help->getGradeValue($rt[total]); echo $rmt->GRADE ?><input type="hidden" name="grade[]" value="<?php  echo $rmt->GRADE ?>"/></td>
                                         
                                       
                                     </tr>
                                <?php }?>
                            </tbody>
                          </table>
                            <br/>
                               
                              <center><div style=" ;  bottom: 0px;left: 43%  ">
                                <p >
                                  <input type="hidden" name="upper" value="<?php echo $count++;?>" id="upper" />
                                  <label>
                                    <input  type="submit" name="submit" id="submit" class="btn btn-success" value="UPDATE RECORDS" />
                                    </label>
                                  <label>
                                    <input type="submit" name="button" id="button" class="btn btn-warning" value="RESET" />
                                    </label>
                                </p>
                                  </div></center>
                          </form>
						</div>
                                             <center><?php
                                 $GenericEasyPagination->setTotalRecords($recordsFound);

                                echo $GenericEasyPagination->getNavigation();
                                echo "<br>";
                                echo $GenericEasyPagination->getCurrentPages();
                              ?></center>
					 
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