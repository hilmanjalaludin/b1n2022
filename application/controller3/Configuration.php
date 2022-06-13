<?php
// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 
class Configuration extends EUI_Controller
{
// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
function __construct()
{
	parent::__construct();
	$this ->load->model(array(base_class_model($this)));
	$this ->load->helper(array('EUI_Object'));
}



// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */
 function index()
{
	if( !_get_is_login() ) { echo_json_encode(0);
		return FALSE;
	}
	
	$this->load->view('mod_configuration/view_configuration_nav',array(
		"page" => $this->{base_class_model($this)}->_get_default()
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
function Content()
{
	if( !_get_is_login() ) { 
		echo_json_encode(0);
		return FALSE;
	}
	
	$this->load->view('mod_configuration/view_configuration_list', array (
	 "role" => $this->M_UserRole->_select_role_table_action(get_class($this)),
	 "page" => $this->{base_class_model($this)}->_get_resource(),
	 "num"  => $this->{base_class_model($this)}->_get_page_number()
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
function Delete()
{
 if( !_get_is_login() ) { 
	echo_json_encode(0);
	return FALSE;
  }
  
 $ConfigID = _find_all_object_request()->get_array_value('ConfigID');
 $cond = get_class_instance('M_Configuration')->_setDeleteConfig( $ConfigID );
 
  if( $cond ) 
 {
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
 function Update()
{
	if( !_get_is_login() ) { 
		echo_json_encode(0);
		return FALSE;
	}
	
	$respn = array('success'=>0);
	$cond = $this->{base_class_model($this)}->_setUpdateConfig( _find_all_object_request() );
	if( $cond ) {
		$respn = array('success'=>1);	
	}
	echo_json_encode( $respn );
 }
 
// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
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
	
	$respn = array('success'=>0);
	$cond = $this->{base_class_model($this)}->_setSaveConfig( _find_all_object_request() );
	if( $cond ) {
		$respn = array('success'=>1);	
	}
	echo_json_encode( $respn );
 }
 
// ------------------------------------------------------------------------

/* 
 * Def EditPrivileges
 *
 * @ param 	: data array()
 * @ aksess : public 
 *
 */

function Edit()
{
	if( !_get_is_login() ) {
		exit(0);
	}
	
	$row = $this->{base_class_model($this)}->_getConfiguration( _find_all_object_request()->get_value('ConfigID') );
	$btn = $this->M_UserRole->_select_role_form_action( get_class($this) );
	$this->load->view('mod_configuration/view_configuration_edit',array(
	  'row' => new EUI_Object( $row ),
	  'btn' => new EUI_Object( $btn )
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
 
 function Add()
 {	
	if( !_get_is_login() ) {
		exit(0);
	}
	
	$btn = $this->M_UserRole->_select_role_form_action( get_class($this) );
	$this -> load -> view('mod_configuration/view_configuration_add',array(
		"btn" => new EUI_Object($btn)
	));
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



// ========================= END CLASS ============================ 

 
}


?>