<?php
class M_PhoneType extends EUI_Model
{
/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */

 
private static $Instance = null;

/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */

private static $meta = null; 

/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */
 
 
function __construct() {
	if( is_null(self::$meta) ) {
		self::$meta = 't_lk_phonetype'; 	
	}
}

/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */
 
 public static function &Instance()
{
  if( is_null( self::$Instance ) ){
	self::$Instance  = new self();
  }
  
  return self::$Instance;
}

/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */
 
 
function _getHideData()
{
	$rowshide = array();
	$this -> db -> select('a.table_field_name');
	$this -> db -> from('t_gn_hide_tables a ');
	$this -> db -> where('a.table_name', 't_gn_bucket_customers');
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$rowshide[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $rowshide;
}

/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */
 
function _getPhoneTypeList() 
{

 $ar_row_phone = array();
 $this->db->reset_select();
 $this->db->select('*');
 $this->db->from(self::$meta);
 $this->db->where('FlagStatusActive',1);
 $rs = $this->db->get();
 
 if( $rs->num_rows() > 0)
	 foreach( $rs->result_assoc() as $rows )  
 {
	$ar_row_phone[$rows['PhoneType']] = sprintf("%s ( %s )", $rows['PhoneKode'],  $rows['PhoneDesc'] );	
 }
 return $ar_row_phone;
}

// =============================== END CLASS ================================
}
?>