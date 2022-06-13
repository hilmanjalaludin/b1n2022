<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
class SrcCustomerList extends EUI_Controller {
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function __construct()  {
	parent::__construct();
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function CekPolicyForm() {
	$_conds = array('success' => 0 );
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		if( $rows = $this -> {base_class_model($this)} ->_getCekPolicyForm( $this -> URI->_get_post('CustomerId')) )
		{
			$_conds = array('success' => 1 );	
		}
	}
	
	__(json_encode($_conds));
} 
 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_row_call_result( $CategoryId = null )
{
	$arr_call_activity  = array();
	$arr_call_result    = get_class_instance('M_SetCallResult')->_getCallReasonId($CategoryId);
	$arr_call_status 	= PrivilegeStatusCall(_get_session('HandlingType'));
	
	if( is_array($arr_call_result) 
		AND count($arr_call_result) <> 0 )
		foreach( $arr_call_result as $key => $row )
	{
		if( in_array($key, $arr_call_status) ){	
			$arr_call_activity[$key] = $row['name'];
		}		
	}
	
	return $arr_call_activity;
 }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function SelectCallResultId()  {
	
 $result_array = array();
 if( UR()->field( 'CallStatusId' ) ){	 
	$result_array = Singgleton('M_SetCallResult')->_select_call_result_perkategory( UR()->field('CallStatusId') );
  }
  
 printf("%s", form()->combo('CallResultId','select tolong select-chosen', $result_array, null ,array('change'=>'EventSaleHandler(this);') ));
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getProductId()
 {
	$_conds = array();
	foreach( $this ->M_SetProduct ->_getProductId()  as $k  => $call ) {
		$_conds[$k] = $call['name'];
	}
	
	return $_conds;
 }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function index()
 {
	 // eg : model data on this 
 $this->callBackConn = Singgleton($this);
 if( !is_object( $this->callBackConn ) ){
	exit(0);
 }
 
 // sent view data process on this OK 
 $this->load ->view('src_customer_list/view_customer_nav',array(
	'page' => $this->callBackConn->_get_default()
 ));
 
 }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getCombo() {
	return array();
 } 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getAgentAssign()
{
	$_conds = array();
	$Agent = $this -> M_SysUser->_get_user_by_login();
	
	$no=0;
	foreach( $Agent as $k => $rows ) 
	{
		$_conds[$k] = (++$no).' -'. $rows['full_name'];
	}
	
	return $_conds;
} 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function Content()
{
	if(!_have_get_session('UserId') )
  {
	  return false;
  }
		
	$object =& get_class_instance(base_class_model($this));
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load->view('src_customer_list/view_customer_list',array(
		'button' => new EUI_Object( $roleobj ),
		'page' => $object->_get_resource(),
		'num'  => $object->_get_page_number()
	));
	
 }
 
 /*
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
 $std =& Singgleton($this);
 $rol =& Singgleton('M_UserRole');
 
 // then call my object 
 
 $result_button = $rol->_select_role_form_action( get_class($this));
 $result_detail = $std->_select_row_master_detail( $out->field('MasterDataId') );
 // echo "<pre>";
 // print_r($result_detail);
 // echo "</pre>";
 
// load my view detail .
 
 $this->load->view('mod_contact_detail/view_contact_main_detail', array(
	'Detail' => Objective( $result_detail ),
	'Button' => Objective( $result_button ) ));
}	
  
  
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 public function PolicyStatus()
{
	$_conds = array('PolicyReady' => 0 );
	$total = 0;
	$out = _find_all_object_request();
	$sql = sprintf("select SUM(a.ProductId) as Jumlah from t_gn_customer a where a.CustomerId='%s'", $out->get_value('CustomerId') );
	$rs  = $this->db->query($sql);
	if( $rs->num_rows() > 0 
		&& $row = $rs->result_first_assoc() )
	{
		$total = $row['Jumlah'];
	}
	
	if( $total > 0 ){
		$_conds = array('PolicyReady' => 1 );
	}
	echo json_encode($_conds);	
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 function SetFollowup()
{
 
 $arr_response = array('success' => 0 );
 if( !UR()->field('MasterDataId') 
	 OR !CK()->field('UserId') ) 
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 //  set follow up ---------------------------------
 $dataBucket = Singgleton($this);
 $cond = $dataBucket->_set_row_update_followup( UR() );
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  echo json_encode( $arr_response );
	
} 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

public function UnsetFollowup()
{
 $arr_response = array('success' => 0 );
 if( !_get_have_post('MasterDataId') OR !_have_get_session('UserId') )
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 // -------- set follow up ---------------------------------
 $cond = $this->{base_class_model($this)}->_unset_row_update_followup(new EUI_Object( _get_all_request() ));
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  
  echo json_encode( $arr_response );
	
} 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

function CheckLastCall()
{
	$_conds = array('result'=>0);
	
	$time 	= strtotime(date('H:i:s'));
	$start 	= strtotime(_get_session('StartTime'));
	$end 	= strtotime(_get_session('EndTime'));
	
	if( ($time>$start) && ($time<$end) )
	{
		$_conds = array('result'=>1);
	}
	
	echo json_encode($_conds);
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 public function Role()
{
	$out= UR();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    printf('%s', json_encode( $arr_role_toolbars ));
	return false;
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function NextData(){
	
// untuk Process NextData Di Tombol Next 
// get object on DD_Id  

	$this->dataURI = UR();
	$this->dataSTD = Singgleton($this);
	
// select order pager  
	printf("%s", json_encode(array(
		'data'=>  $this->dataSTD->_select_row_master_next( $this->dataURI )
	)));
 }
 
 function getAutoCustomer()
{
	//$this->callBackMsg = array( 'success' => 0);
	$Data = $this -> M_SrcCustomerList -> _select_row_limit_data();
	// print_r($Data);
	$this->callBackMsg = array( 'success' => 1,'result'=>$Data['MasterDataId']);
	
	printf('%s', json_encode($this->callBackMsg) );
	return false;
}
  
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 // ============================= END CLASS ===================================
 
}
?>