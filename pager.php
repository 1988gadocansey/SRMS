<?php 
include_once('./_library_/_includes_/Adodb/adodb.inc.php');
    require '_library_/_classes_/class.GenericEasyPagination.php';
///////////////////////////////////////////////////////////////////
// Define Constants
if ($_GET["page"]!=""):		$page	= $_GET["page"];	else:	$page	= 1;		endif;
define ('RECORDS_BY_PAGE',5);
define ('CURRENT_PAGE',$page);


///////////////////////////////////////////////////////////////////
// Connection Of DataBase
$objConnection = &ADONewConnection('mysql'); 
$objConnection->Connect('localhost','root','PRINT45dull','pager');


///////////////////////////////////////////////////////////////////
// Select Records By "PageExecute Method"
$strSQL = " SELECT id_user,user_name FROM users ORDER BY user_name";
$objConnection->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $objConnection->PageExecute($strSQL,RECORDS_BY_PAGE,CURRENT_PAGE);


///////////////////////////////////////////////////////////////////
// Display Records
if (!$rs->EOF)
{
	$recordsFound = $rs->_maxRecordCount;
	echo "RecordsLits:<br><br>";
	while(!$rs->EOF)
	{
		echo "<strong>User Name:</strong> ".$rs->fields["user_name"]." (<strong>id</strong>: ".$rs->fields["id_user"].")<br>";
		$rs->moveNext();
	}
	
	///////////////////////////////////////////////////////////////////
	// Pagination
	$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
	$GenericEasyPagination->setTotalRecords($recordsFound);
	 
	echo "<br>";
	echo $GenericEasyPagination->getCurrentPages();
	echo "<br>";

}
?>