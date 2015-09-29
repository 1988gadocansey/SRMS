<?php  
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    require '_library_/_includes_/app_config.inc';
    set_time_limit(1500);
 $help=new _classes_\helpers();
     $notify=new _classes_\Notifications();
     $condition=$notify->getyear();
     $term=$condition->TERM;
     $year=$condition->YEAR;
   $query=$sql->Prepare("SELECT INDEXNO,LEVEL,`PROGRAMMECODE` FROM tpoly_students WHERE HAS_PASSWORD='0'");
         $query1=$sql->Execute($query);
         
          $output=$query1->RecordCount();
         $query2=$sql->Prepare("SELECT INDEXNO,LEVEL,`PROGRAMMECODE` FROM tpoly_students WHERE HAS_PASSWORD='0'");
         $query2_=$sql->Execute($query2); 
         for($y=0;$y<$output;$y++){

             
                  while( $output1 = $query1->FetchRow()){
                    extract($output1);
                      $password= $help->password();
                      $encrypted_password=md5($password);
                      $student_index=$INDEXNO;
                      $level=$LEVEL;
                      $program2=   $PROGRAMMECODE;
                      $program=  $help->getProgram($program2);
                     $year=$condition[YEAR];
                      $term=$condition[TERM];
                     $query=$sql->Prepare("INSERT INTO tpoly_log_portal (USERNAME,PASSWORD,REAL_PASSWORD,PROGRAMME,LEVEL,YEAR,SEMESTER) VALUES('$student_index','$encrypted_password','$password','$program','$level','$year','$term')") ;
                        if( $sql->Execute($query)){
                             $stmt=$sql->Prepare("UPDATE tpoly_students SET HAS_PASSWORD='1' WHERE INDEXNO='$INDEXNO'");
                                if($sql->Execute($stmt)){
                                    header("portal_passwords?success=1");
                                }
                        }
                }
         }