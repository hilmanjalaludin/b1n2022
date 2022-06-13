<?php 
class UserTransfer extends EUI_Controller
{
	
 var $gDistributeRata = 1;
 var $gDistributeAgent = 2;
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct()
{
	parent::__construct();
	display(1);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
}
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function index()
{ 

	$out = UR();
  // call create callback 
  $this->callBackMsg = array('success' => 0)	;
  
  // cek session data login 
  if(!CK()->field('UserId') ) {
	echo json_encode( $this->callBackMsg );
	return false;
  }
 
// cek by check on here  
 if( !$out->fetch_ready())  {
	echo json_encode( $this->callBackMsg );
	return false;	
 }	

// Singgleton
  $callDataID =& Singgleton($this); 
  
 // on other type data OK 
  if( $out->field('trans_user_type') == 1 ) {
	$this->callBackMsg = array( 'success' => $callDataID->_set_row_transfer_rata( $out ) );
  }
  
 // type here like this 
 if( $out->field('trans_user_type') == 2 ) {
	$this->callBackMsg= array( 'success' => $callDataID->_set_row_transfer_agent( $out ) );
	//var_dump($this->callBackMsg);
 }
 
  printf("%s", json_encode( $this->callBackMsg));
  
/*
  $out =new EUI_Object( _get_all_request() );
  // [trans_call_start_date] => 
  // [trans_end_start_date] => 
  // [trans_from_campaign_id] => 1
  // [trans_call_result_id] => 
  // [trans_from_user_group] => 
  // [trans_form_user_list] => 
  // [trans_user_total] => 29
  // [trans_user_quantity] => 20
  // [trans_user_type] => 1
  // [trans_to_user_group] => 2
  // [trans_user_mode] => 1
  // [trans_user_action] => 1
  // [trans_to_user_list] => 292,293
  // [AssignId] => 
  // exit;
  
  $cond = array('success' => 0)	;
  
  if( !_have_get_session('UserId') ) 
  {
	echo json_encode( $cond );
	return false;
  }
  
 //--------------- checj parameter ------------------------ 
 
 if( !$out->fetch_ready()) 
 {
	echo json_encode( $cond );
	return false;	
  }	

// --------- tes -----------
// $out->debug_label();
  $output =& get_class_instance(base_class_model($this)); 
  if( $out->get_value('trans_user_type') == 1 )
 {
	$cond = array(
		'success' => $output->_set_row_transfer_rata( $out )
	);
  }
 
   if( $out->get_value('trans_user_type') == 2 )
  {
	$cond = array(
		'success' => $output->_set_row_transfer_agent( $out )
	);
	
  }  
   echo json_encode( $cond );
   */
}


// =========== END CLASS ===============================================================

}
?>