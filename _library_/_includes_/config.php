<?php
namespace classes;
global $sql,$session,$config;
 
define( '_TPOLY','INDEX');
define("TP_ROOT",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define( 'TP_CONFIGURATION', 	TP_ROOT );
 
 
define('START_YEAR','2015');

class JConfig {
	public $dbtype = 'mysqli';
	public $server = 'localhost';
	public $user = 'root';
	public $database = 'coby_portal_local_db';
	public $password = "PRINT45dull";
	public $secret='my_poly_my_gad';
	public $debug = false;
	public $autoRollback= true;
	public $ADODB_COUNTRECS = false;
        public $smsusername ="191119572012";
	public $smspassword="Genesis1v2";
	public $smsurl="http://site.mytxtbox.com/sms_api";
	private static $_instance;
	 
	public function __construct(){
            session_start();
	}
	
	private function __clone(){}
	
	public static function getInstance(){
	if(!self::$_instance instanceof self){
	     self::$_instance = new self();
	 }
	    return self::$_instance;
	}

}


$config = JConfig::getInstance();

//included classes
 
include "Adodb/adodb.inc.php";
include "sql.php";
  
include_once('Adodb/adodb-pager.inc.php');
?>
