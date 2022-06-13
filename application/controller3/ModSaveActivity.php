<?php

 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class ModSaveActivity extends EUI_Controller
{

 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  function __construct() 
 {
	parent::__construct();
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper('EUI_Object');
 }
 
 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function SaveAgentActivity()
{
	
 $this->callBackMsg = array('success' => 0 );
 
 // DEFINE dataall process on client 
 
 $out = UR();
 $cok = CK();
 
 //then get all process 
 if( !$cok->find_value('UserId') ){
	 echo json_encode( $cond );
	 return false;
 }
 
 
// Singgleton 
 $row = Singgleton($this);
 if( $row->_set_row_save_agent_activity_call( $out ) ){
	$this->callBackMsg = array('success' => 1 );
 }
 
 
 // return process client 
 printf("%s", json_encode( $this->callBackMsg));
 return false;
 
}
 

 /*
  * [SaveAdminActivity @]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function SaveAdminActivity() 
 {
	$this->callBackMsg = array('success' => 0 );
 
 // DEFINE dataall process on client 
 
 $out = UR();
 $cok = CK();
 
 //then get all process 
 if( !$cok->find_value('UserId') ){
	 echo json_encode( $cond );
	 return false;
 }
 
 
// Singgleton 
 $row = Singgleton($this);
 if( $row->_set_row_save_admin_activity_call( $out ) ){
	$this->callBackMsg = array('success' => 1 );
 }
 
 
 // return process client 
 printf("%s", json_encode( $this->callBackMsg));
 return false;

}
 



 /*
  * [SaveQualityActivity @]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function SaveQualityActivity() 
 {
	$this->callBackMsg = array('success' => 0 );
 
 // DEFINE dataall process on client 
 
 $out = UR();
 $cok = CK();
 
 //then get all process 
 if( !$cok->find_value('UserId') ){
	 echo json_encode( $cond );
	 return false;
 }
 
 
// Singgleton 
 $row = Singgleton($this);
 if( $row->_set_row_save_quality_activity_call( $out ) ){
	$this->callBackMsg = array('success' => 1 );
 }
 
 
 // return process client 
 printf("%s", json_encode( $this->callBackMsg));
 return false;

}
 
 
 

 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function SaveApprovalActivity()
{
	
 $this->cond  = array('success' => 0);
  if( !_get_is_login() ) {
	echo json_encode( $this->cond );
	return false;
 }
 
 
 // -- all object  -- 
   $this->out = UR();
   if( $this->out->find_value('CustomerId') ) 
  {
	$this->stdClas = Singgleton($this);
	if( $this->stdClas->_set_row_update_admin_approval( $this->out ) ) {
		$this->cond  = array( 'success' => 1);
	}
  }
  
  // return callback to Client 
  printf("%s", json_encode( $this->cond ));
  return false;
  
}
 

 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function SaveSpvActivity()
{
  
 $cond  = array('success' => 0);
 
  if( !_get_is_login() )
 {
	echo json_encode($cond);
	return false;
 }
 
 
 // -- all object  -- 
   $out = _find_all_object_request();
   if( $out->find_value('CustomerId') ) 
  {
	$obClass =& get_class_instance(base_class_model($this));
	if( $obClass->_set_row_save_spv_activity_call( $out ) ) {
		$cond  = array('success' => 1);
	}
  }
  
  echo json_encode( $cond );
  
}
    
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function FollowUpSaveActivity()
{
  $cond = array('success' => 0);
  $out =new EUI_Object(_get_all_request() );
  if( !$out->fetch_ready() OR !_get_is_login() ) 
 {
	echo json_encode( $cond );
	return false;
 }
	
 $obClass =& get_class_instance(base_class_model($this));
 if( $obClass-> _set_row_save_followup_activity( $out ) ) {
	$cond = array('success' => 1);
 }
 
 echo json_encode( $cond );
 
 } 
 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function SaveInfoCustomer()
{
 
 $cond = array('success' => 0);	
 $out =new EUI_Object(_get_all_request() );
 
// --------- check validate data post ----------------------------
 
 if( !$out->fetch_ready() OR !_get_is_login() ) {
	echo json_encode( $cond );
	return false;
 }
 
  $obClass =& get_class_instance(base_class_model($this));
   if( $obClass->_set_row_save_customer( $out ) )
   {
	 $cond = array('success'=>1);
 }
	
	echo json_encode($_cond);
	
 }
 
 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 public function CallHistory() {
	echo "Sorry, CallHistory was move to {ModCallHistory} ";
 }
 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function PreviewProduct()
 {
	$CallHistory = null;
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		$CustomerId = $this -> URI->_get_post('CustomerId');
		if( $CustomerId )
		{
			$CallHistory= array('data' => $this->{base_class_model($this)}->_getPreviewData($CustomerId) );
		}
		
		// $this -> load -> view("mod_contact_detail/view_preview_product_content",$CallHistory);
	}
 }

 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  function ProdSum()
 {
	$ProdSum = null;
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		$CustomerId = $this -> URI->_get_post('CustomerId');
		if( $CustomerId )
		{
			$ProdSum= array('ProdSummary' => $this->{base_class_model($this)}->getProductSummary($CustomerId) );
		}
		
		$this -> load -> view("mod_contact_detail/view_prodsum_content",$ProdSum);
	}
 }
 
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
	 
public function ProdPreview() 
{
	if(  $datas = array( "ProductSimulate" => $this ->{base_class_model($this)}->_getProductPreview()) )
	{
		$this ->load->view("mod_contact_detail/view_simulate_list",$datas);
	} 
	
 }
 

 }



?>
