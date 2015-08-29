<?php
 
/**
 * Handle all info about  students
 * 18/09/2014
 * @author Gad Ocansey
 */
namespace classes;
 

class Student {
     private $connect;
    public function __construct() {
        global $sql;
        $this->connect=$sql;
    }
    /**
     * @access public
     * @param string $index number  
     */
     public function getStudent($ID) {
          
       
        $STM2 = $this->connect->Prepare("SELECT * FROM tbl_student  WHERE INDEXNO='$ID' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        return $row->FetchNextObject();
        }
    }
    public function getAllStudents() {
          
       
        $STM2 = $this->connect->Prepare("SELECT * FROM tbl_student  ");
        $row= $this->connect->Execute($STM2);
        if($row){
        return $row->FetchNextObject();
        }
    }
	
	// get total students in a particular class
	 public function getTotalStudent_by_Class($class) {
          
       
        $STM2 = $this->connect->Prepare("SELECT COUNT(*) AS TOTAL FROM tbl_student WHERE CLASS='$class' ");
        $row= $this->connect->Execute($STM2);
        if($row){
         $a= $row->FetchNextObject();
		 return $a->TOTAL;
        }
		else{
				return 0;
			}
    }
    
}
 $stu=new Student();
 