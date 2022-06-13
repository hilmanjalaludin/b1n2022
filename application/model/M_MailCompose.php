<?php 
class M_MailCompose extends EUI_Model
{

	
// -----------------------------------------------------------
/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 private static $Instance = null;

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
  if( is_null( self::$Instance ) ) {		
	self::$Instance = new self();	
  }	
  return self::$Instance;	
} 


// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function __construct(){ 
	$this->load->model(array('M_MailInbox'));
}


}
?>	
