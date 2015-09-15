<?php
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
    
    $data=$_POST[data];
    $type=$_POST[type];
    $year=$_POST[year];
    $term=$_POST[term];
    if($type=="mounted_courses"){
        $query=$sql->Prepare("INSERT INTO tpoly_mounted_courses SET  $data  ON DUPLICATE KEY UPDATE $data ");
        if($sql->Execute($query)){
            echo "sent succesful";
        }
    }
    // passwords to portal
    if($type=="portal_password"){
        $query=$sql->Prepare("INSERT INTO tpoly_log_portal SET  $data  ON DUPLICATE KEY UPDATE $data ");
        if($sql->Execute($query)){
            echo "sent succesful";
        }
    }