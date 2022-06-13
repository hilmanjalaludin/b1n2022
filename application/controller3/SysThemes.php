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
 
class SysThemes extends EUI_Controller
{

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
function __construct() {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
 function index()
{
  if( !_have_get_session('UserId') ){
	return false;	
 }
 
 $std = &Singgleton($this);
 $this->load->view("sys_themes/view_themes_nav", array(
	'page' => $std->_select_row_page_size()
 ));	
 
}
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function content() 
{ 
  if( !_have_get_session('UserId') ) {  
	return FALSE; 
  }
 
  $std=&Singgleton($this);
  $this->load->view('sys_themes/view_themes_list',array(
	 'page' => $std->_select_row_page_row(),
	 'num'  => $std->_select_row_page_num(),
	 'role' => SystemTableAct($this)
  ));
 
}
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function Save()
 {
	$cond = array( 'success' => 0 );
	if( !get_cokie_value('UserId')){
		printf('%s', json_encode($cond));
		return false;
	}
	
	$std =& Singgleton($this);
	if( $std-> _save_row_theme_data( ObjectRequest() )){
		$cond = array('success'=>1);
	}	
		
	printf("%s", json_encode($cond)); 
	
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function Aktivasi()
 {
	$cond = array('success'=>0);
	
	if( !get_cokie_value('UserId')){
		printf('%s', json_encode($cond));
		return false;
	}
	$std =& Singgleton($this);
	if( $std-> _aktivasi_row_theme_data( UR() )){
		$cond = array('success'=>1);
	}	
		
	printf("%s", json_encode($cond));
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
  function Delete()
 {
	$cond = array( 'success' => 0 );
	
	if( !get_cokie_value('UserId')){
		printf('%s', json_encode($cond));
		return false;
	}
	
	$std =& Singgleton($this);
	if( $std-> _delete_row_theme_data( ObjectRequest() )){
		$cond = array('success'=>1);
	}	
	printf("%s", json_encode($cond));
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function Add()
 {
	
	$std=&Singgleton($this);
	$out=&ObjectRequest();
	
	$this->LayId = $out->get_value('ThemeId');
	$this->load->view("sys_themes/view_add_layout", array(
		'row' => $std->_select_row_layout_data($this->LayId, 'Objective'),
		'btn' => SystemRoleFrm($this, 'Objective')
	));
	
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
  function Edit()
{
	$std=&Singgleton($this);
	$out=&ObjectRequest();
	
	$this->LayId = $out->get_value('ThemeId');
	 $this->load->view("sys_themes/view_edit_layout", array(
		'row' => $std->_select_row_layout_data($this->LayId, 'Objective'),
		'btn' => SystemRoleFrm($this, 'Objective')
	));
	
 }
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function Submit()
 {
	$_conds = array('success'=>0);
	
	$SaveLayout = $this -> URI -> _get_all_request();
	if( is_array($SaveLayout))
	{
		$SaveLayout['Images'] = $SaveLayout['Name'].'.png';
		
		if( $this ->{base_class_model($this)}->_setSaveLayout($SaveLayout))
		{
			$_conds = array('success'=>1);
		}	
	}
	
	echo json_encode($_conds);
 }
 // ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 function Update()
 {

  $cond = array( 'success' => 0 );
  if( !get_cokie_value('UserId')){
	printf('%s', json_encode($cond));
	return false;
  }
	
  $std =& Singgleton($this);
  if( $std-> _update_row_theme_data( ObjectRequest() )){
	$cond = array('success'=>1);
  }	
		
 printf("%s", json_encode($cond));  
 
	// $_conds = array('success'=>0);
	
	// $UpdateLayout = $this -> URI -> _get_all_request();
	// if( is_array($UpdateLayout))
	// {
		// if( $this ->{base_class_model($this)}->_setUpdateLayout($UpdateLayout)) 
		// {
			// $_conds = array('success'=>1);
		// }	
	// }
	
	// echo json_encode($_conds);
 }
 
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function Role() 
 {
	$out= ObjectRequest();
	// --- select of row  ---
	
	$this->ar_list = array();
	if( $out->find_value('modul') ){
		$this->ar_list = SystemRoleTool($out->get_value('modul') );
	}
    printf("%s", json_encode($this->ar_list));
 }

// ================ END PHP CLASS  ====================== 
}

?>