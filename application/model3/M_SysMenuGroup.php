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
 
class M_SysMenuGroup extends EUI_Model
{
 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 private static $Instance = null;
 public static function &Instance()
{
  if( is_null(self::$Instance) ) {
		self::$Instance = new self();
	}
  return self::$Instance;	
} 
 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 */
 
  function __construct() {
	$this->load->model(array('M_Loger','M_SysUser','M_Menu','M_UserRole'));
 }
 
 
 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _get_default()
{
	
  $out = ObjectRequest();  
  $cok = ObjectSession();
  
 // --- test page -----------------------------------------------------------------------------------------------------
  
  //debug($out);
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
  $this->EUI_Page->_setSelect('a.GroupId');
  $this->EUI_Page->_setFrom("tms_group_menu a", 				TRUE); 
   
 // --- get keyword data process -------------------------------------------------------------------------------------
 
  $this->EUI_Page->_setLikeCache("a.GroupName", 	"GU_Name",		TRUE);
  $this->EUI_Page->_setLikeCache("a.GroupDesc", 	"GU_Desc", 		TRUE);
  $this->EUI_Page->_setAndCache("a.GroupOrder", 	"GU_Ordering", 	TRUE);
  $this->EUI_Page->_setAndCache("a.GroupShow", 		"GU_Flags",		TRUE);
  
 // --- on default process data pager  ------------------------------------------------------------------------------
 //printf("%s", $this->EUI_Page->_getCompiler() );
  //if( TRUE == $this->EUI_Page->query() ){
	return $this->EUI_Page;
  //}
  
}

 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _get_content()
{
	
  $out = ObjectRequest();  
  $cok = ObjectSession();
  
 // --- test page -----------------------------------------------------------------------------------------------------
  	
  $this->EUI_Page->_setPage( DEFAULT_COUNT_PAGE); 
  $this->EUI_Page->_postPage( $out->get_value('v_page') );

 // --- this  table process to view by query segment  -----------------------------------------------------------------
 
  $this->EUI_Page->_setArraySelect(array(
		"a.GroupId AS GU_Id"			=> array("GU_Id",		"GU_Id","primary"),
		"a.GroupId AS GU_Kode"			=> array("GU_Kode",		"GM_Label_ID"),
		"a.GroupName AS GU_Name"		=> array("GU_Name",	 	"GM_Label_Name"),
		"a.GroupDesc AS GU_Desc"		=> array("GU_Desc",	 	"GM_Label_Description"),
		"a.CreateDate AS GU_Created"	=> array("GU_Created",	"GM_Label_Created"),
		"a.UserCreate as GU_Creator"	=> array("GU_Creator",	"GM_Label_Creator"),
		"a.GroupOrder as GU_Ordering"	=> array("GU_Ordering", "GM_Label_Ordering"),
		"a.GroupShow AS GU_Flags" 		=> array("GU_Flags", 	"GM_Label_Flags")
   ));
 
 $this->EUI_Page->_setFrom("tms_group_menu a", TRUE);
  // --- get keyword data process -------------------------------------------------------------------------------------
 
  $this->EUI_Page->_setLikeCache("a.GroupName", 	"GU_Name",		TRUE);
  $this->EUI_Page->_setLikeCache("a.GroupDesc", 	"GU_Desc", 		TRUE);
  $this->EUI_Page->_setAndCache("a.GroupOrder", 	"GU_Ordering", 	TRUE);
  $this->EUI_Page->_setAndCache("a.GroupShow", 		"GU_Flags",		TRUE);
  
 // --- get order of field data row  --------------------------------------------------------------------------------
  if( $out->find_value('order_by')) {
	$this->EUI_Page->_setOrderBy( $out->get_value('order_by'), $out->get_value('type') );
  }
  
  $this->EUI_Page->_setLimit();
}

/*
 * @ get buffering query from database
 * @ then return by object type ( resource(link) ); 
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ get number record & start of number every page 
 * @ then result ( INT ) type 
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ get menu group all
 */ 
 
 function _get_menu_group()
 {
	$_data = array();
	$this -> db -> select('a.GroupId, a.GroupName');
	$this -> db -> from('tms_group_menu a');
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) {
		$_data[$rows['GroupId']] = $rows['GroupName'];
	}
	
