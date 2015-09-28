<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
   //require '_library_/_includes_/app_config.inc';
  $worker=new _classes_\Users();
 $result = $sql->Prepare("SELECT * FROM `tpoly_auth`");
$result_=$sql->Execute($result);
 
$outp = "";
while($rs = $result_->FetchRow()) {
    if($rs["ACTIVE"]==1){
        $status="<span class='label label-success'>Active</span>";
    }
    else{
         $status="<span class='label label-danger'>Inactive</span>";
    }
     $user=$worker->userDetails($rs["USER"]) ;
    $username=$user->USERNAME;
    $since=date("d/m/Y",$rs["USER_SINCE"]);
    $last_login=date("d/m/Y",$rs["LAST_LOGIN"]);
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"user":"'  . $username . '",';
    $outp .= '"since":"'   . $since        . '",';
    $outp .= '"type":"'   . $rs["USER_TYPE"]        . '",';
    $outp .= '"ip":"'   . $rs["NET_ADD"]        . '",';
    $outp .= '"last_login":"'   . $last_login        . '",';
     $outp .= '"online":"'   . $rs["ONLINE"]        . '",';
     
    $outp .= '"active":"'. $status    . '"}'; 
     
}
$outp ='{"records":['.$outp.']}';
 

echo($outp);

?> 