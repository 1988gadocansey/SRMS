<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
   //require '_library_/_includes_/app_config.inc';
  
$result = $sql->Prepare("SELECT  * FROM tpoly_courses  WHERE 1");
$result_=$sql->Execute($result);

$outp = "";
while($rs = $result_->FetchRow()) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Code":"'  . $rs["COURSE_CODE"] . '",';
    $outp .= '"Name":"'   . $rs["COURSE_NAME"]        . '",';
    $outp .= '"Level":"'. $rs["COURSE_LEVEL"]     . '"}'; 
     
}
$outp ='{"records":['.$outp.']}';
 

echo($outp);

?> 