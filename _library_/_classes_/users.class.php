<?php
namespace _classes_;
 
class Users {
    private $connect;
     public function __construct() {
         global $sql,$season;
          
         $this->connect=$sql;
     }
     // returns array of details about users
     public function  userDetails( ){
         $query = "SELECT * FROM tpoly_auth  WHERE ID =".$this->connect->Param('a')." ";
			$stmt = $this->connect->Prepare($query);
			 $stmt = $this->connect->Execute($stmt,array($_SESSION["ID"]));
			  print $this->connect->ErrorMsg();
			
			if($stmt){		

				if($stmt->RecordCount() > 0){
					
				 
                                    return  $stmt->FetchNextObject();
				 
                                }
                        }
                         
     }
      public function getUser($code){
                $query=  $this->connect->Prepare("SELECT * FROM tpoly_workers AS w JOIN tpoly_auth AS a ON w.ids=a.USER WHERE  a.USER='$code'");
              $stmt= $this->connect->Execute( $query);
            if($stmt->RecordCount() > 0){
              $s=$stmt->FetchNextObject();
                return  $s; 

             }
                
    }
     
          
}
