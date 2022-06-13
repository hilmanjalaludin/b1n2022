<?php
/*
 * EUI Model  
 *
 
 * Section  : < M_User > get information user on table 
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class M_Menu extends EUI_Model {

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
private static $Instance = null;

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public static function &Instance()  
{
  if( is_null( self::$Instance ) ){
	self::$Instance = new self();
  }
  return self::$Instance;	
}
	
	
// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */

function __construct() { 
	$this->load->helper(array('EUI_Object'));
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
/*
 * [reconstruction query from other file]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 protected function  _select_row_group( $GroupId = 0, $escape = 0 ) {
	 
 // for mor efectively : 	 
 if( !is_array($escape) ){
	$escape = array( $escape );
 }
 
 // then we to read on [cache]
 $cache = cache();
 $fetchArray = $cache->cache_read('appmenubygroup'); //array();
 if(!$cache->cache_ready('appmenubygroup') ){
	 
	// select data first time only : 
	$this->db->reset_select();
	$this->db->select("b.GroupId, b.GroupName, a.images, a.id, a.file_name, a.el_id, a.menu", false);
	$this->db->from("tms_application_menu a ");
	$this->db->join("tms_group_menu b","a.group_menu=b.GroupId","LEFT");
	$this->db->where('a.flag',1);
	$this->db->where('b.GroupShow',1);
	$this->db->order_by('a.OrderId', 'ASC');
	
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach($qry->result_assoc() as $row ){
		$fetchArray[$row['GroupId']][$row['id']] = $row;	
	}
	// write cache to [JSON]
	$cache->cache_write('appmenubygroup', $fetchArray);
}

 // get fetchArray  from [cache]
 $resultArray = array();
 if( is_array( $fetchArray) 
  and isset($fetchArray[$GroupId]) ){
	$resultArray = (array)$fetchArray[$GroupId];
 }
 // data process : 
 return (array)$resultArray;
 
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public function _get_acess_menu( $escape = 0)
{
  $arr_merge_user  = array();
  $arr_list_menu   = $this->_get_list_menu();
  $arr_list_aksess = $this->_get_akses_menu();

  
  if( is_array( $arr_list_menu ) AND count($arr_list_menu) > 0 )  
	  foreach( $arr_list_menu as $key => $GroupId ) 
  {
		$row = $this->_select_row_group( $GroupId, $escape);
		
		if( is_array( $row ) ) foreach( $row as $rows )
		{
			$out = new EUI_Object( $rows );
		
			// ========== > wil scan on list data <=============================
			
			 if( in_array($out->get_value('id'),  $arr_list_aksess ) )
			{
				 $arr_merge_user[$out->get_value('GroupName')][$out->get_value('id')] =  array
				(
					'file_name' => $out->get_value('file_name'),
					'menu' 		=> $out->get_value('menu'),
					'id' 		=> $out->get_value('el_id'),
					'groupid' 	=> $out->get_value('GroupId'),
					'images'	=> $out->get_value('images'),
					'style' 	=>'cssmenus'
				);
			}	
		}
	}
	
 return (array)$arr_merge_user;
} 

// -------------------------------------------------------------------------------------------------
 /* is  version */
 
 protected function _get_role_menu() 
{
	$arr_role_menu = array();
	$this->db->reset_select();
	$this->db->select("a.role_trx_menu");
	$this->db->from("t_gn_role_menu a ");
	$this->db->join("tms_application_menu b "," a.role_trx_menu=b.id", "INNER");
	$this->db->where("b.flag", 1);
	
	if( CK()->field('UserRole') 
		and is_array(CK()->field('UserRole')) )
	{
		$this->db->where_in("a.role_trx_group", CK()->field('UserRole'));
	}
	
	$rs = $this->db->get();
	 if( $rs->num_rows() > 0 ) 
		 foreach( $rs->result_assoc() as $row )
	{
		$arr_role_menu[$row['role_trx_menu']] = $row['role_trx_menu'];
	} 	
	
	return (array)$arr_role_menu;
}


// ---------------------------------------------------------------------------------------
/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */
 
 function _get_list_menu()
{
	
 $arr_userlist = array();
 
 // update on menu group aksess from here .
 
 $this->result_assoc  = array();
 $this->db->reset_select();
 $this->db->select("c.GroupId, c.GroupName ", false);
 $this->db->from('t_gn_role_menu a ');
 $this->db->join('tms_application_menu b', 'a.role_trx_menu=b.id', 'left');
 $this->db->join('tms_group_menu c','b.group_menu=c.GroupId', 'left');
 $this->db->where('c.GroupShow', 1 );
 $this->db->where_in('a.role_trx_group', CK()->field('UserRole'));
 $this->db->group_by('c.GroupId');
 $this->db->order_by('c.GroupOrder', 'ASC');
 
 //== skip $this->db->print_out(); ====
 $qry = $this->db->get();
 if( $qry && $qry->num_rows()> 0 ) 
 foreach( $qry->result_record() as $row ){
	$this->result_assoc[] = $row->field('GroupId'); 
 } 
 return (array)$this->result_assoc;
 
}
// end function  ================>
  
  
// ---------------------------------------------------------------------------------------
/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */
 
 public function _get_akses_menu( $HandlingType = null )
{
 
 if( is_null($HandlingType ) ) {
	$this->HandlingType = CK()->field('HandlingType');
 } else {
	$this->HandlingType = $HandlingType;
 }
 
 
 if( !is_array( $this->HandlingType ) ){
	$this->HandlingType = array( $this->HandlingType );
 } 
 
 
 
 // get over role menu this for new application  ---
 $arr_menu = $this->_get_role_menu();
 return (array)$arr_menu;
  
  
} 
// end function  ================>
 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */

 function _get_group_icon()
 {
	$cache = cache(); // add cache lib on data function 
	$ar_list = $cache->cache_read('groupmenu');
	if( !$cache->cache_ready('groupmenu') ){ 
		$sql = sprintf("select a.GroupId, a.GroupName, a.GroupImage, a.GroupFonts from tms_group_menu a where a.GroupShow=%d", 1);
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_record() as $row ) {
			$ar_list[$row->field('GroupName')]['GroupImage'] = $row->field('GroupImage');
			$ar_list[$row->field('GroupName')]['GroupFonts'] = $row->field('GroupFonts');
		}
		// then will [cache_write]
		$cache->cache_write('groupmenu', $ar_list);
	}
	// return back [data]
	return $ar_list;
 } 
  
  // ============================= END CLASS ==================================
}
 
 
 ?>