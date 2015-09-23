<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
   //require '_library_/_includes_/app_config.inc';
  
$result = $sql->Prepare("SELECT * FROM `tpoly_auth`");
$result_=$sql->Execute($result);

$outp = "";
while($rs = $result_->FetchRow()) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"user":"'  . $rs["USER"] . '",';
    $outp .= '"since":"'   . $rs["USER_SINCE"]        . '",';
    $outp .= '"type":"'   . $rs["USER_TYPE"]        . '",';
    $outp .= '"ip":"'   . $rs["NET_ADD"]        . '",';
    $outp .= '"last_login":"'   . $rs["LAST_LOGIN"]        . '",';
     
    $outp .= '"active":"'. $rs["ACTIVE"]     . '"}'; 
     
}
$outp ='{"records":['.$outp.']}';
 

echo($outp);

?> 