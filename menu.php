<?php
//error_reporting(1);
  require 'config.php';
 global $sql;
$query=$sql->prepare("SELECT * FROM tbl_modules AS top JOIN tpoly_auth AS auth ON top.USER_ID='$_SESSION[ID]' ");
			 
  $stmt=$sql->Execute($query);
if($stmt->RecordCount() > 0){
  
  
    
       
    
        //creating our table heading
        
         $menu_all=array();
        while($row = $stmt->FetchRow()){
           
            
             $module=$row["MODULES"];
              
             $menu_all=explode(",",$module);
              
             
         
            }
             // print_r($menu_all);
             for($i=0;$i < count($menu_all);$i++){
                $a=   $menu_all[$i]; 
               
             $query2 = $sql->prepare("SELECT * FROM tbl_menu WHERE   id='$a' AND parentid='0' ORDER BY id ASC ");
            
              
            $stmt2 = $sql->Execute( $query2 );
            while($row=$stmt2->fetchRow()){
                extract($row);
              
                                 
                              echo"   <li class=\"menu-dropdown classic-menu-dropdown active\"><a data-hover=\"megamenu-dropdown\" data-close-others=\"true\" data-toggle=\"dropdown\" href=\"javascript:;\">    {$name}  <i class=\"icon-doc\"></i></a>";
                        
                         $query2 = $sql->prepare("SELECT * FROM tbl_menu WHERE parentid='$a' ");
                        $stmt2 = $sql->Execute( $query2 );
                       echo" <ul class=\"dropdown-menu pull-left\">";
                    while ($row2 = $stmt2->FetchRow()){
                         extract($row2);
                        echo "
                               
                                     
                                     <li class=\"active dropdown\"><a href=\"{$link}.php\"><i class=\"icon-doc\"></i>$name</a></li>
                               ";
                          
                           
                    }
                         echo  " </ul> ";
                        
                       
                         echo  " </li> ";
                        
                        
                         
              
              
            }
         }
            
       
            
       
           
}
 
 