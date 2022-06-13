<?php

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 
class M_Tools extends EUI_Model
{
// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
private static $Instance = null;
// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
private $_key = array() ;

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public static function &Instance() 
{
	if( is_null( self::$Instance ) ){
		self::$Instance = new self();
	}
	return self::$Instance;
} 
// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */


 public function __construct()
{
	
	$this->_key = array (
		"CustomerHomePhoneNum"	 => 'EventPhone',
		"CustomerMobilePhoneNum" => 'EventPhone',
		"CustomerWorkPhoneNum"   => 'EventPhone',
		"CustomerFirstName"      => 'EventUpper',
		"Refferer_Name"			 => 'EventUpper',
		"STP"					 => 'EventUpper',	
		"CustomerDOB" 			 => 'EventDOB',
		"GenderId"	 	 		 => 'EventGender',
		"Tel_1" 				 => 'EventPhone',
		"Tel_2" 				 => 'EventPhone',
		"Tel_3" 				 => 'EventPhone',
		"Tel_4" 				 => 'EventPhone',
		"Recsource"				 => 'EventSource' 	
	);
}

// ---------------------------------------------------------------------

/* 
 * Method 		if have name of recsource will generate to table 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function EventSource( $val ) 
{
	if( strlen($val) == 0  ) {
		return $val;
	} 
	
	$this->db->reset_write();
	$this->db->set("RecSourceName", strtoupper( $val) );
	$this->db->set("RecSourceDesc", strtoupper( $val) );
	$this->db->set("RecSourceFlags", 1);
	$this->db->insert("t_lk_recsource");
	
	
	return (string)$val;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function EventDOB( $val='' )
{
	if( function_exists('_getDateEnglish') ){
		return _getDateEnglish( $val );
	}		
	return $val;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function EventPhone( $val='' )
{ 
	if( function_exists('_getPhoneNumber') ){
		return _getPhoneNumber( $val );
	}		
	return $val;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
public function EventUpper( $val )
{
	if( !function_exists('_setCapital') ){
		return strtoupper( $val );
	}	
	return _setCapital( $val );
} 

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function EventGender($val='') 
{ 
	if( is_null($gender) ) { 
		return $val; 
	}
	
	if( strtoupper( $val ) == 'F' ){
		return 2;
	}
	
	if( strtoupper( $val ) == 'M' ){
		return 1;
	}	
	
	return (string)$val;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_call_func
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
  public function CallEvent( $key,  $val='' )
{
	if( in_array( $key, array_keys( $this->_key ) )) 
	{
		$call_user_func = $this->_key[$key];
		 if( $call_user_func )
		{
			return call_user_func_array(array( get_class($this),  $call_user_func ), array( $val ) );
		}
	}
	return (string)$val;
 } 
 
 
 // ==================================== END CLASS ==================================================
 
}
?>