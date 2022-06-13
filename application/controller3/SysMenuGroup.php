<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class SysMenuGroup extends EUI_Controller
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
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 
/*
 * @ constructor 
 */
 
 // function __construct()
 // {
	// parent::__construct();
	
	// if( !class_exists('M_SysMenuGroup') && !class_exists('M_SysUser') )
	// {
		// $this -> load -> model('M_SysMenuGroup');
		// $this -> load -> model('M_SysUser');
	// }	
 //}
 

 // ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
  */
 function index()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$_EUI['privileges'] = $this->M_SysUser->_get_handling_type();
		$_EUI['menugroup']  = $this->M_SysMenuGroup->_get_menu_group();
		$_EUI['page'] 		= $this->M_SysMenuGroup->_get_default();
		
		if( count($_EUI) > 0 )
		{
			$this -> load -> view('sys_group/view_gmenu_nav', $_EUI);
		}	
	}
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
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> M_SysMenuGroup -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SysMenuGroup -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('sys_group/view_gmenu_list',$_EUI);
		}	
	}	
 }

 // ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
  */
 function ShowMenuGroup()
 {
	// if( $this -> EUI_Session->_have_get_session('UserId') )
	// {
		// $EUI['ListGroupMenu'] = $this -> M_SysMenuGroup -> _get_list_group_menu( $this -> URI -> _get_post('privileges') ); 
		// $this -> load -> view('sys_group/view_gmenu_show.php', $EUI );
	// }
 }
 

 // ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
  */
 function RemoveMenuGroup()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		if( $this -> M_SysMenuGroup -> _set_remove_group_menu(
			$this ->URI-> _get_post('Privileges'),
			$this ->URI-> _get_array_post('GroupMenu')
		) ){
			$success = array('success'=> 1, 'error'=> 'NO');
		}
	}
	
	echo json_encode($success);
 }
 

 // ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
  */
 function AssignMenuGroup()
 {
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		if( $this -> M_SysMenuGroup -> _set_assign_group_menu(
			$this ->URI-> _get_post('Privileges'),
			$this ->URI-> _get_array_post('GroupMenu')
		) ){
			$success = array('success'=> 1, 'error'=> 'NO');
		}
	}
	
	echo json_encode($success);
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
	$this->load->view('sys_group/view_gmenu_add', array(
		'btn' => Singgleton($this)->_select_row_data_role( $this )
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
	$this->load->view('sys_group/view_gmenu_edit',array(
		'row' => Singgleton($this)->_select_row_data_detail( ObjectRequest()->get_value('GU_Id'), 'Objective'),
		'btn' => Singgleton($this)->_select_row_data_role( $this )	
		
	));
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
	$out = ObjectRequest(); // get all var object 
  $std = Singgleton($this); // get call class model 
  
 // --- msg call  -----------------------------------------------
  $ar_message = array('success' => 0); 
  if( $std->_update_row_group_menu( $out ) ) {
	$ar_message = array('success' => 1);
  } 	

 // --- return JSON Data to client  ------------------------------------------
 
  printf("%s", json_encode( $ar_message) );
	
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
  $out = ObjectRequest(); // get all var object 
  $std = Singgleton($this); // get call class model 
  
 // --- msg call  -----------------------------------------------
  $ar_message = array('success' => 0); 
  if( $std->_save_row_group_menu( $out ) ) {
	$ar_message = array('success' => 1);
  } 	

 // --- return JSON Data to client  ------------------------------------------
 
  printf("%s", json_encode( $ar_message) );
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
  $out = ObjectRequest(); // get all var object 
  $std = Singgleton($this); // get call class model 
  
 // --- msg call  -----------------------------------------------
  $ar_message = array('success' => 0); 
  if( $std->_delete_row_group_menu( $out ) ) {
	$ar_message = array('success' => 1);
  } 	

 // --- return JSON Data to client  ------------------------------------------
  printf("%s", json_encode( $ar_message) );
  
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
	 $out = ObjectRequest(); // get all var object 
  $std = Singgleton($this); // get call class model 
  
 // --- msg call  -----------------------------------------------
  $ar_message = array('success' => 0); 
  if( $std->_aktivasi_row_group_menu( $out ) ) {
	$ar_message = array('success' => 1);
  } 	

 // --- return JSON Data to client  ------------------------------------------
 
  printf("%s", json_encode( $ar_message) );
 }
 
 
// ----------------------------------------------------------------------------------------------------------------
/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
 
 function Role(){ 
	 $this->ar_role = array(); 
    if( ObjectRequest()->find_value('modul') ){
	  $this->ar_role = SystemRoleTool($this); 
    }
	
	printf("%s", json_encode( $this->ar_role ));
 } 
 // ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
  */
  
 // ======================================================= END CLASS  =============================================  

}
 
?>