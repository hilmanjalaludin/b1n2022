<?php
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class SrcFollowupPod extends EUI_Controller
{
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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
	
	$this->load ->view('src_followup_pod/view_followup_pod_nav',array ( 
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
	if( !_get_is_login() ) {  
		return FALSE; 
	}
	
	$single = Singgleton($this);
	$rolel = Singgleton('M_UserRole'); 
	
// get button role data process 	
	$button = $rolel->_select_role_form_action($this);
	
// sent data view loadern pager 	
	$this->load->view('src_followup_pod/view_followup_pod_list',array(
		'button' => new EUI_Object( $button ),
		'page'   => $single->_get_resource(),
		'num'    => $single->_get_page_number()
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
 
  if(  $SourceId = $objs->_set_row_save_user_followup_pod( $outs ) ) 
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
 
function Followup()  {
	$out = UR();
	$this->callBackMsg = array('success' => 0 );
	
	// check by check if falsa data 
	if( !$out->find_value('CustomerId') ){
		printf("%s", json_encode( $this->callBackMsg ) );
		return false;
	}	 
	
	// call my model on this my class 
	$this->callStd = Singgleton( $this );
	if( $this->callStd->_set_row_admin_followup( $out ) ){
		$this->callBackMsg = array( 'success' => 1 );
	}
	
	// return to client process .
	printf("%s", json_encode( $this->callBackMsg ) );
	return false;
		
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
 
function EventSelectDataBarcode(  ){
	
}

 
// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function EventBarcode() 
{
   $vars = array('success' => 0 , 'CustomerId' => 0 );
   $out = _find_all_object_request();
	if( $out->find_value('Barcode') )
	{
		$CustomerId =& get_class_instance(base_class_model($this))->_select_row_barcode_data( $out );
		
		if( $CustomerId  ){	
			$vars = array(
				'success' => 1 , 
				'CustomerId' => $CustomerId 
			);
		}
	}

	echo json_encode( $vars );	
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
		$arr_pods =  $bes->_select_row_data_pod_detail( $var->get_value('CustomerId'));
		
		
		if( $arr_ouput ) 
		{	
			$arr_attr  = $bes->_select_attr_confirm_detail( $var->get_value('CustomerId') );
			$arr_style = $bes->_select_attr_quality_status($arr_ouput);
			$roleobj   = $this->M_UserRole->_select_role_form_action(get_class($this));
			
			$this->load->view('mod_admin_detail/view_contact_main_detail', array(
				'Button' 	=> new EUI_Object( $roleobj ),
				'Detail' 	=> new EUI_Object( $arr_ouput ),
				'Attrs' 	=> new EUI_Object( $arr_attr ),
				'Class' 	=> new EUI_Object( $arr_style ),
				'POD'		=> new EUI_Object( $arr_pods )
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