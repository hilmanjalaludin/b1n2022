<?php 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_AuthValidation extends EUI_Model{
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private static $Instance   = null; 
 public static function &Instance() {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function __construct(){ 
	
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _select_validation_selling( $row  = null, $uri = null ){
 if( is_null( $row ) OR is_null($uri) ){
	return false;
 } 

 // get data CustomerId OR Custnum 	
 if( !$uri->find_value('CustomerNum') OR !$row->find_value('table') ){
	return false;
 } 
	
// lanjut ke process berikut ini .
 $fieldTotal = 0;
 $fieldCount = $row->field('where');
 $fieldTable = $row->field('table');
 $fieldWhere = $row->field('where');
 $fieldValue = $uri->field('CustomerNum');
// define total data true 
 
 $sql = sprintf("SELECT COUNT(%s) as total FROM %s WHERE %s='%s'", $fieldCount,
																   $fieldTable,
																   $fieldWhere,
																   $fieldValue );
$qry = $this->db->query( $sql );
 if( $qry && $qry->num_rows() > 0  ){
	$fieldTotal  = (int)$qry->result_singgle_value();
 }
 // return callback;
 return $fieldTotal;

														 
//														debug( $sql);	
 //print_r( $row );
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
}	