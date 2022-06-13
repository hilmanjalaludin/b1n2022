<?php 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class AdminDetail extends EUI_Controller  {
 
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function __construct(){
	parent::__construct();
	display(0);// show notice $var
	$this->load->model(array(base_class_model($this)));
	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function index() {
	 
 // get call session dan request data 
 $cok  = CK(); $out = UR();
	
 // cek by cek 	
 if( !$cok->find_value('UserId') ){
	return false;	
 }
 
 // cek post data from client.
 if( !$out->find_value('CustomerId') ){
	return false;	
 }
 
 // call my standars class 
 $std =& Singgleton($this);
 $rol =& Singgleton('M_UserRole');
 
 // then call my object 
 
 $result_button = $rol->_select_role_form_action( $out->field('ControllerId') );
 $result_detail = $std->_select_row_master_detail( $out->field('CustomerId') );
 
// load my view detail .
 $this->load->view('mod_admin_detail/view_contact_main_detail', array(
	'Request' => UR(),  
	'Detail'  => Objective( $result_detail ),
	'Button'  => Objective( $result_button )
  ));

  
} 
 
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function Save(){
	
 }  

// ==== END CLASS ====
}

?>