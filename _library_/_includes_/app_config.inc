<?php
    include("initialize.php");
    ini_set('session.gc_maxlifetime',1);
    ini_set('session.cookie_lifetime',0);
    header('Content-Type: text/html; charset=utf-8');
    mb_internal_encoding('utf-8');

    if (session_id() == '') {
        session_start();
    }
                
$url="http://www.tpolyonline.com/Portal/sync_from_local.php";
    $directory = realpath(dirname(__FILE__));
    $document_root = realpath($_SERVER['DOCUMENT_ROOT']);
    $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .
    $_SERVER['HTTP_HOST'];
    if(strpos($directory, $document_root)===0) {
        $base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
    }

                

$newip=$_SERVER['REMOTE_ADDR']; // check if ip has changed .. let him login again
if(!isset($_SESSION[USERNAME]) || $newip!=$_SESSION["IP"]){
    header("location:index.php?salt=empty&&auth=null");
}
/*if (strpos($userActive->page(),'index.php')===false && $userActive->userIdentified()!=1) {
        //USER NOT AUTORIZED TO SEE PROTECTED PAGE
        header('location:index.php');//redirect
        exit;
   }*/
include('parsecsv.lib.php');
if ($_GET["page"]!=""):		$page	= $_GET["page"];	else:	$page	= 1;		endif;
        define ('RECORDS_BY_PAGE',50);
        define ('CURRENT_PAGE',$page);
         $GenericEasyPagination =new _classes_\GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
