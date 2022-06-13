<?php
/**
 * Enigma User Interface
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		Enigma User Interface
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.0
 * @filesource
 */
class M_CourierList extends EUI_Model
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
 
public static function &Instance(){
	if( is_null(self::$Instance ) ){
		self::$Instance = new self();
	}
	return self::$Instance;
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 

function __construct(){
	$this->load->model(array('M_Website','M_UserRole'));
	
}


// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
 
function _select_row_page_size()
{

 $out = ObjectRequest();
// ---------------------------------------------------------------------
 	
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);  
 $this->EUI_Page->_setSelect("a.KurirID");
 $this->EUI_Page->_setFrom("t_lk_kurir a ", true);
  
 // --- filter vdata  ----
 
 // $this->EUI_Page->_setWhere("a.flag","1");
 $this->EUI_Page->_setLikeCache("a.KurirCode", "KurirCode", TRUE);
 $this->EUI_Page->_setAndCache("a.KurirDesc", "KurirDesc", TRUE);
 
 // printf('%s', $this->EUI_Page->_getCompiler());
 return $this->EUI_Page;
 }

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function _select_row_page_content()
{
  //first variable flag is active
  $flag = 1;

  $out = ObjectRequest();
  // $out  = new EUI_Object(_get_all_request());

   
  $this->EUI_Page->_postPage($out->get_value('v_page'));
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
  
  
 // --- select an array page  --------------------------------------------------------------------
  $this->EUI_Page->_setArraySelect(array(
  	"a.KurirID as KurirID"      => array("KurirID", "KurirID","primary"),
	"a.KurirCode as KurirCode"  => array("KurirCode", "Kurir Code"), 
	"a.KurirDesc as KurirDesc"  => array("KurirDesc", "Nama Kurir"), 
	"a.flag as flag"            => array("flag", "Status"),
  ));
  
  $this-> EUI_Page ->_setFrom("t_lk_kurir a ",TRUE);
  $this-> EUI_Page ->_setAnd("a.flag = ".$flag);

  
// ----------- filter  ---------------------------
 $this->EUI_Page->_setLikeCache("a.KurirCode", "KurirCode");
 $this->EUI_Page->_setLikeCache("a.KurirDesc", "KurirDesc");
  
// -----------if have order sorted ---------------------------------

 if( $out->find_value("order_by") ) {
	$this->EUI_Page->_setOrderBy($out->get_value("order_by"), $out->get_value("type"));
 } else {
	$this->EUI_Page->_setOrderBy("a.KurirID", "DESC");
 }
 

// -----------then limit on here ---------------------------------
 $this->EUI_Page->_setLimit();
// printf("%s", $this->EUI_Page->_getCompiler());

 }
 
 
// -------------------------------------------------------------

/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _select_row_page_row()
{
  $this->_select_row_page_content();
  if( $this->EUI_Page )
 {
	return $this->EUI_Page->_get();
  }
  return FALSE;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_row_page_num()
{
 $arr_num_page = $this->EUI_Page->_getNo();
  if( is_null($arr_num_page) == FALSE )
 {
	return $arr_num_page;	
 }
 
} 
	

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

   function _select_row_layout_data($LayoutId = 0, $Call = null )
 {
	$this->ar_list = array();
	
	$sql = sprintf("select * from t_lk_kurir a where a.KurirID =%d", $LayoutId);
	 
	$rs  = $this->db->query( $sql );
	if( $rs->num_rows() > 0 
		and ( $row = $rs->result_first_assoc() ))
	{
		$this->ar_list = $row; 	
	}
	// -- if have call event data  ---
	
	if( is_null( $Call )){
		return $this->ar_list;
	}
	if( function_exists($Call) ){
		return call_user_func($Call, $this->ar_list);	
	}
	return $this->ar_list;
	
 } 

// -------------------------------------------------------------

// -------------------------------------------------------------

/* 
 * Method 		
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _save_courier( $out = null )
{
 // clear of the cache data set object 
 if( !is_object($out) OR !$out->fetch_ready() ) {
	return FALSE;
  }	
 $this->db->set("KurirCode", $out->get_value('KurirCode') );
 $this->db->set("KurirDesc", $out->get_value('KurirDesc'));
 $this->db->set("flag", $out->get_value('flag'));
 $this->db->insert("t_lk_kurir");
 if( $this->db->insert_id() > 0 ){
	return TRUE;	
 }	 
 return FALSE;
} // -- end  function --
 


// ---------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : Delete data Curier
 * @ auth ............... : Didi
 * @ date ............... : 2018-02-14 
 *
 */
 function _delete_data_courier( $dataURI  = null  )
{
//	debug($dataURI);
// check by richeck data OK .
 if( !is_object($dataURI)){
	return false;
 }
 // query data on model delete bucket kuota  user process 
 // tested on here .
 
 $sql = sprintf("delete from t_lk_kurir where KurirID='%s'",$dataURI->field('KurirID'));
 //echo $sql;
 $qry = $this->db->query( $sql );
 if( $this->db->affected_rows() > 0 ){
	return true;
 }
 return false;
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : Update data courier
 * @ auth ............... : Didi
 * @ date ............... : 2018-02-14 
 *
 */
 function _setUpdateCourier( $out  = null )
{
 
 if( !is_object($out) ){ return FALSE; }
 
 $this->db->reset_write();
 $this->db->set("KurirCode", $out->get_value('KurirCode') );
 $this->db->set("KurirDesc", $out->get_value('KurirDesc'));
 $this->db->set("flag", $out->get_value('flag'));
 $this->db->where("KurirID", $out->get_value('KurirID'));

 
  if( $this->db->update('t_lk_kurir') )
 {
	return TRUE;	
 }
return FALSE; 
}

}

?>