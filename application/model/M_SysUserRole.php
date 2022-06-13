<?php 
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 
class M_SysUserRole extends EUI_Model
{
	
var $PageRecord = 10;
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

// --------------- select blocking sms -----------------

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 function __construct()
{ 
	$this->load->model(array('M_UserRole'));
}

// -------------------------------------------------------------

/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_content_page()
{
  $out = _find_all_object_request();
  
// ---------------------------------------------------------------------  
  
  $this->EUI_Page->_postPage(_get_post('v_page'));
  $this->EUI_Page->_setPage($this->PageRecord); 
  
  $this->EUI_Page->_setArraySelect(array(
	"a.user_role_id as UserRoleId"=> array("UserRoleId", "UserRoleId", "primary"), 
	"a.user_role_code as UserRoleCode"=> array("UserRoleCode", "Code"), 
	"a.user_role_desc as UserRoleDesc"=> array("UserRoleDesc", "Description"), 
	"a.user_role_level as UserRoleLevel"=> array("UserRoleLevel", "Level"), 
	"a.user_role_datets as UserRoleCreate"=> array("UserRoleCreate", "Create Date Time"),
	"IF(a.user_role_flags IN(1), 'Active', 'Not Active') as UserRoleStatus" => array("UserRoleStatus", "Status")
	
  ));
  
  $this->EUI_Page->_setFrom("t_lk_role_user a ", TRUE);
  
// ----------- filter  ---------------------------
 $this->EUI_Page->_setLikeCache("a.user_role_desc", "user_role_desc", TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets>='{$out->get_value('user_role_startts','StartDate')}'", 'user_role_startts', TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets<='{$out->get_value('user_role_endts','EndDate')}'", 'user_role_endts', TRUE);
 $this->EUI_Page->_setAndCache("a.user_role_flags", "user_role_flags", TRUE);
  
// -----------if have order sorted ---------------------------------

 if( $out->find_value("order_by") ) {
	$this->EUI_Page->_setOrderBy($out->get_value("order_by"), $out->get_value("type"));
 } else {
	$this->EUI_Page->_setOrderBy("a.user_role_id", "DESC");
 }
 
//echo $this->EUI_Page->_getCompiler();
// -----------then limit on here ---------------------------------
 $this->EUI_Page->_setLimit();

} 

// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_count_page()
{
	
 $out = _find_all_object_request();
// ---------------------------------------------------------------------
 	
  $this->EUI_Page->_setPage($this->PageRecord);  
  $this->EUI_Page->_setSelect("a.user_role_id");
  $this->EUI_Page->_setFrom("t_lk_role_user a ", true);
  
// ----------- filter  ---------------------------
  $this->EUI_Page->_setLikeCache("a.user_role_desc", "user_role_desc", TRUE);
  $this->EUI_Page->_setAndOrCache("a.user_role_datets>='{$out->get_value('user_role_startts','StartDate')}'", 'user_role_startts', TRUE);
  $this->EUI_Page->_setAndOrCache("a.user_role_datets<='{$out->get_value('user_role_endts','EndDate')}'", 'user_role_endts', TRUE);
  $this->EUI_Page->_setAndCache("a.user_role_flags", "user_role_flags", TRUE);
 
 // echo $this->EUI_Page->_getCompiler();
  return $this->EUI_Page;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_row_page()
{
  $this->_select_content_page();
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
 
 function _select_num_page()
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

 function _select_row_role_detail( $id  = 0 )
{
  $qry  = $this->db->query(sprintf("SELECT a.* FROM t_lk_role_user a WHERE a.user_role_id =%d", $id ));
  if( $qry->num_rows() >  0 ){
	return $qry->result_first_assoc(); 	
  }
  return array();
}


	
// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 
 function _select_page_role_menu_system( $out= null  )
{
  
  $this->db->reset_select();
  $this->db->select(" 
			a.id as MenuId,
			a.id as MenuCode,
			a.menu as MenuName, 
			a.file_name as Controller,
			a.images as Image,
			b.GroupName as MenuGroup, 
			IF( a.flag IN(0), 'Not Active', 'Active') as MenuStatus", FALSE);
			
  $this->db->from("tms_application_menu a");
  $this->db->join("tms_group_menu b", "a.group_menu=b.GroupId", "LEFT");
  $this->db->where("a.flag",1);

// --------- filter data ----------------------------------

  if( $out->find_value('GroupName') ){
	$this->db->where("b.GroupId", $out->get_value('GroupName'));
  }

  if( $out->find_value('MenuName') ){
	$this->db->like("a.menu", $out->get_value('MenuName')); 
  }  
  
// --------- order_by ------------------------------------- 

  if( $out->find_value('orderby') ) {
	$this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
  } else {
	$this->db->order_by( "a.id", "DESC"); 
  }
  
  //echo $this->db->print_out();
  
 // -------- source fetch -----------------------------------------------------------
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_assign_data = (array)$rs->result_assoc();
  }
 
   return (array)$arr_assign_data;
}

// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_page_role_formbar_all( $out  = null )
{
  $this->db->reset_select();
  $this->db->select("a.id as MenuId, a.menu as MenuName,  b.GroupName as MenuGroup, 
					IF( a.flag IN(0), 'Not Active', 'Active') as MenuStatus  ", FALSE);
					  
  $this->db->from("tms_application_menu a");
  $this->db->join("tms_group_menu b", "a.group_menu=b.GroupId", "LEFT");
  $this->db->join("t_gn_role_menu c "," a.id=c.role_trx_menu", "LEFT");
  $this->db->where("a.flag",1);
  
  //  ---- filter by role  ------------------------------
  
  $this->db->where("c.role_trx_group", $out->get_value('UserRoleGroup'));
  
 // --------- filter data ----------------------------------

  if( $out->find_value('GroupName') ){
	$this->db->where("b.GroupId", $out->get_value('GroupName'));
  }

  if( $out->find_value('MenuName') ){
	$this->db->like("a.menu", $out->get_value('MenuName')); 
  }  
  
  // --------- order_by -------------------------------------------------------------
 
  if( $out->find_value('orderby') ) {
	$this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
  } else {
	$this->db->order_by( "a.id", "DESC"); 
  }
  
 // -------- source fetch -----------------------------------------------------------
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_assign_data = (array)$rs->result_assoc();
  }
 
   return (array)$arr_assign_data;
}

// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function _select_page_role_toolbar_all( $out  = null )
{
  $this->db->reset_select();
  $this->db->select(" a.id as MenuId, a.menu as MenuName,  b.GroupName as MenuGroup, 
					  IF( a.flag IN(0), 'Not Active', 'Active') as MenuStatus  ", FALSE);
					  
  $this->db->from("tms_application_menu a");
  $this->db->join("tms_group_menu b", "a.group_menu=b.GroupId", "LEFT");
  $this->db->join("t_gn_role_menu c "," a.id=c.role_trx_menu", "LEFT");
  $this->db->where("a.flag",1);
  
  //  ---- filter by role  ------------------------------
  
  $this->db->where("c.role_trx_group", $out->get_value('UserRoleGroup'));
  
 // --------- filter data ----------------------------------

  if( $out->find_value('GroupName') ){
	$this->db->where("b.GroupId", $out->get_value('GroupName'));
  }

  if( $out->find_value('MenuName') ){
	$this->db->like("a.menu", $out->get_value('MenuName')); 
  }  
  
  // --------- order_by -------------------------------------------------------------
 
  if( $out->find_value('orderby') ) {
	$this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
  } else {
	$this->db->order_by( "a.id", "DESC"); 
  }
  
 // -------- source fetch -----------------------------------------------------------
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_assign_data = (array)$rs->result_assoc();
  }
 
   return (array)$arr_assign_data;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public function _update_row_user_role()
{
  $cond = 0;
  $out = _find_all_object_request();
  if( $out ) 
 {
	$this->db->reset_write();
	$this->db->set("user_role_code",$out->get_value('user_role_code'));
	$this->db->set("user_role_desc",$out->get_value('user_role_desc'));
	$this->db->set("user_role_flags",$out->get_value('user_role_flags'));
	$this->db->set("user_role_order",$out->get_value('user_role_order'));
	$this->db->set("user_role_level",$out->get_value('user_role_level'));
	$this->db->set("user_role_datets", date('Y-m-d H:i:s'));
	$this->db->set("user_role_byuser",_get_session('UserId'));
	
	$this->db->where("user_role_id",$out->get_value('UserRoleGroup'));
	$this->db->where("user_role_code",$out->get_value('user_role_code'));
	
	
	if( $this->db->update("t_lk_role_user") ) {
		$cond++;
	}
	
	// echo $this->db->last_query();
 }
  
  return $cond;
}


// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

function _aktivasi_row_user_role( $flags = 0 ) // default Not Active
{
  $cond = 0;
  $out = _find_all_object_request();
  if( $out->get_array_value('UserRoleId') ) 
	  foreach( $out->get_array_value('UserRoleId') as $key => $Id ) 
 {
	$this->db->reset_write();
	$this->db->where("user_role_id", $Id);
	$this->db->set("user_role_flags",$flags);
	if( $this->db->update("t_lk_role_user") )  
	{
		$cond++;
	}
 }
  return $cond;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

function _delete_row_mail_inbox()
{
  $cond = 0;
  $out = _find_all_object_request();
  if( $out->get_array_value('MailInboxId') ) 
	  foreach( $out->get_array_value('MailInboxId') as $key => $Id ) 
 {
	$this->db->reset_write();
	$this->db->where("EmailInboxId", $Id);
	
	if( $this->db->delete("egs_inbox") )  {
		EventLoger("DELETE", "Inbox Mail ID {$Id}");
		$cond++;
	}
 }
  
  return $cond;
}


// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

public function _add_row_menu_user_role( $out=null )
{
	if( !$out->fetch_ready() ){
		return false;
	}
	
// ------- on deleted ---------------------
	
	if( $out->find_value('UserAction') 
		AND $out->get_value('UserAction') == 'Delete' ) 
	{
		$this->db->reset_write();
		$this->db->where("role_trx_menu", $out->get_value('UserMenuId'));
		$this->db->where("role_trx_group", $out->get_value('UserRoleId'));
		$this->db->delete("t_gn_role_menu");
		if( $this->db->affected_rows() > 0 ){
			return TRUE;
		}
	}
	
// ------- on add --------------------
	if( $out->find_value('UserAction') 
		AND $out->get_value('UserAction') == 'Add' ) 
	{
		$this->db->reset_write();
		$this->db->set("role_trx_menu", $out->get_value('UserMenuId'));
		$this->db->set("role_trx_group", $out->get_value('UserRoleId'));
		$this->db->set("role_trx_updatets", date('Y-m-d H:i:s'));
		$this->db->insert("t_gn_role_menu");
		
		if( $this->db->affected_rows() > 0 ){
			return TRUE;
		}
	}
	return FALSE;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public function _add_row_toolbar_user_role( $out = null )
{
 
 $obj_role = &get_class_instance('M_UserRole');	
 if( !is_object($out) ) { 
	return false; 
 }	

// ----------- cek before save or add  --------------------- 
 if( !$out->find_value('UserMenuId') 
	OR !$out->find_value('UserActId') 
	OR !$out->find_value('UserRoleId') )
 {
	return false;	
 }
	
 $arr_action  = $out->get_array_value('UserActId');
 $arr_value   = $obj_role->_select_trx_toolbar_role_uid($out->get_value('UserRoleId'), $out->get_value('UserMenuId'));
 $arr_toolbar = ArrayValueStrJoin(array($arr_value, $arr_action));
	
// -- insert to trx -------------------------
 $this->db->reset_write();
 $this->db->set("role_trx_menu", $out->get_value('UserMenuId'));
 $this->db->set("role_trx_group", $out->get_value('UserRoleId')); 
 $this->db->set("role_trx_toolbar", $arr_toolbar, true);
 $this->db->set("role_trx_updatets", date('Y-m-d H:i:s'));
	
// ------- on duplicate ---------------------------	
 
 $this->db->duplicate("role_trx_toolbar", $arr_toolbar, true);
 $this->db->duplicate("role_trx_updatets", date('Y-m-d H:i:s'));
 $this->db->insert_on_duplicate('t_gn_role_menu');
 
 if( $this->db->affected_rows() > 0 ){
	 return TRUE;
 }
 return FALSE;
 
	
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _add_row_formbar_user_role( $out = null  )
{
	$obj_role = &get_class_instance('M_UserRole');	
 if( !is_object($out) ) { 
	return false; 
 }	

// ----------- cek before save or add  --------------------- 
 if( !$out->find_value('UserMenuId') 
	OR !$out->find_value('UserActId') 
	OR !$out->find_value('UserRoleId') )
 {
	return false;	
 }
	
 $arr_action  = $out->get_array_value('UserActId');
 $arr_value   = $obj_role->_select_trx_formbar_role_uid($out->get_value('UserRoleId'), $out->get_value('UserMenuId'));
 $arr_toolbar = ArrayValueStrJoin(array($arr_value, $arr_action));
	
// -- insert to trx -------------------------
 $this->db->reset_write();
 $this->db->set("role_trx_menu", $out->get_value('UserMenuId'));
 $this->db->set("role_trx_group", $out->get_value('UserRoleId')); 
 $this->db->set("role_trx_formbar", $arr_toolbar, true);
 $this->db->set("role_trx_updatets", date('Y-m-d H:i:s'));
	
// ------- on duplicate ---------------------------	
 
 $this->db->duplicate("role_trx_formbar", $arr_toolbar, true);
 $this->db->duplicate("role_trx_updatets", date('Y-m-d H:i:s'));
 $this->db->insert_on_duplicate('t_gn_role_menu');
 
 if( $this->db->affected_rows() > 0 ){
	 return TRUE;
 }
 return FALSE;
 
}


// ---------------------------------------------------------------------

/* 
 * Method 		delet from toobars 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public function _del_row_toolbar_user_role( $out = null )
{
	
 $obj_role = &get_class_instance('M_UserRole');	
 if( !is_object($out) ) { 
	return false; 
 }	

// ----------- cek before save or add  --------------------- 
 if( !$out->find_value('UserMenuId') 
	OR !$out->find_value('UserActId') 
	OR !$out->find_value('UserRoleId') )
 {
	return false;	
 }
	
 $arr_delete  = $out->get_array_value('UserActId');
 $arr_source  = $obj_role->_select_trx_toolbar_role_uid($out->get_value('UserRoleId'), $out->get_value('UserMenuId'));
 $arr_toolbar = ArrayValueDelete($arr_source, $arr_delete, 'ArrayToString');
	
// -- insert to trx -------------------------------

 $this->db->reset_write();
 $this->db->set("role_trx_menu", $out->get_value('UserMenuId'));
 $this->db->set("role_trx_group", $out->get_value('UserRoleId')); 
 $this->db->set("role_trx_toolbar", $arr_toolbar, true);
 $this->db->set("role_trx_updatets", date('Y-m-d H:i:s'));
	
// ------- on duplicate ---------------------------	
 
 $this->db->duplicate("role_trx_toolbar", $arr_toolbar, true);
 $this->db->duplicate("role_trx_updatets", date('Y-m-d H:i:s'));
 $this->db->insert_on_duplicate('t_gn_role_menu');
 
 if( $this->db->affected_rows() > 0 ){
	 return TRUE;
 }
 return FALSE;
 
 
}


// ---------------------------------------------------------------------

/* 
 * Method 		delet from toobars 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 
 public function _save_row_role_user()
{
   $out = _find_all_object_request();
   $this->db->reset_write();
   $this->db->set("user_role_code",$out->get_value('user_role_code'));
   $this->db->set("user_role_desc",$out->get_value('user_role_desc'));
   $this->db->set("user_role_flags",$out->get_value('user_role_flags')); 
   $this->db->set("user_role_order", $out->get_value('user_role_order'));
   $this->db->set("user_role_level", $out->get_value('user_role_level'));
   $this->db->set("user_role_datets",date('Y-m-d H:i:s')); 
   $this->db->set("user_role_byuser",_get_session('UserId'));
   $this->db->insert("t_lk_role_user");
   
   if( $this->db->affected_rows() > 0 ){
	   return $this->db->insert_id();
   }
   return FALSE;
   
}

// ---------------------------------------------------------------------

/* 
 * Method 		delet from toobars 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 
function _delete_row_user_role()
{
	$num = 0;
	
	$out = _find_all_object_request();
	if( $out->find_value('UserRoleId') ) 
		foreach( $out->get_array_value('UserRoleId') as $k => $val )
	{
		$this->db->reset_write();
		$this->db->where("user_role_id", $val);
		$this->db->delete("t_lk_role_user");
		if( $this->db->affected_rows() > 0 ){
			$num++;
		}
	}
	return $num;
}

// ---------------------------------------------------------------------

/* 
 * Method 		delet from toobars 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 
function _del_row_formbar_user_role( $out = null )
{
	$obj_role = &get_class_instance('M_UserRole');	
 if( !is_object($out) ) { 
	return false; 
 }	

// ----------- cek before save or add  --------------------- 
 if( !$out->find_value('UserMenuId') 
	OR !$out->find_value('UserActId') 
	OR !$out->find_value('UserRoleId') )
 {
	return false;	
 }
	
 $arr_delete  = $out->get_array_value('UserActId');
 $arr_source  = $obj_role->_select_trx_formbar_role_uid($out->get_value('UserRoleId'), $out->get_value('UserMenuId'));
 $arr_toolbar = ArrayValueDelete($arr_source, $arr_delete, 'ArrayToString');
	
// -- insert to trx -------------------------------

 $this->db->reset_write();
 $this->db->set("role_trx_menu", $out->get_value('UserMenuId'));
 $this->db->set("role_trx_group", $out->get_value('UserRoleId')); 
 $this->db->set("role_trx_formbar", $arr_toolbar, true);
 $this->db->set("role_trx_updatets", date('Y-m-d H:i:s'));
	
// ------- on duplicate ---------------------------	
 
 $this->db->duplicate("role_trx_formbar", $arr_toolbar, true);
 $this->db->duplicate("role_trx_updatets", date('Y-m-d H:i:s'));
 $this->db->insert_on_duplicate('t_gn_role_menu');
 
 if( $this->db->affected_rows() > 0 ){
	 return TRUE;
 }
 return FALSE;
 
}

 
// =========================== END CLASS ====================================
// =========================== END CLASS ====================================
		
}
