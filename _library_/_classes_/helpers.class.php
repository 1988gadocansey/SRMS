<?php
/**
 * Description of helpers
 * 
 * @author Administrator
 */
namespace _classes_;
 
class helpers {
	private $connect;
     public function __construct() {
           global $sql,$season;
           $this->connect=$sql;
		   
          
     }
   public  function nextyear($currenyear){
        $pp=explode("/",$currenyear);
        //echo $pp[0];

        return $pp[1]."/".($pp[1]+1);
        }
      public function buildall($data){
	 
	
	$all=explode(',',$data);
          foreach($all as $dd){
                  $dd=trim($dd);


          }
	  
          return $dd;
	}
	public function getExamType($exam_code){
		
    $query= $this->connect->Prepare("SELECT * FROM tbl_waec_exam_type WHERE id='$exam_code'");
    $output= $this->connect->Execute($query);
	 $a=$output->FetchNextObject();
    return $a->EXAM_TYPE;
      
    }
	   
    public function age($birthdate, $pattern = 'eu')
        {
            $patterns = array(
                'eu'    => 'd/m/Y',
                'mysql' => 'Y-m-d',
                'us'    => 'm/d/Y',
                'gh'    => 'd-m-Y',
            );

            $now      = new \DateTime();
            $in       = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
            $interval = $now->diff($in);
            return $interval->y;
        }
       public function picture($path,$target){
                if(file_exists($path)){
                        $mypic = getimagesize($path);

                 $width=$mypic[0];
                        $height=$mypic[1];

                if ($width > $height) {
                $percentage = ($target / $width);
                } else {
                $percentage = ($target / $height);
                }

                //gets the new value and applies the percentage, then rounds the value
                 $width = round($width * $percentage);
                $height = round($height * $percentage);

               return "width=\"$width\" height=\"$height\"";



            }else{}
        
       
        }
        
        
	public function pictureid($stuid){
	 
	 return str_replace('/','',$stuid);
	 }
 
public function yearsDifference($endDate, $beginDate)
{
   $date_parts1=explode("-", $beginDate);
   $date_parts2=explode("-", $endDate);
   return $date_parts2[0] - $date_parts1[0];
}

// send sms
public  function sendtxt($message,$phone,$type,$name) 
{ 

global $sql;
set_time_limit  (500);
if(is_numeric($phone) and $message){

if($_SESSION['connected']>=0 and $_SESSION['connected']!='down') 
{ 
$themassage=urlencode($message);
$url="http://powertxtgh.com/access.php?company=ALOT&ccode=ALT101&sender=Gad&message=$themassage&recipient=$phone";

$f=@fopen($url,"r"); 

$date=time();
	 $insertor=$this->connect->Prepare("insert into sent set number='$phone',type='$type',name='$name',message='$message',dates='$date',status='Delivered'");
	 $insertor->Execute($insertor) ;
	
fclose($f); 
return true; 
} else{
		$date=time();

	 $insertor=$this->connect->Prepare("insert into sent set number='$phone',type='$type',name='$name',message='$message',dates='$date',status='Not Delivered'");
	 $insertor->Execute($insertor) ;
	
return false; }
}} 

public function ping($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return "down"; } 
  $tA = microtime(true); 
  return round((($tA - $tB) * 1000), 0)." ms"; 
}


public function getSession($preference){
    $query=  $this->connect->Prepare("SELECT * FROM tbl_session WHERE ID='$preference'");
    $output= $this->connect->Execute($query);
    $a->FetchNextObject();
    return $a->name;
}

public function getProgram($pcode){
    $query=$this->connect->Prepare("SELECT * FROM tpoly_programme WHERE PROGRAMMECODE='$pcode'");
    $output= $this->connect->Execute($query);
     $a=$output->FetchNextObject() ;
    return $a->PROGRAMME;
}
public function getCourse($code){
    $query=$this->connect->Prepare("SELECT COURSE_CODE FROM tpoly_courses WHERE COURSE_CODE='$code'");
    $output= $this->connect->Execute($query);
     $a=$output->FetchNextObject() ;
    return $a->COURSE_CODE;
}
public function getCourseType($code){
    $query=$this->connect->Prepare("SELECT COURSE_TYPE FROM tpoly_courses WHERE COURSE_CODE='$code'");
    $output= $this->connect->Execute($query);
     $a=$output->FetchNextObject() ;
    return $a->COURSE_TYPE;
}
public function getYear($code){
    $query=$this->connect->Prepare("SELECT COURSE_TYPE FROM tpoly_courses WHERE COURSE_CODE='$code'");
    $output= $this->connect->Execute($query);
     $a=$output->FetchNextObject() ;
    return $a->COURSE_TYPE;
}
public function getApplicationMode($mode){
     $query=   $this->connect->Prepare("SELECT * FROM tbl_mode_application WHERE ID='$mode'");
    $output= $this->connect->Execute($query);
    $a=$output->FetchNextObject();
    return $a->MODE;
}
 public function password() {
        $alphabet = "abcdefghjkmnpqrstuwxyz23456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
     
        //generating passwords from students table and puting it into the account table
        public function generateAccount(){
         $con=  Core::getInstance();
         $query=$con->dbh->query("SELECT * FROM students ");
         $a=$result = $query->fetchAll();
         $output=count($a);
         $query2=$con->dbh->query("SELECT * FROM students ");
          for($y=0;$y<$output;$y++){

              $output1 = $query2->fetchAll();
                  foreach ($output1 as $values){
                    extract($values);
                      $password= $this->password();
                      $encrypted_password=md5($password);
                      $student_index=$indexno;
                      $program2=   $programme;
                      $program=  $this->getProgram($program2);
                      $input=$con->dbh->query("SELECT * FROM account WHERE USERNAME='$student_index'");
                  if(count($input->fetchAll())==0){
                     $con->dbh->query("INSERT INTO account (USERNAME,PASSWORD,REAL_PASSWORD,PROGRAMMES,LEVEL) VALUES('$student_index','$encrypted_password','$password','$program','$level')") or die(header("location:dashboard.php"));
                  }
                }
         }
     }
     
/**
** required when the applicant finish working on form
** send sms and email to applicant upon receiving his or her form
*/
     
public function finalize($applicant){
	
	
	}
public function copyright(){
    return "&copy ".date("Y")." | Takoradi Polytechnic - All rights reserved";
}

}
