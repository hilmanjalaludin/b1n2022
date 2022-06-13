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
class M_SysThemes extends EUI_Model
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
 
 public static function &Instance()
{
  if( is_null( self::$Instance ) ) {		
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
 $this->EUI_Page->_setSelect("a.Id");
 $this->EUI_Page->_setFrom("t_gn_layout a ", true);
  
 // --- filter vdata  ----
 
 $this->EUI_Page->_setLikeCache("a.Name", "TH_Layout_Name", TRUE);
 $this->EUI_Page->_setAndCache("a.Flags", "TH_Layout_Flag", TRUE);
 
 //printf('%s', $this->EUI_Page->_getCompiler());
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
  $out = ObjectRequest();
   
  $this->EUI_Page->_postPage($out->get_value('v_page'));
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
  
  
 // --- select an array page  --------------------------------------------------------------------
//select a.Id, a.Name, a.Images, a.Author, a.Description, a.Flags FROM t_gn_layout a
 
  $this->EUI_Page->_setArraySelect(array(
	"a.Id as ThemeId"				=> array("ThemeId", 		"ThemeId", "primary"), 
	"a.Name as LayoutName"			=> array("LayoutName", 		"GM_Label_Name"), 
	"a.Id as LayoutImages"		=> array("LayoutImages", 		"GM_Label_Image"), 
	"a.Author as LayoutAuthor"		=> array("LayoutAuthor", 	"GM_Label_Creator"), 
	"a.Description as LayoutDesc"	=> array("LayoutDesc", 		"GM_Label_Description"),
	"a.Flags as LayoutFlags" 		=> array("LayoutFlags", 	"GM_Flags")
  ));
  
  $this->EUI_Page->_setFrom("t_gn_layout a ", TRUE);
  
// ----------- filter  ---------------------------
 $this->EUI_Page->_setLikeCache("a.Name", "TH_Layout_Name", TRUE);
 $this->EUI_Page->_setAndCache("a.Flags", "TH_Layout_Flag", TRUE);
  
// -----------if have order sorted ---------------------------------

 if( $out->find_value("order_by") ) {
	$this->EUI_Page->_setOrderBy($out->get_value("order_by"), $out->get_value("type"));
 } else {
	$this->EUI_Page->_setOrderBy("a.Id", "DESC");
 }
 

// -----------then limit on here ---------------------------------
 $this->EUI_Page->_setLimit();
//printf("%s", $this->EUI_Page->_getCompiler());

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
	
	$sql = sprintf("select * from t_gn_layout a where a.Id =%d", $LayoutId);
	 
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

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _update_row_theme_data( $out = null )
{
 
 $this->ar_cond = 0; 
 if( is_null( $out ) OR !is_object($out) ){
	return false;
 }	
 
 
 $this->db->where('Id', $out->get_value('TH_Theme_Id') );		
 $this->db->set("Name", $out->get_value('TH_Name') );
 $this->db->set("Author", $out->get_value('TH_Author'));
 $this->db->set("Description", $out->get_value(''));
 $this->db->set("Flags", $out->get_value('TH_Flags'));
 $this->db->set("CreatedTs", date('Y-m-d H:i:s'));
 $this->db->update("t_gn_layout");
 if( $this->db->affected_rows() > 0  )
 {
	$val = $out->get_value('TH_Theme_Id');
	
// --- save data to loger  --- 
	
	$dtl = $this->_select_row_layout_data($val, 'Objective');
	if( $dtl->find_value('Id') ) {
		EventLoger("UPD", sprintf( "USER UPDATE LAYOUT THEME WITH NAME [%s]", $dtl->get_value('Name')));
	} 
	$this->ar_cond++; 
 }
 
 return $this->ar_cond; 
} // -- end  function --


// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _save_row_theme_data( $out = null )
{
  $this->ar_cond = 0; 
 if( is_null( $out ) OR !is_object($out) ){
	return false;
 }	

// clear of the cache data set object 

 $this->db->reset_write();
 $this->db->set("Name", $out->get_value('TH_Name') );
 $this->db->set("Author", $out->get_value('TH_Author'));
 $this->db->set("Description", $out->get_value(''));
 $this->db->set("Flags", $out->get_value('TH_Flags'));
 $this->db->set("CreatedTs", date('Y-m-d H:i:s'));
 $this->db->insert("t_gn_layout");
 if( $this->db->affected_rows() > 0  )
 {
	$val = $this->db->insert_id();
// --- save data to loger  --- 
	$dtl = $this->_select_row_layout_data($val, 'Objective');
	if( $dtl->find_value('Id') ) {
		EventLoger("ADD", sprintf( "USER ADD LAYOUT THEME WITH NAME [%s]", $dtl->get_value('Name')));
	} 
	
	$this->ar_cond++; 
 }
 
 return $this->ar_cond;
 
 
} // -- end  function --
 
/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getUserThemes()
{
	$_conds = array();
	$this->db->select('*');
	$this->db->from('tms_application_themes');
	// t_lk_application_themes
	//$this->db->print_out()
	
	foreach( $this -> db ->get() -> result_assoc() as $rows ) {
		$_conds[$rows['id']] = $rows['name'];
	}
	
	return $_conds;
	
}
/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getUserLayout()
{
	$_conds = array();
	$this -> db ->select('*');
	$this -> db ->from('t_gn_layout');
	$this -> db ->where('Flags',1);
	
	foreach( $this -> db ->get() -> result_assoc() as $rows ) {
		$_conds[$rows['Id']] = $rows['Name'];
	}
	
	return $_conds;
	
}

/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getLayout()
{
	$_conds = array();
	
	$this -> db ->select('*');
	$this -> db ->from('t_gn_layout');
	$this -> db ->where_in('Flags',array(1,0));
	$this -> db ->order_by('Id','DESC');
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_conds[$rows['Id']] = array
		(	
			'Name' => $rows['Name'],
			'Images' => $this -> Layout -> base_style() .'/'. $rows['Name'] .'/images/'.$rows['Images'],
			'Author' => $rows['Author'],
			'Description' => $rows['Description'],
			'Flags' => $rows['Flags'] 
		); 
		
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
function _aktivasi_row_theme_data( $out = null )
{
 $this->ar_theme = array();
 if( is_null( $out ) OR !is_object($out) ){
	return false;
 }	
	
 $this->ar_theme = $out->get_array_value('ThemeId');
  
 
 $this->ar_record = 0;
 if( count($this->ar_theme) > 0 ) 
	 foreach( $this->ar_theme as $key => $val )
{
	$this->db->reset_write();
	$this->db->set("Flags", $out->get_value('Aktive'), false);
	$this->db->set("CreatedTs", date('Y-m-d H:i:s'));
	$this->db->where('Id', $val);
	
	if( $this->db->update('t_gn_layout') ){
		
		$dtl = $this->_select_row_layout_data($val, 'Objective');
		if( $dtl->find_value('Id') ) 
		{
			// -- disable  --	
			if( $out->get_value('Aktive') == 0 ){
				EventLoger("DIS", sprintf("USER AKTIVASI LAYOUT THEME WIDTH ID[%s] AKTIVE[%s]", $dtl->get_value('Name'),$dtl->get_value('Flags')));
			}
		
			// -- enable  -- 
			
			if( $out->get_value('Aktive') == 1 ){
				EventLoger("ENB", sprintf("USER AKTIVASI LAYOUT THEME WIDTH ID[%s] AKTIVE[%s]", $dtl->get_value('Name'),$dtl->get_value('Flags')));
			}	
		}
		$this->ar_record++;
	}
 }
 
 return $this->ar_record;
 
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
 function _delete_row_theme_data( $out = null )
{
 
 $this->ar_theme = array();
 $this->ar_record = 0;
 
 if( is_null( $out ) OR !is_object($out) ){
	return false;
 }	

   
 $this->ar_theme = $out->get_array_value('ThemeId');
 
  if( count($this->ar_theme) > 0 ) 
	foreach( $this->ar_theme as $key => $val )
 {
	$dtl = $this->_select_row_layout_data($val, 'Objective');
	if( $dtl->find_value('Id') ) {
		EventLoger("RPT", sprintf( "USER DELETE LAYOUT THEME WIDTH ID[%s]", $dtl->get_value('Name')));
	}
		
	// -- then real delete row table  -- 
	
	$this->db->reset_write();
	$this->db->where('Id', $val);
	if( $this->db->delete('t_gn_layout') ) {
		$this->ar_record++;
	}
	
 }
 
  return $this->ar_record;
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 

function _setUpdateLayout( $Update=null)
{
	$_conds = 0;
	if(!is_null($Update) )
	{
		foreach( $Update as $fieldname => $fieldvalue )
		{
			if($fieldname=='Id'){
				$this -> db -> where($fieldname,$fieldvalue);
			}
			else{
				$this -> db -> set($fieldname,$fieldvalue);
			}
		}
		
		$this -> db -> update('t_gn_layout');
		if( $this->db->affected_rows() > 0) {
			$_conds++;
		}
	}
	
	return $_conds;
}

//

function _setSaveLayout($Layout=null){
	$_conds = 0;
	if( is_array($Layout) )
	{
		if( $this -> db->insert('t_gn_layout',$Layout) ){
			$_conds++;
		}
	}
	
	return $_conds;
	
	
}

}

?>