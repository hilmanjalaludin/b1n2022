<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysMenu extends EUI_Controller
{

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- construct --- 
 * 
 */ 
 
 function __construct() 
 {
	parent::__construct();
	
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- index --- 
 * 
 */ 
 
 function index()
 {
	if( _have_get_session('UserId') )
	{
		$_EUI['page'] = $this->M_SysMenu->_get_default();
		$_EUI['User'] = $this->M_SysUser->_get_handling_type();
		
		if( is_array($_EUI) ) {
			$this->load->view('sys_menu/view_menu_nav',$_EUI);
		}	
	}
 }
 
 
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- construct --- 
 * 
 */ 
 
 function Content()
 {
	if( _have_get_session('UserId') )
	{
		$_EUI['role'] = $this->M_UserRole->_select_role_table_action(get_class($this));
		$_EUI['page'] = $this -> M_SysMenu -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> M_SysMenu -> _get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('sys_menu/view_menu_list',$_EUI);
		}	
	}	
 }
 
// @ show_menu
 function showMenu()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['menu'] = $this -> M_SysMenu -> _get_show_menu( $this -> URI -> _get_post('GroupId') );
		if( is_array( $_EUI['menu'] )) 
		{
			$this -> load -> view('sys_menu/view_show_menu',$_EUI);
		}	
	}	
 } 
  
  
/* 
 * @ def : get Menu Json this like by jquery  OR ext.js
 * -------------------------------------------------------------
 * @ param via url akses 
 */

public function _getMenuJSON()
{
	$ApplicationMenu = base_menu_model();
	if(is_array($ApplicationMenu))
	{
		echo json_encode($ApplicationMenu); 
	}	
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- EditMenuTpl --- 
 * 
 */ 
 
function EditMenuTpl()
{
  $IDs  = _find_all_object_request()->get_value('menu_id');
  if( _get_is_login() ) 
{
	$this->load->view('sys_menu/view_edit_menu', array (
		'row' => new EUI_Object( get_class_instance('M_SysMenu')->_get_menu_detail($IDs) )
	));
  }
  
}
  
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- addMenuTpl --- 
 * 
 */ 
 
function addMenuTpl()
{
	if( _get_is_login() ) 
  {
		$this -> load -> view('sys_menu/view_add_menu', array(
			'row' => new EUI_Object(array())
		));
  }
  
}  
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- addMenuTpl --- 
 * 
 */ 
 

function setGroupMenu()
{
  
  if( $this -> EUI_Session -> _have_get_session('UserId') )
  {
	$_EUI['group'] = $this -> M_SysMenu -> _get_group_menu();	
	$_EUI['menuid'] =& $this -> URI -> _get_post('menuid');
	
	if( $_EUI )
	{
		$this -> load -> view('sys_menu/view_selgroup_menu', $_EUI);
	}	
  }	
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- addMenuTpl --- 
 * 
 */ 
 

function UpdateSelGroup()
{
  if( $this -> EUI_Session -> _have_get_session('UserId') )
  {
	if( class_exists('M_SysMenu')!=FALSE )
	{
		echo $this->M_SysMenu->_set_update_group( $this->URI->_get_post('menu'), $this->URI->_get_post('group') );	
	}	
  }
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- addMenuTpl --- 
 * 
 */ 
 
 
 public function PageMenuUser()
{
 
 // ----------- default parameter -----------------------
  
  $this->start_page = 0;
  $this->per_page = 10;
  
// ------------- loader object -------------------------	

  $this->args_finder = _find_all_object_request(); 
  $this->args_object =& get_class_instance(base_class_model($this));

 // ------------- then result data ---------------------------------
 
  $this->post_page  = (int)_get_post('page');
  $this->arr_result = array();
  $this->arr_content = $this->args_object->_set_page_menu_user( $this->args_finder );
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
 }	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("sys_menu/view_menu_user", $arr_page_address);	
}


// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 public function PageMenuList()
{
	
// ----------- default parameter -----------------------
  
  $this->start_page = 0;
  $this->per_page = 10;
  
// ------------- loader object -------------------------	

  $this->args_finder = _find_all_object_request(); 
  $this->args_object =& get_class_instance(base_class_model($this));

 // ------------- then result data ---------------------------------
 
  $this->post_page  = (int)_get_post('page');
  
  
  $this->arr_result = array();
  $this->arr_content = $this->args_object->_set_page_menu_list( $this->args_finder );
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_page_address = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("sys_menu/view_menu_page", $arr_page_address);
 
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 function AssignMenuTpl()
{
  $out = _find_all_object_request();	
   if( $out->find_value('UserId') )
  {
	 $this->load->view('sys_menu/view_menu_assign', $_EUI);
  }	
  
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 function AssignMenu()
{
  $out = _find_all_object_request();
  
  $cond = array('success' => 0 );
  if( !_get_is_login() ) {
	 echo json_encode($cond);
	 return FALSE;
  }  
  
  if( get_class_instance('M_SysMenu')->_set_assign_menu( $out )) {
	$cond = array('success' => 1 ); 
  }	 
  
  echo json_encode($cond);
  return FALSE;

}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
function RemoveMenu()
{
	
  $out = _find_all_object_request();
  $cond = array('success' => 0 );
  if( !_get_is_login() ) {
	 echo json_encode($cond);
	 return FALSE;
  }  
  
  if( get_class_instance('M_SysMenu')->_set_remove_menu( $out )) {
	$cond = array('success' => 1 ); 
  }	 
  
  echo json_encode($cond);
  return FALSE;

}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
function DisabledMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
	  // @ sent parameters 	
		if( $this -> M_SysMenu -> _set_disable_menu(0, $this -> URI->_get_array_post('menuid'))) 
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
function EnabledMenu()
{
	$success = array('success'=> 0, 'error'=> 'NO');
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
	  // @ sent parameters 	
		if( $this -> M_SysMenu -> _set_disable_menu(1, $this -> URI->_get_array_post('menuid'))) 
		{
			$success = array('success'=> 1, 'error'=> 'OK');	
		}
	}
	
	echo json_encode($success);
 }
 
// ---------------------------------------------------------------------------------
/*
 * @ pack		--- add_menu --- 
 * 
 */ 
 
 
 public function add_menu()
{
  
  $conds  = array('success'=>0);
  $find = _find_all_object_request();
  
  if( _get_is_login() )  
  {
	 if( get_class_instance('M_SysMenu')->_setSaveNewMenu( $find ) ){
		$conds  = array( 'success'=>1 );
	 }
  }
  
  echo json_encode($conds);
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */ 
 
 public  function update_menu()
{
	
 $conds  = array('success'=>0);
 $find = _find_all_object_request();
  if( $find->find_value('menu_uid') )  
  {
	 if( get_class_instance('M_SysMenu')->_setUpdateMenu( $find ) ){
		$conds  = array( 'success'=>1 );
	 }
  }
  
  echo json_encode($conds);
}

// ---------------------------------------------------------------------------------
/*
 * @ pack		--- instance of class --- 
 * 
 */
 
 public function DeleteMenu()
{
	$conds  = array('success'=>0);
	$find = _find_all_object_request();
	
	if( $find->find_value('menu_uid') ) 
	{
		if( get_class_instance('M_SysMenu')->_set_deleted_menu( $find ) )
		{
			$conds  = array( 'success'=>1 );
		}
	}
  
  echo json_encode($conds);
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 public function Role() {
	$out= UR();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    printf('%s', json_encode( $arr_role_toolbars ));
	return false;
 }
  
// =============== END CLASS =====================\
  
}

// END OF FILE 
// LOCATION : ./application/controller/sysmenu.php

?>