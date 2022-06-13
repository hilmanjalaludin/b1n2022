<?php
 
 class SrcApprovalPod extends EUI_Controller 
{

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  function __construct() 
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 
 
 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */

 function index()
{
	$out=& get_class_instance('M_SrcApprovalPod');
	$this->load ->view('src_approval_pod/view_approval_nav',array (
		'page' => $out->_select_pager_count()
	));
}

 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */

 function content()
{
	
  if(!_have_get_session('UserId') ) {
	  return false;
   }
  
		
	$object =& get_class_instance(base_class_model($this));
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load->view('src_approval_pod/view_approval_list',array(
		'button' => new EUI_Object( $roleobj ),
		'page' => $object->_select_pager_source(),
		'num'  => $object->_select_pager_number()
	));
}
 
// http://10.10.10.234/hsbc/index.php/SrcApprovalPod/EventApprovePod
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
  function EventRejectPod()
{
	$cond = array('success' => 0 );
	$obj = & get_class_instance(base_class_model($this)); 
	if( $obj->_set_row_save_user_reject_pod( _find_all_object_request() )) 
	{
		$cond = array('success' => 1 );
	}
	
	echo json_encode($cond);
	
 }
 
 /* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function EventApprovePod()
 {
	$cond = array('success' => 0 );
	$obj = & get_class_instance(base_class_model($this)); 
	if( $obj->_set_row_save_user_approve_pod( _find_all_object_request() )) 
	{
		$cond = array('success' => 1 );
	}
	
	echo json_encode($cond);
 }
 
// -----------------------------------------------------------

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
 
	 
// ============================= END CLASS ===================================
 
}

?>