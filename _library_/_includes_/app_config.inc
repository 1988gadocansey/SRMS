<?php
session_start();
$newip=$_SERVER['REMOTE_ADDR']; // check if ip has changed .. let him login again
if(!isset($_SESSION[USERNAME]) || $newip!=$_SESSION["IP"]){
    header("location:index.php?salt=empty&&auth=null");
}
if ($_GET["page"]!=""):		$page	= $_GET["page"];	else:	$page	= 1;		endif;
        define ('RECORDS_BY_PAGE',50);
        define ('CURRENT_PAGE',$page);
         $GenericEasyPagination =new _classes_\GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
