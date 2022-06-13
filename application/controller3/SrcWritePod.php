<?php
/*
 * E.U.I 
 *
 php -q /opt/enigma/webapps/hsbc_cc_tele/index.php SrcCustomerClosing PDF
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcWritePod extends EUI_Controller
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function __construct()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Bimage'));
	
 }
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
{
	if( !_get_is_login() ){  
		return FALSE; 
	}
	
	$this->load ->view('src_write_pod/view_write_pod_nav',array ( 
		'page'=> get_class_instance(base_class_model($this))->_get_default() 
	));
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( !_get_is_login() )
	{  
		return FALSE; 
	}
	
	$object =& get_class_instance(base_class_model($this));
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load->view('src_write_pod/view_write_pod_list',array(
		'button' => new EUI_Object( $roleobj ),
		'page' => $object->_get_resource(),
		'num'  => $object->_get_page_number()
	));
		
	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 
 public function SuspendType()
{
  $var =new EUI_Object( _get_all_request() );	
  $out =& get_class_instance('M_SrcCustomerList');
  $output = $out->_getDetailCustomer( $var->get_value('CustomerId'));
  
} 



// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
function EventWritePod()
{ 

 $error = array('success' => 0 );
 
 if( !_have_get_session('UserId') ) { 
	echo json_encode( $error ); 
	return false;
 }
 
// --- save pod on here  --------------------------------------
 
 $outs = _find_all_object_request();
 $objs = get_class_instance( base_class_model($this) );
 
  if(  $SourceId = $objs->_set_row_save_user_write_pod( $outs ) ) 
 {
	$error = array('success' => 1);
 } 
 
 
 echo json_encode( $error );
 return FALSE;
}



// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActionWritePod() 
{
	if( _get_is_login() ){
		$this->load->form("pod_form/frm_add_pod");
	}
}

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActionPrintPod(){
	if( _get_is_login() ){
		$this->load->form("pod_form/frm_print_pod");
	}
}

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function EventPrintPod(){
	
}


// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 
 public function RetrySendEmail()
{
	
  $cond = array('success' => 0);
  $out = _find_all_object_request();
  
  if( !$out->find_value('CustomerId') OR 
	!$out->find_value('ProductId') )
{
	$cond = array('success' => 0);
 }  
 
// -- call object data -- 

 $object =& get_class_instance(base_class_model($this));
  if( $object->_set_row_retry_send_email( $out ))
 {
	$cond = array('success' => 1); 
 }
 
 echo json_encode($cond);

} 

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function Barcode() 
 {
	 if( $this->URI->segment(3) ){
		InializeBarcode($this->URI->segment(3));
	 } else {
		 return null;
	 }
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

  public function ContactDetail()
 {
	if( !_have_get_session('UserId') ) { return FALSE; }
	 if(  _get_have_post('CustomerId') )
	{
		$var =_find_all_object_request();
		
	// --------------------------------------------------------------------------
	
		$out =& get_class_instance('M_SrcCustomerList');
		$bes =& get_class_instance(base_class_model($this));
		$arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId'));
		
		if( $arr_ouput ) 
		{	
			$arr_retry = $bes->_select_row_style_button_retry( $arr_ouput );
			$arr_attr  = $bes->_select_attr_confirm_detail( $var->get_value('CustomerId') );
			$arr_style = $bes->_select_attr_quality_status( $arr_ouput );
			$roleobj   = $this->M_UserRole->_select_role_form_action(get_class($this));
			
			$this->load->view('mod_write_pod/view_contact_main_detail', array(
				'Button' 	=> new EUI_Object( $roleobj ),
				'Detail' 	=> new EUI_Object( $arr_ouput ),
				'Attrs' 	=> new EUI_Object( $arr_attr ),
				'Class' 	=> new EUI_Object( $arr_style ),
				'Retry'		=> new EUI_Object( $arr_retry )
			));
		}
	}
	
  }

  
// ---------------------------------------------------------------------------------------------------------

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
 
// ============================== END CLASS ==============================
 
}
?>