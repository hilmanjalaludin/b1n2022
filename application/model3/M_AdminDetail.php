<?php 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class M_AdminDetail extends EUI_Model  {

 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 private static $Instance = null;
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 public static function &Instance()  {
  if( is_null(self::$Instance) ) {
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
	$this->load->model(array('M_UserRole'));
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _select_row_master_detail( $CustomerId = 0  ){
	 
  $result_array = array();
  
 // select query data from master  
 // data lai akan di ambil pake fungsi aja .
 
  $sql = sprintf("select * from t_gn_customer_master a where a.DM_Id='%d'", $CustomerId);
  $qry = $this->db->query( $sql );
  if( $qry && $qry->num_rows() > 0 ){
	  $result_array =(array)$qry->result_first_assoc();
  } 
  return (array)$result_array;
  
 
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
// =================== END CLASS  =======================================
 
}


?>