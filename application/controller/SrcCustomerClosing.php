<?php
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class SrcCustomerClosing extends EUI_Controller
{
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct() {
	parent::__construct();
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
	//display();
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function index() {
	if( !_get_is_login() ){  
		return FALSE; 
	}

	
	
 // look view data on view .
	
	$this->load ->view('src_closing_list/view_closing_nav',array ( 
	'page'=> Singgleton('M_SrcCustomerClosing')->_get_default() ));
	
 }
  /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function Content()
 {
	if( !_get_is_login() ) {  
		return FALSE; 
	}
	
	$std =& Singgleton($this);
	$rol =& Singgleton('M_UserRole');
	
// show data role process OK 
	$Button = $rol->_select_role_form_action( $this );
	
// show data on process like this ;	
	$this->load->view('src_closing_list/view_closing_list',array(
		'page' 	 => $std->_get_resource(),
		'num'  	 => $std->_get_page_number(), 
		'button' => Objective( $Button ) ));
	
 }
  /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 public function SuspendType()
{
  $var =new EUI_Object( _get_all_request() );	
  $out =& get_class_instance('M_SrcCustomerList');
  $output = $out->_getDetailCustomer( $var->get_value('CustomerId'));
  
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 function SetFollowup()
{
	$this->cok = CK();
	
		$arr_response = array('success' => 0 );
		if( !UR()->field('MasterDataId') OR !CK()->field('UserId') ){
			echo json_encode( $arr_response );
			return false;
		}

		//  set follow up "M_SrcCustomerList" trailer on this gatway 
		$dataBucket = Singgleton('M_SrcCustomerList');
		if($this->cok->field('Username')!='ROOT'){
			$cond = $dataBucket->_set_row_update_followup( UR() );
			if( $cond ){
				$arr_response = array('success' => 1 );	
			}
		}else if($this->cok->field('Username')=='ROOT'){
			$arr_response = array('success' => 1 );	
		}
		echo json_encode( $arr_response );
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function ContactDetail()
 {
	// get call session dan request data 
	 $cok  = CK(); $out = UR();
		
	 // cek by cek 	
	 if( !$cok->find_value('UserId') ){
		return false;	
	 }
	 
	 // cek post data from client.
	 if( !$out->find_value('MasterDataId') ){
		return false;	
	 }
	 
	 // call my standars class 
	 $std =& Singgleton('M_SrcCustomerList');
	 $rol =& Singgleton('M_UserRole');
	 
	 // then call my object 
	 
	 $result_button = $rol->_select_role_form_action( get_class($this));
	 $result_detail = $std->_select_row_master_detail( $out->field('MasterDataId') );
	 
	// load my view detail .
	 
	 $this->load->view('mod_contact_detail/view_contact_main_detail', array(
		'Detail' => Objective( $result_detail ),
		'Button' => Objective( $result_button ) ));
	
	
  }
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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