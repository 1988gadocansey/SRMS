<?php
if(!isset($_SESSION[USERNAME])){
    header("location:index.php?salt=empty&&auth=null");
}
