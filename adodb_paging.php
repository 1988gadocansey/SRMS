<?php
/*
V5.19  23-Apr-2014  (c) 2000-2014 John Lim (jlim#natsoft.com). All rights reserved.
  Released under both BSD license and Lesser GPL library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.
  Set tabs to 4 for best viewing.

  Latest version is available at http://adodb.sourceforge.net
*/

ini_set('display_errors', 1);

include_once('./_library_/_includes_/Adodb/adodb.inc.php');
include_once('./_library_/_includes_/Adodb/adodb-pager.inc.php');
   $db = NewADOConnection('mysql');
	$db->Connect('localhost','root','PRINT45dull','coby_portal_local_db');

 include_once('_library_/_includes_/Adodb/toexport.inc.php');
 $sql1="SELECT  * FROM tpoly_courses";
$rs = $db->Execute($sql1);

 


$pager = new ADODB_Pager($db,$sql1);
$pager->showPageLinks = true;
$pager->linksPerPage = 10;
$pager->cache = 60;
$pager->Render($rows=70);
