<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SysPrivileges extends EUI_Controller{

// ------------------------------------------------------------------------

/**
 * Index page
 *
 * Returns the "index_page" from your config file
 *
 * @access	public
 * @return	string
 */
 
 function __construct() 
{
  parent::__construct();
  $this->load->model(array(base_class_model($this))); // load model user
  $this->load->helper(array('EUI_Object')); // 
}

// ------------------------------------------------------------------------

/**
 * Index page
 *
 * Returns the "index_page" from your config file
 *
 * @access	public
 * @return	string
 */
 
 function index() 
{
   if( !_get_is_login() ) { return NULL; }
   
   $this->load->view("sys_user_privileges/view_privileges_nav", array(
	'page' => $this->{base_class_model($this)}->_select_count_page() 
   ));
}


// ------------------------------------------------------------------------

/**
 * Index page
 *
 * Returns the "index_page" from your config file
 *
 * @access	public
 * @return	string
 */
 
 function content() 
{
	
 if( !_get_is_login() ) { 
	return NULL; 
 }
 
 $this->load->view("sys_user_privileges/view_privileges_list", array(
	'role' => $this->M_UserRole->_select_role_table_action(get_class($this)),
	'page' => $this->{base_class_model($this)}->_select_row_page(),
	'num'  => $this->{base_class_model($this)}->_select_num_page() 
 ));
 
}

// ------------------------------------------------------------------------

/**
 * Index page
 *
 * Returns the "index_page" from your config file
 *
 * @access	public
 * @return	string
 */

function Delete()
{


 $vars = _find_all_object_request();
 $cond = array('success'=> 0);
 
 $PrivilegeId = $vars->get_array_value('PrivilegeId');
 
 if(  !is_array( $PrivilegeId ) ) {
	echo_json_encode(0);
	return false;
 }
 
 $return = $this->{base_class_model($this)}->_del_row_user_privileges( $PrivilegeId );
 if( $return ) {
	$cond = array('success'=> 1);	
 }
 
 echo_json_encode($cond);
 return false;
 
}

// ------------------------------------------------------------------------

/* 
 * Def AddPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */


  public function Add()
{
   if( !_get_is_login() ) 
  {
	 exit(0);
  }
  
 $out = $this->M_UserRole->_select_role_form_action(get_class($this));
 $this->load->view('sys_user_privileges/view_add_privileges', array(
	'button' => new EUI_Object( $out )
 ));
  
}

// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

 public function Edit()
{
	if( !_get_is_login() ){
		echo_json_encode(0);
		return FALSE;
	}
	
	$row_user = $this->{base_class_model($this)}->_select_row_user_privilege( _find_all_object_request() );
	$btn_user = $this->M_UserRole->_select_role_form_action( get_class($this) );
	$this->load->view('sys_user_privileges/view_edit_privileges', array(
		"row" => new EUI_Object( $row_user ), 
		"btn" => new EUI_Object( $btn_user )
	));
	
}


// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
function Disable()
{
 if( !_get_is_login() ) {
	echo_json_encode(0);
	return FALSE;
 }
	
 if($this->{base_class_model($this)}->_set_row_privilege_activasi(0)  ){
	echo_json_encode(1);
	return FALSE;
 }	
  
  echo_json_encode(0);
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
function Enable()
{
 if( !_get_is_login() ) {
	echo_json_encode(0);
	return FALSE;
 }
	
 if($this->{base_class_model($this)}->_set_row_privilege_activasi(1)  ){
	echo_json_encode(1);
	return FALSE;
 }	
  
  echo_json_encode(0);
  return FALSE;
}
// ------------------------------------------------------------------------

/* 
 * Def SavePrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

 function Save() 
{

 if( !_get_is_login() ) {
	echo_json_encode(0);
	return FALSE;
 }
 
 $cond = $this->{base_class_model($this)}->_add_row_user_privilege();
 if( $cond  ){
	echo_json_encode(array( 'success' => 1,  'PrivilegeId' =>  $cond ));
	return FALSE; 
 }
 
 echo_json_encode(1);
 return FALSE; 

}

// ------------------------------------------------------------------------

/* 
 * Def SavePrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

 function Update() 
{
	
  if( !_get_is_login() ) {
	echo_json_encode(0);
	return FALSE;
  }
 
 $cond = $this -> {base_class_model($this)} -> _update_row_user_privilege( _find_all_object_request() );
 if(  $cond )  {
	echo_json_encode(1);
	return false;
 }
 
 echo_json_encode(0);
 return false;
}

// ------------------------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Role()
{
	$out= _find_all_object_request();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }

 
// ======================= END CLASS PRIVILEGES ==============================================

}

// END OF FILE 
// location : ./application/controller/SysUser.php
?>