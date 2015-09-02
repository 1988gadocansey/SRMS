<?php
$newip=$_SERVER['REMOTE_ADDR'];
if(!isset($_SESSION[USERNAME]) || $newip!=$_SESSION["IP"]){
    header("location:index.php?salt=empty&&auth=null");
}
