<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class M_SysPrivileges extends EUI_Model 
{

private $_limit_page = 10;

// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

 
private static $Instance = null;
	
// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

public static function &Instance()
{
 if( is_null( self::$Instance ) ){
	self::$Instance = new self();
 }
 return self::$Instance;
 
}

// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
  function __construct() 
{ 
	$this->load->model(array('M_UserRole'));
 }
 
// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
 public function _select_count_page() 
{
 
 $out = _find_all_object_request(); // count all object 
 
 $this->EUI_Page->_setPage( $this->_limit_page ); 
 $this->EUI_Page->_setSelect("a.id", FALSE);
 $this->EUI_Page->_setFrom("tms_agent_profile a");

 // ----------- filter -----------------------------------------------
 
 $this->EUI_Page->_setLikeCache("a.name", "PrivilegeName", TRUE);
 $this->EUI_Page->_setAndCache("a.id", "PrivilegeKd", TRUE);
 $this->EUI_Page->_setAndCache("a.IsActive", "PrivilegeStatus", TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets>='{$out->get_value('PrivilegeUpdateTs_Start','StartDate')}'", 'PrivilegeUpdateTs_Start', TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets<='{$out->get_value('PrivilegeUpdateTs_End','EndDate')}'", 'PrivilegeUpdateTs_End', TRUE);

 
 return $this->EUI_Page;
 
}
 
 
// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
 public function _select_content_page()
{
 
 $out = _find_all_object_request(); // load object all 
 
// -------------- set page libraries --------------------

 $this->EUI_Page->_postPage( $out->get_value('v_page') );
 $this->EUI_Page->_setPage( $this->_limit_page );

// -------------  set page libraries -------------------- 

 $this->EUI_Page->_setArraySelect(array(
	"a.id as PrivilegeId" => array("PrivilegeId", "PrivilegeId", "PRIMARY"), 
	"a.id as PrivilegeKd" => array("PrivilegeKd", "ID"), 
	"a.name as PrivilegeName" => array("PrivilegeName", "Name"),
	"a.updated_by as PrivilegeUpdateBy" => array("PrivilegeUpdateBy", "Update By User"),
	"a.last_update as PrivilegeUpdateTs" => array("PrivilegeUpdateTs", "Update Date Time"),
	"IF( a.IsActive =1,'Active', 'Not Active') as PrivilegeStatus" => array("PrivilegeStatus", "Status")
 ));
 
 $this->EUI_Page->_setFrom("tms_agent_profile a ", TRUE);
 
// ----------- filter -----------------------------------------------
 
 $this->EUI_Page->_setLikeCache("a.name", "PrivilegeName", TRUE);
 $this->EUI_Page->_setAndCache("a.id", "PrivilegeKd", TRUE);
 $this->EUI_Page->_setAndCache("a.IsActive", "PrivilegeStatus", TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets>='{$out->get_value('PrivilegeUpdateTs_Start','StartDate')}'", 'PrivilegeUpdateTs_Start', TRUE);
 $this->EUI_Page->_setAndOrCache("a.user_role_datets<='{$out->get_value('PrivilegeUpdateTs_End','EndDate')}'", 'PrivilegeUpdateTs_End', TRUE);
 
 
// -----------if have order sorted --------------------------------- 
 if( $out->find_value("order_by") ) {
	$this->EUI_Page->_setOrderBy($out->get_value("order_by"), $out->get_value("type"));
 } else {
	$this->EUI_Page->_setOrderBy("a.id", "DESC");
 }
 
// -----------then limit on here ---------------------------------
 $this->EUI_Page->_setLimit();
 //echo $this->EUI_Page->_getCompiler();
} 

// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
 function _select_row_page()
{
  $this->_select_content_page();
  if( $this->EUI_Page ) {
	return $this->EUI_Page->_get();
  }
  return FALSE;
} 

 
// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
 function _select_num_page()
{
 $arr_num_page = $this->EUI_Page->_getNo();
  if( is_null($arr_num_page) == FALSE )
 {
	return $arr_num_page;	
 }
 
} 
/* 
 * @def _setDeletePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 */ 
 
 function _select_row_user_privilege( $out = null  ) 
{
	if( is_null($out) 
		OR !is_object($out) 
		OR !$out->find_value('PrivilegeId') )
	{
		return FALSE;
	}
	
	
   $this->db->reset_select();
   $qry = $this->db->query( sprintf("select * from tms_agent_profile where id='%s'", $out->get_value('PrivilegeId') )); 
    if( $qry->num_rows() >  0 )
   {
	   return $qry->result_first_assoc();
   }
   return array();
   
 }
 
/* 
 * @def _setDeletePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _del_row_user_privileges( $user = null )
{
	
	$num = 0;
	if(  is_array($user) ) 
	foreach( $user as $k => $val ) 
	{
		$this->db->reset_write();
		if( $this->db->query(sprintf("delete from tms_agent_profile where id='%d'", $val )) ){
			$num++;	
		}	
	}
	return $num;
} 


/* 
 * @def _setSavePrivileges
 * -----------------------------------
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _setSavePrivileges($_post=array())
{
	$_conds = 0;
	if( $this -> db -> insert('tms_agent_profile',$_post)) 
	{
		$_conds++;
	}
	return $_conds;
}

// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _update_row_user_privilege( $out = null  )
{
	if( is_null($out) 
		OR !is_object($out) 
		OR !$out->find_value('PrivilegeId') )
	{
		return FALSE;
	}
	
	$this->db->reset_write();
	$this->db->where("id", $out->get_value('PrivilegeId') );
	$this->db->set("name", $out->get_value('privilege_user_name','strtoupper'));
    $this->db->set("IsActive", $out->get_value('privilege_user_status'));
    $this->db->set("level_group", $out->get_value('privilege_user_level'));
    $this->db->set("updated_by",_get_session('Fullname'));
    $this->db->set("last_update", date('Y-m-d H:i:s'));
    $this->db->update("tms_agent_profile");
   
   if(  $this->db->affected_rows() >  0 ){
	   return true; 
	  }
   
   return FALSE;
}

// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
function _set_row_privilege_activasi( $cond = NULL ) 
{
	$out = _find_all_object_request();
	$num = 0;
 if( !is_null($cond) 
	AND $out->find_value('PrivilegeId') )
	foreach( $out->get_array_value('PrivilegeId') as $k => $val  )
 {
	$this->db->reset_write();
	$this->db->where("id", $val);
	$this->db->set("IsActive", $cond);
	$this->db->set("last_update", date('Y-m-d H:i:s'));
	$this->db->set("updated_by", _get_session('Fullname'));
	$this->db->update("tms_agent_profile");
	$this->db->limit(1);
	
	if( $this->db->affected_rows()  > 0 ){
		$num++;
	 }
 }
 
 return $num;	
 
}

// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
 function _add_row_user_privilege()
{
   $out = _find_all_object_request();
   if( !$out->fetch_ready() ){
	   return FALSE;
   }
   
   $this->db->reset_write();
   $this->db->set("name", $out->get_value('privilege_user_name','strtoupper'));
   $this->db->set("IsActive", $out->get_value('privilege_user_status'));
   $this->db->set("level_group", $out->get_value('privilege_user_level'));
   $this->db->set("updated_by",_get_session('Fullname'));
   $this->db->set("last_update", date('Y-m-d H:i:s'));
   $this->db->insert("tms_agent_profile");
   if( $this->db->affected_rows() > 0 ){
	   return $this->db->insert_id();
   }
   
   return FALSE;
}

// -------------------------------- END CLASS ------------------------
}
?>