	return $_data;
 
 }
 
/* @ get group menu name **/ 

function _get_menu_group_name( $GroupMenuId =0 )
{
	$_name = '';
	$sql = "SELECT a.GroupName FROM tms_group_menu  a WHERE a.GroupId='$GroupMenuId'";	
	$qry = $this -> db -> query($sql);
	if( !$qry -> EOF() )
	{
		$_name = $qry -> result_singgle_value();
	}
	return $_name;
}
 
/* @ get group menu by handle **/

function _get_group_menu( $handlingTypeId=0 )
{
	$_conds = array();
	$sql = " SELECT a.menu_group FROM t_gn_agent_profile a  WHERE a.id= '$handlingTypeId'";
	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) {
		$_conds = explode(',',$qry -> result_singgle_value());
	}
	
	return $_conds;
} 

// @ list group menu **/

function _get_list_group_menu( $Privileges )
{
	$_list_data = array();
	$_list_group = self::_get_group_menu( $Privileges );
	foreach( $_list_group as $k => $_listId ) {
		$_list_data[$_listId] = self::_get_menu_group_name($_listId);
	}
	
	return $_list_data;
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _select_row_data_detail( $val  = null , $fn = null ) 
 {
	$this->ar_list = array();
	
	$this->db->reset_select();
	$this->db->select("*", false);
	$this->db->from("tms_group_menu");
	$this->db->where("GroupId", $val);
	
	//$this->db->print_out();
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ){
		$this->ar_list = (array)$rs->result_first_assoc();
	}
	
	if( !is_null( $fn ) and function_exists( $fn) ){
		return call_user_func($fn, $this->ar_list);
	}
	return (array)$this->ar_list;
 }
// _getGroupMenu

function _getGroupMenu( $GroupId=0 )
{
	$this -> db -> select('*');
	$this -> db -> from('tms_group_menu');
	$this -> db -> where('GroupId',$GroupId);
	
	if( $rows = $this ->db->get()->result_first_assoc() ){
		return $rows;
	}
	else
		return array();
}




// @ _set_remove_group_menu 

