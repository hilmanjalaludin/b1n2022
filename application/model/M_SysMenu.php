<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_SysMenu extends EUI_Model
{
	
private static $Instance = null;
private static $Limited = 10;
	

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- construct --- 
 * 
 */ 
 
 function __construct() {
	$this->load->model(array('M_Loger','M_SysUser','M_Menu','M_UserRole'));
 }


// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 public static function &Instance()
{ 
  if( is_null(self::$Instance) ){
	self::$Instance = new self();
  }
   return self::$Instance;	
}

 
// ---------------------------------------------------------------------------------
/*
 * @ pack		 --- default  --- 
 * 
 */ 
 
 function _get_default()
{
	
 $find = _find_all_object_request();
 
 // --------- EUI page -------------------
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
 $this->EUI_Page->_setSelect("*", FALSE);
 $this->EUI_Page->_setFrom("tms_application_menu a ");
 $this->EUI_Page->_setJoin("tms_group_menu b", "b.GroupId=a.group_menu", "LEFT", true);
 
// ---------- filter ----------------
 $this->EUI_Page->_setAndCache("a.id", "menu_id", true);
 $this->EUI_Page->_setAndCache("a.flag", "menu_status", true);
 $this->EUI_Page->_setAndCache("a.group_menu", "group_menu", true);
 $this->EUI_Page->_setLikeCache("a.menu", "menu_name", true);
 
 return $this->EUI_Page;

}

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
	
 public function _get_content()
{
	
 $find = _find_all_object_request();
 $this->EUI_Page->_postPage($find->get_value('v_page'));
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
 
// --- EUI Page session Object ----
 
 $this->EUI_Page->_setArraySelect(array(
	"a.id as IDs" => array("IDs","IDs", "primary"),
	"a.id as MenuId" => array("MenuId","Menu ID"),
	"a.menu as MenuName" => array("MenuName","Menu Name"),
	"b.GroupName as GroupMenuName" => array("GroupMenuName","Group Menu"),
	"a.file_name as MenuControll" => array("MenuControll","Controller"),
	"if(a.flag=1,'Active','Unactive') as status" => array("status","Status")
 ));
 
 $this->EUI_Page->_setFrom("tms_application_menu a ");
 $this->EUI_Page->_setJoin("tms_group_menu b", "b.GroupId=a.group_menu", "LEFT", true);
 
// --- set filter by request user --- 
 
 $this->EUI_Page->_setAndCache("a.id", "menu_id", true);
 $this->EUI_Page->_setAndCache("a.flag", "menu_status", true);
 $this->EUI_Page->_setAndCache("a.group_menu", "group_menu", true);
 $this->EUI_Page->_setLikeCache("a.menu", "menu_name", true);
 
 
// --- set order field request --- 

 if( $find->find_value("order_by")) {
	$this->EUI_Page->_setOrderBy( $find->get_value("order_by"), $find->get_value("type") );
 } else {
	$this->EUI_Page->_setOrderBy("a.id", "DESC");
 }
 
// --- set page limit --- 
 
 $this -> EUI_Page->_setLimit();
 
 //echo $this -> EUI_Page->_getCompiler();
	
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
 
/**
 & get menu user by handle level user 
 */
 
private function _get_menu( $HandleTypeId=0 )
{
	$_conds = null;
	
	if( $HandleTypeId!='' )
	{
		$this -> db -> select( 'a.menu' );
		$this -> db -> from( 'tms_agent_profile a' );
		$this -> db -> where( 'a.id',$HandleTypeId );
		
		foreach( $this -> db ->get()-> result_assoc() as $rows ){
			$datas = array( 'menu' => $rows['menu'] );
		}
	}
	
	return $d_array = explode(',',$datas['menu']);
 }
 
/*
 * get menu user by handle level user 
 */
 
 function _get_show_menu( $GroupId )
 {
	$_echo_list = array();
	$_list_menu_id = self::_get_menu($GroupId);
	
	foreach( $_list_menu_id as $k => $v ){
		$_echo_list[$v] = self::_get_menu_name($v);
	}
	
	return $_echo_list;
 }
 
/**
 @ get menu user by handle level user 
 */
  
 function _get_menu_name( $MenuId )
 {
	$sql = "SELECT menu FROM tms_application_menu WHERE id='$MenuId'";
	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) {
		return $qry -> result_singgle_value();
	}
 }
 
 /**
 @ get menu all data 
 */
  
 function _get_menu_detail( $MenuId )
 {
	$sql = " SELECT * FROM tms_application_menu a 
			 LEFT JOIN tms_group_menu b on a.group_menu=b.GroupId WHERE a.id='$MenuId' ";

	$qry = $this -> db -> query($sql);
	
	if( !$qry -> EOF() ) 
	{
		return $qry -> result_first_assoc();
	}
 }
 
 
//@ group menu  

 function _get_group_menu()
{
	$_conds = array();
	
	$sql = "select * from tms_group_menu a order by a.GroupId asc";
	$qry = $this -> db -> query($sql);
	
	foreach( $qry -> result_assoc() as $rows )
	{
		$_conds[$rows['GroupId']] = $rows['GroupName'];
	}
	
	return $_conds;
  }
  
//@ UpdateSelGroup

function _set_update_group( $MenuId, $Group )
{	
	$this -> db -> where( 'id', $MenuId);
	if ( $this -> db -> update( 'tms_application_menu',array('group_menu' => $Group))){
		
		$sql = "select a.GroupName from tms_group_menu a  where a.GroupId='$Group'";
		$qry = $this -> db -> query($sql);
		
		if( !$qry -> EOF() )
		{
			return $qry -> result_singgle_value();
		}
	}
	
	return null; 
} 
  
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- _setSaveNewMenu --- 
 * 
 */ 
 
 public function _set_assign_menu($out = null )
{ 
  if( is_null($out) ){
	return FALSE;
  }		
  
 //--- old menu id  ------------------------------------
 $ar_old_menu  = $this->_get_menu( $out->get_value('GroupId') );	
 
 // --- new menu id set --------------------------------	
 $ar_new_menu = $out->get_array_value('MenuId');
 $ar_new_groupid = $out->get_value('GroupId');
 
 $ar_clear_menu = array();
 if( is_array($ar_new_menu) ) 
 {
	$ar_interseaction = array_merge((array)$ar_old_menu, (array)$ar_new_menu); 
	
	if( is_array( $ar_interseaction ) )
		foreach( $ar_interseaction as $key => $val ) 
	{
		$ar_clear_menu[$val] = $val; 
	} 
	
// -------------- update DB -----------------------------
	
	 if( count( $ar_clear_menu ) > 0 )  
	{
		$this->db->reset_write();
		$this->db->set("menu", join(',', $ar_clear_menu));
		$this->db->where("id", $ar_new_groupid);
		
		if( $this->db->update("tms_agent_profile") ){
			EventLoger('UPD', json_encode( array(
					'ACTION_ID' => 'ASSIGN_MENU',
					'ASIGN_TO' => $ar_new_groupid,
					'MENU_ID' => array_values($ar_clear_menu)
			)));
			return TRUE;
		}
	}	
 }

return FALSE; 

}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- _setSaveNewMenu --- 
 * 
 */ 
 
 function _set_remove_menu( $out = null )
{

if( is_null($out) ){
	return FALSE;
 }			
 
 if( !$out->find_value('GroupId') ){
	return FALSE;
 }
  
 //--- old menu id  ------------------------------------
 $ar_old_menu  = $this->_get_menu( $out->get_value('GroupId') );	
 
 // --- new menu id set --------------------------------	
 $ar_new_menu = $out->get_array_value('MenuId');
 $ar_new_groupid = $out->get_value('GroupId');
 
 $ar_clear_menu = array();
 if( is_array($ar_new_menu) ) 
 {
	
	if (is_array($ar_old_menu)) 
		foreach( $ar_old_menu as $key => $val )
	{
		if( !in_array($val, $ar_new_menu) ){ 
			$ar_clear_menu[$val] = $val;  
		}
	}	
	
	
// ----------- update DB -----------------------------------
	
	if( count( $ar_clear_menu ) > 0 )  {
		$this->db->reset_write();
		$this->db->set("menu", join(',', $ar_clear_menu));
		$this->db->where("id", $ar_new_groupid);
		
		if( $this->db->update("tms_agent_profile") ){
			EventLoger('DEL', json_encode( array(
				'ACTION_ID' => 'DELETE_MENU',
				'FROM_GROUP' => $ar_new_groupid,
				'MENU_ID' => $ar_new_menu
			)));
			
			return TRUE;
		}
	}
 }

 return FALSE; 
	
}

// @ _set_disable_menu

function _set_disable_menu($flags=0, $MenuId=array() )
{
	$_list_array = $MenuId;
	$tot =0;
	if(count($_list_array )>0 )
	{
		foreach( $_list_array as $k => $MenuId )
		{ 
			$this -> db -> where('id', $MenuId );
			if( $this -> db -> update('tms_application_menu',array('flag' => $flags ) ) ) {
				$tot++;
			}
		}	
	}
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log( ($flags?'Enable':'Disable')." Menu ::".implode(',', $_list_array));
	}	
	
	return $tot; 	
 }
 
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- _set_deleted_menu --- 
 * 
 */ 
 public function _set_deleted_menu( $out  = null )
{
	
  if( !is_object($out) OR !$out->fetch_ready() )  {
	return FALSE;
  }
  
  $num_del = 0;
  $ar_uid = $out->get_array_value('menu_uid');
  
  if( is_array( $ar_uid ) ) 
	  foreach( $ar_uid as $key => $val )
  {
	  $this->db->reset_write();
	  $this->db->where("id", $val);
	  if( $this->db->delete("tms_application_menu") ){
		$num_del++;  
	  }
  } 
  
 return $num_del;
 
  
}
 
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- _setSaveNewMenu --- 
 * 
 */ 
 
 public function _setSaveNewMenu( $out = null )
{
 if( !is_object($out) OR !$out->fetch_ready() ) {
	return FALSE;
 }
 
 $this->db->reset_write();
 $this->db->set("menu", $out->get_value('menu_name') );
 $this->db->set("file_name", $out->get_value('menu_controller') );
 $this->db->set("el_id", $out->get_value('menu_id') );
 $this->db->set("group_menu", $out->get_value('menu_group') );
 $this->db->set("OrderId", $out->get_value('menu_order') );
 $this->db->set("toolbars", $out->get_value_order('menu_toolbar'), true);
 $this->db->set("formbars", $out->get_value_order('menu_formbar'), true);
 $this->db->set("flag", $out->get_value('menu_status') );
 $this->db->set("updated_by", _get_session('UserId'));
 $this->db->set("last_update", date('Y-m-d H:i:s'));
 $this->db->set("images", "list.customer");
 
 $this->db->insert("tms_application_menu");
 if( $this->db->insert_id() > 0 ){
	return TRUE;	
 }	 
 
 return FALSE;
 
} 

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
function _setUpdateMenu( $out = null ) 
{

 if( !is_object($out) OR !$out->fetch_ready() ) {
	return FALSE;
 }
 
 $this->db->reset_write();
 $this->db->where("id", $out->get_value('menu_uid') );
 $this->db->set("menu", $out->get_value('menu_name') );
 $this->db->set("file_name", $out->get_value('menu_controller') );
 $this->db->set("el_id", $out->get_value('menu_id') );
 $this->db->set("group_menu", $out->get_value('menu_group') );
 $this->db->set("OrderId", $out->get_value('menu_order') );
 $this->db->set("toolbars", $out->get_value_order('menu_toolbar'), true);
 $this->db->set("formbars", $out->get_value_order('menu_formbar'), true);
 $this->db->set("flag", $out->get_value('menu_status') );
 $this->db->set("updated_by", _get_session('UserId'));
 $this->db->set("last_update", date('Y-m-d H:i:s'));
 
 if( $this->db->update("tms_application_menu") ){
	return TRUE;
 } 
 
 //echo $this->db->last_query();
 
 return FALSE;
 
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 function _set_page_menu_user( $out =  null )
{
  
  $this->ar_menu_id = array();
  
 // ----------- filter on group ------------------------------
 
  if( $out->find_value('group_menu_on_user')){	
	$this->ar_menu_id = get_class_instance('M_Menu')->_get_akses_menu( $out->get_value('group_menu_on_user') );
  }
  
// ---------- reset selected query --------------------------------
  $this->db->reset_select();
  $this->db->select(" a.id as MenuUserId, a.menu as MenuName,  b.GroupName as MenuGroup, 
					  IF( a.flag IN(0), 'Not Active', 'Active') as MenuStatus  ", FALSE);
					  
  $this->db->from("tms_application_menu a");
  $this->db->join("tms_group_menu b", "a.group_menu=b.GroupId", "LEFT");
  
// ----------- filter on group ------------------------------
  
  if(  count( $this->ar_menu_id ) > 0 ){
	$this->db->where_in("a.id",  array_map('intval', $this->ar_menu_id));
  }
  
// ----------- filter menu name  ------------------------------

  if( $out->find_value('list_menu_on_user')){
	$this->db->like("a.menu", $out->get_value('list_menu_on_user'));
  }
  
  
 // --------- order_by -------------------------------------------------------------
 
  if( $out->find_value('orderby') ) {
	$this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
  } else {
	$this->db->order_by( "a.id", "DESC"); 
  }
  
 //$this->db->print_out();
  
 // -------- source fetch -----------------------------------------------------------
 
 $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
 {
	$arr_assign_data =(array)$rs->result_assoc();
  }
 
  return (array)$arr_assign_data;
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 function _set_page_menu_list( $out =  null )
{
  
  $this->db->reset_select();
  $this->db->select(" a.id as MenuId, a.menu as MenuName,  b.GroupName as MenuGroup, 
					  IF( a.flag IN(0), 'Not Active', 'Active') as MenuStatus  ", FALSE);
					  
  $this->db->from("tms_application_menu a");
  $this->db->join("tms_group_menu b", "a.group_menu=b.GroupId", "LEFT");
  
  
 // ---------- filter data --------------------------------------------------------
 if( $out->find_value('menu_name') ){
	$this->db->like("a.menu", $out->get_value('menu_name','strval'));
 }
 
 if( $out->find_value('menu_group') ){
	$this->db->where("a.group_menu", $out->get_value('menu_group','intval'));
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



}

// END OF FILE 
// LOCATION : ./application/model/sysmenu.php
?>