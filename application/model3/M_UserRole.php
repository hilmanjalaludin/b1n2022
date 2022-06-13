<?php 
// -------------------------------------------------------------

/* 
 * Method 		M_UserRole
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
class M_UserRole extends EUI_Model
{

var $arr_user_action_role= null;
var $arr_menu_action_role= null;
var $arr_role_toolbars = array();
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 private static $Instance = null;

//---------------------------------------------------------------------------------------

/* Methode			static function 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public static function &Instance()
{
  if( is_null(self::$Instance))
  {
	self::$Instance = new self();	
  }
  
  return self::$Instance;
} 

// -------------------------------------------------------------

/* 
 * Method 		xxxxxxxxxxxx
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function __construct() 
{ 
	//$this->load->model(array('M_Dropdown','M_UserActivity', 'M_EventAction','M_Menu'));
	//$this->_UserActionRole(); // default by role menu 
}


/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
public function _select_role_event_write_execute() { 
	return array();
}

/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 function _select_role_form_action( $value = null )
{ 

// data process is_object on this process .
 if( is_object( $value ) ){
	$value = get_class($value);
 }
  
// get form define data formbars 
 
  $this->ar_event_id = $this->_select_role_user_formbar( $value );
  
 //   then on here ----------------------
  $arr_form_bars = array();
  
  $this->db->reset_select();
  $this->db->select("a.role_menu_id, a.role_menu_code, a.role_menu_event , a.role_menu_icon, a.role_menu_title", FALSE);
  $this->db->from("t_lk_role_menu a ");
  $this->db->where("a.role_menu_post", 'RM_FORM_BAR');
  if( is_array($this->ar_event_id) and count($this->ar_event_id) > 0 ){
	$this->db->where_in("a.role_menu_id", array_map('intval', $this->ar_event_id));
  } else {
	  $this->db->where_in("a.role_menu_id", 0);
  }
  $this->db->order_by("a.role_menu_order", 'ASC');
  // $this->db->print_out();
  
  $rs  = $this->db->get();
  $num = 0;
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$row = new EUI_Object( $rows );
	$arr_form_bars[$row->get_value('role_menu_code')] = new EUI_Object( array( 
		'Index' => join("",array($row->get_value('role_menu_code'),$row->get_value('role_menu_id'))),
		'Event' => $row->get_value('role_menu_event'),
		'Label' => $row->get_value('role_menu_title'),
		'Icons'	=> $row->get_value('role_menu_icon')
		
	));
		
	$num++;
 }
 
 return (array)$arr_form_bars;
  
}

/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_role_table_action( $ByRef = null )
{ 
  
  $this->ar_event_id = $this->_select_role_user_toolbar( $ByRef );
  
 // ---------- then on here ----------------------
  $arr_form_bars = array();
  
  $this->db->reset_select();
  $this->db->select("a.role_menu_code", FALSE);
  $this->db->from("t_lk_role_menu a ");
  $this->db->where("a.role_menu_post", 'RM_TOOL_BAR');
  $this->db->where_in("a.role_menu_action", array('x','w'));
  
  if( is_array($this->ar_event_id) 
	  and count($this->ar_event_id) > 0 )
 { 
    $this->db->where_in("a.role_menu_id", array_map('intval', $this->ar_event_id));
  } else {
	$this->db->where_in("a.role_menu_id",0);  
  }
  
  $this->db->order_by("a.role_menu_order", 'ASC');
  //$this->db->print_out();
  
  $rs  = $this->db->get();
  
  $num = 0;
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$row = new EUI_Object( $rows );
	$arr_form_bars[$num] = $row->get_value('role_menu_code');
	$num++;
 }
 
 return (array)$arr_form_bars;
  
}

/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_role_user_formbar( $ByRef = null )
{ 
	
 // bugs fixe : ketika user di set lebih dari 
 // satu role .
	$arr_session_menu = array();
	
// on this process data OK 	
	$this->db->reset_select();
	$this->db->select("a.role_trx_formbar", FALSE);
	$this->db->from("t_gn_role_menu a");
	$this->db->join("tms_application_menu b ","a.role_trx_menu=b.id", "LEFT");
	$this->db->where("b.file_name", $ByRef);
	$this->db->where_in("a.role_trx_group", array_map('intval', $this->_select_role_user_session()));
	
	$rs = $this->db->get();
	if( $rs && $rs->num_rows() > 0 ) foreach( $rs->result_assoc() as $row ) {
		$arr_session_menu[] = explode(",", $row['role_trx_formbar']);
	}	
	
	// pre define array 
	$result_array = array();
	if(count($arr_session_menu) > 0 ) 
	foreach( $arr_session_menu as $k => $valarr ){
		foreach( $valarr as $keyval => $value ){
			$result_array[$value] = $value;	
		}
	}
	// return back data 
	return (array)$result_array;
}


/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_role_user_toolbar( $ByRef = null )
{ 
	$arr_session_menu = array();
	$this->db->reset_select();
	$this->db->select("a.role_trx_toolbar", FALSE);
	$this->db->from("t_gn_role_menu a");
	$this->db->join("tms_application_menu b ","a.role_trx_menu=b.id", "LEFT");
	$this->db->where("b.file_name", $ByRef);
	$this->db->where_in("a.role_trx_group", array_map('intval', $this->_select_role_user_session()));
	//$this->db->print_out();
	
 // result get data process OK will get set  
	$rs = $this->db->get();
	if( $rs && $rs->num_rows() > 0 ) foreach( $rs->result_assoc() as $row ){
		$arr_session_menu[] = explode(",", $row['role_trx_toolbar']);
	}	
	
 // if user redefine more then one role 
	$result_array = array();
	if( is_array($arr_session_menu) ) 
		foreach( $arr_session_menu as $key => $val ){
		 if(is_array( $val )) foreach( $val as $keyval  => $value ){
			$result_array[$value] = $value;
		}	
	}
	// debug($result_array);
	// then will get data process ok 
	return (array)$result_array;
}

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
public function _select_role_user_system()
{
 $ar_user_all = array();
 $sql = sprintf("select a.user_role_id, a.user_role_desc from t_lk_role_user a  
				 where a.user_role_flags=%d
				 order by a.user_role_level ASC", 1);
			
 $res = $this->db->query($sql);
 if( $res->num_rows() > 0 ) 
	foreach( $res->result_assoc() as $rows ){
		$ar_user_all[$rows['user_role_id']] = $rows['user_role_desc'];		
 }
 return (array)$ar_user_all;
}

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_role_user_session() {
	return $this->EUI_Session->_get_session('UserRole'); 
}
 
/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public function _select_role_menu_toolbar( $ByRef = null )
{ 
  $arr_role_toolbars = array();
  $this->ar_event_id = $this->_select_role_user_toolbar( $ByRef );
  // var_dump($this->ar_event_id);
  
  
 // ---------- then on here ----------------------
 
  $this->db->reset_select();
  $this->db->select("a.role_menu_event, a.role_menu_title, a.role_menu_icon", FALSE);
  $this->db->from("t_lk_role_menu a ");
  $this->db->where("a.role_menu_post", 'RM_TOOL_BAR');
  $this->db->where_in("a.role_menu_id", array_map('intval', $this->ar_event_id));
  $this->db->order_by("a.role_menu_order", 'ASC');

  $rs  = $this->db->get();
  $num = 0;
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$row = new EUI_Object( $rows );
	
	$arr_role_toolbars['title'][] = $row->get_value('role_menu_title', array('lang'));
	$arr_role_toolbars['event'][] = $row->get_value('role_menu_event','trim');
	$arr_role_toolbars['icon'][]  = $row->get_value('role_menu_icon', 'trim');
	$num++;
 }
  return (array)$arr_role_toolbars;
  
}
 
/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function _select_role_label_toolbar()
{
  
  $ar_label_toolbar = array();
  $this->db->reset_select();
  $this->db->select("a.role_menu_id, a.role_menu_title", false);
  $this->db->from("t_lk_role_menu a");  
  $this->db->where("a.role_menu_post","RM_TOOL_BAR");
  $this->db->order_by("a.role_menu_order", 'ASC');
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
 {
	$ar_label_toolbar[$row['role_menu_id']] = lang($row['role_menu_title']);  
  }
  
  return (array)$ar_label_toolbar;

}

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function _select_role_label_formbar()
{
  $ar_label_formbar = array();	
  $this->db->reset_select();
  $this->db->select("a.role_menu_id, a.role_menu_title", false);
  $this->db->from("t_lk_role_menu a");  
  $this->db->where("a.role_menu_post","RM_FORM_BAR");
  $this->db->order_by("a.role_menu_order", 'ASC');
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
 {
	$ar_label_formbar[$row['role_menu_id']] = lang($row['role_menu_title']);  
  }
  return (array)$ar_label_formbar;
  
}


/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 protected function _select_menu_action_sort( $uid = null )
{
	$arr_sorter = array();
	$arr_explode = explode(',', $uid );
	if( is_array($arr_explode) )
		foreach($arr_explode as $key => $val )
	{
		if( strlen($val)  > 0 ){
			$arr_sorter[$val] = $val; 
		}
	}
	
	asort($arr_sorter);
	return (array)$arr_sorter;
}


/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 protected function _select_trx_user_role_uid( $user =0, $uid = 0 )
{
	
 $arr_uid = array('toolbars' => array(), 'formbars' => array());
 $sql = sprintf(" SELECT * FROM t_gn_role_menu a WHERE a.role_trx_menu=%d AND a.role_trx_group =%d", $uid, $user);
 $qry = $this->db->query($sql);
  if( $qry->num_rows() > 0 )
 {
	if( $row = $qry->result_first_assoc() )
	{
		$out = new EUI_Object( $row );
		$arr_uid = array(
			'toolbars' => $this->_select_menu_action_sort( $out->get_value('role_trx_toolbar')),
			'formbars' => $this->_select_menu_action_sort( $out->get_value('role_trx_formbar'))
		);
	}
 }
 
 return new EUI_Object($arr_uid);
 
} 

/* 
 * Method 		select action for needed of checklist argument if empty this action 
				then will disabled checked on the grid session .
				look methode on "self::_UserMenuActionRole"	not view Only but it 
				component with mode "w = write x = execute"	
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 protected function _select_menu_action_uid( $uid=0 )
{
	
 $arr_uid = array('toolbars' => array(), 'formbars' => array());
 $sql = sprintf("select a.toolbars, a.formbars from tms_application_menu a where a.id=%d", $uid);
 $qry = $this->db->query($sql);
  if( $qry->num_rows() > 0 )
 {
	if( $row = $qry->result_first_assoc() )
	{
		$out = new EUI_Object( $row );
		$arr_uid = array(
			'toolbars' => $this->_select_menu_action_sort( $out->get_value('toolbars')),
			'formbars' => $this->_select_menu_action_sort( $out->get_value('formbars'))
		);
	}
 }
 
 return new EUI_Object($arr_uid);
 
} 

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_trx_toolbar_role_uid( $user=0, $uid =0){
	return $this->_select_trx_user_role_uid( $user, $uid )->get_value('toolbars');
} 

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_trx_formbar_role_uid( $user=0, $uid = 0 ){
	return $this->_select_trx_user_role_uid($user, $uid)->get_value('formbars');
} 


/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_menu_toolbar_uid( $uid = 0 ){
	return $this->_select_menu_action_uid( $uid )->get_value('toolbars');
} 

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_menu_formbar_uid( $uid = 0 ){
	return $this->_select_menu_action_uid( $uid )->get_value('formbars');
} 

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 function _select_menu_action_all_bars()
{
 
  $ar_find_all_menu = array();
  $sql = sprintf("select a.id, a.toolbars, a.formbars from tms_application_menu a where a.flag=%d", 1);
  $qry = $this->db->query($sql);
 
  if( $qry->num_rows() > 0 )  
	foreach( $qry->result_assoc() as $rows ) 
 {  
	$row = new EUI_Object($rows);
	if( $row->find_value('id') )
	{
		$ar_find_all_menu['toolbars'][$row->get_value('id')] = $row->get_array_order('toolbars');
		$ar_find_all_menu['formbars'][$row->get_value('id')] = $row->get_array_order('formbars');
	}
 }
 return (array)$ar_find_all_menu;
	
} 

/* 
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 function _select_menu_user_role_bars( $role = null )
{

//----------------------- rec -----------------------------------------------------------------------------	

  $ar_find_all_menu = array();
  
  $this->db->reset_select();
  $this->db->select("a.role_trx_group, a.role_trx_menu, a.role_trx_toolbar, a.role_trx_formbar ", FALSE);
  $this->db->from("t_gn_role_menu a ");
  $this->db->join("tms_application_menu b", "a.role_trx_menu=b.id", "LEFT");
  $this->db->where("b.flag", 1);
  
  if( is_array($role) and count($role) > 0 ){
	$this->db->where_in("a.role_trx_group", array_map('intval', $role) );  
  }	 else {
	  $this->db->where_in("a.role_trx_group", 0);  
  } 
  
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 )  
	foreach( $rs->result_assoc() as $rows ) 
 {  
	$row = new EUI_Object($rows);
	if( $row->find_value('role_trx_group') )
	{
		$ar_find_all_menu['toolbars'][$row->get_value('role_trx_menu')] = $row->get_array_order('role_trx_toolbar');
		$ar_find_all_menu['formbars'][$row->get_value('role_trx_menu')] = $row->get_array_order('role_trx_formbar');
	}
 }
 
 return (array)$ar_find_all_menu;
	
} 

// =================== END CLASS ======================================

}

?>