function _set_remove_group_menu( $Privileges, $GroupMenuId )
{
	$_conds = false;
	
	if((is_array($GroupMenuId)) && ( $Privileges!='' ))
	{
		$_get_group_menu = self::_get_group_menu($Privileges);
		
		$_list_menu = array();
		foreach( $_get_group_menu as $k => $MenuId )
		{
			if(!in_array($MenuId,$GroupMenuId))
			{
				$_list_menu[$MenuId] = $MenuId;
			}
		}
		
		$this -> db -> where('id',$Privileges);
		if( $this -> db -> update('t_gn_agent_profile', array('menu_group'=> implode(',', $_list_menu) )) )
		{
			$this -> M_Loger -> set_activity_log("Remove Group Menu ::".implode(',',$_list_menu));
			$_conds = true;
		}
	}
	
	return $_conds;
	
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _aktivasi_row_group_menu( $out=null )
{
	if( is_null($out) ){
		return false;
	}		
	
	$this->ar_cond = 0;
	
// --- this will process data update  ----------------------

	if( count( $out->get_array_value('GU_Id')  ) >0 ) 
		foreach( $out->get_array_value('GU_Id') as $key => $val )
	{
		$dtl = $this->_select_row_data_detail( $val , 'Objective');
		if( $dtl->find_value('GroupId') )
		{
			$this->db->reset_write();
			$this->db->where("GroupId", $dtl->get_value('GroupId') );
			$this->db->set("GroupShow", $out->get_value('Aktive') );
			if( $this->db->update("tms_group_menu") ) 
			{
			   EventLoger("RPT", sprintf("USER %s GROUP MENU WITH NAME[%s]", 
				$out->get_value('Aktive', array('Flags', 'SetCapital')),
				$dtl->get_value('GroupName')
			   ));  
			  
			  $this->ar_cond++;	
			}
		}	
		
	}
	
	return $this->ar_cond;
	
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _save_row_group_menu($out = null )
{
	
	$buf = get_cokie_object();
	if( is_null($out) ){
		return false;
	}		
	
// --- look of data process  ----------------------------------------
	
	$this->ar_cond = 0;	
	$this->db->reset_write();
	$this->db->set("GroupName",	 $out->get_value('GU_Name'));
	$this->db->set("GroupDesc",  $out->get_value('GU_Desc'));
	$this->db->set("GroupOrder", $out->get_value('GU_Ordering'));
	$this->db->set("GroupShow",	 $out->get_value('GU_Flags'));
	$this->db->set("UserCreate", $buf->get_value('Username', array('SetCapital')));
	$this->db->set("CreateDate", date('Y-m-d H:i:s'));
	
	if( $this->db->insert("tms_group_menu") ){
		EventLoger("ADD", sprintf("USER ADD GROUP MENU WITH NAME[%s]", $out->get_value('GU_Name')));
		$this->ar_cond++;
	}
	return $this->ar_cond;
	
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _delete_row_group_menu($out = null )
{
	if( is_null($out) ){
		return false;
	}		
	$this->ar_cond = 0;
	$this->ar_rows = $out->get_array_value('GU_Id');
	if( count($this->ar_rows) >0 ) 
		foreach( $this->ar_rows as $key => $val )
	{
		$o = $this->_select_row_data_detail( $val, 'Objective' );
		//debug( $o);
		if( $o->find_value('GroupId') )
		{
			$this->db->reset_write();
			$this->db->where("GroupId", $o->get_value('GroupId') );
			$this->db->delete("tms_group_menu");
			
			 if(  $this->db->affected_rows() >  0 )
			{
			   EventLoger("DEL", sprintf("USER DELETE GROUP NAME[%s]", $o->get_value('GroupName')));	
			   $this->ar_cond++;	
			}
		}	
		
	}
	
	return $this->ar_cond;
}



// @ _set_active_group_menu

function _set_active_group_menu($MenuGroupId, $flags)
{
	$tot = 0;
	if( is_array($MenuGroupId))
	{
		foreach($MenuGroupId as $k => $MenuId )
		{
			$this -> db -> where('GroupId',$MenuId);
			if( $this -> db -> update('tms_group_menu', array('GroupShow'=> $flags) ))
			{
				$tot++;
			}
		}	
	}
	
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log( ($flags?'Enable':'Disable')."Group Menu :: ".implode(',',$MenuGroupId) );
	}
	
	return $tot;

}

// _setSaveNewGroup

// function _setSaveNewGroup($data = null )
// {
	// $_conds = 0;
	// if( is_array($data))
	// {
		// if( $this -> db->insert('tms_group_menu',$data) ){
			// $_conds++;
		// }
		
	// }
	
	// return $_conds;
// }

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _select_row_data_role( $val )  {
	return SystemRoleFrm($val, 'Objective');
	
 }
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
function _update_row_group_menu( $out=null )
{
	if( is_null($out) ){
		return false;
	}		
	
	$buf = get_cokie_object();
	$this->ar_cond = 0;
	
// ---------- update data value  --------------------------------------------------------------------
	
	$this->ar_cond = 0;	
	
	$this->db->reset_write();
	$this->db->where("GroupId",  $out->get_value('GU_Id'));
	$this->db->set("GroupName",	 $out->get_value('GU_Name'));
	$this->db->set("GroupDesc",  $out->get_value('GU_Desc'));
	$this->db->set("GroupOrder", $out->get_value('GU_Ordering'));
	$this->db->set("GroupShow",	 $out->get_value('GU_Flags'));
	$this->db->set("UserCreate", $buf->get_value('Username', array('SetCapital')));
	$this->db->set("CreateDate", date('Y-m-d H:i:s'));
	
	
	if( $this->db->update("tms_group_menu") ){
		EventLoger("UPD", sprintf("USER UPDATE GROUP MENU WITH NAME[%s]", $out->get_value('GU_Id')));
		$this->ar_cond++;
	}
	return $this->ar_cond;
	
	
}


}
// END OF FILE
// LOCATION : ./application/model/m_sysmenugroup.php
?>