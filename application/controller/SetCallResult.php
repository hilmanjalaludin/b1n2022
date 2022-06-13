<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetCallResult extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function SetCallResult()
 {
	parent::__construct();
	$this -> load -> model( array(base_class_model($this),'M_SetResultCategory'));
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
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_result_call/view_result_call_nav',$_EUI);
		}	
	}	
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
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_result_call/view_result_call_list',$_EUI);
		}	
	}	
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function SetActive()
 {
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setActive(
			array( 
				'CallReasonId' => $this -> URI -> _get_array_post('CallResultId'),
				'Active' => $this -> URI -> _get_post('Active') 
			)
		)) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function getReasonCategoryId()
{
	$Inbound  = $this ->M_SetResultCategory ->_getInboundCategory(); 
	$Outbound = $this ->M_SetResultCategory ->_getOutboundCategory();
	
	$CallCategory = array();
	
	foreach( array( $Inbound,$Outbound ) as $keys => $values )
	{
		if(is_array($values))
		{
			foreach($values as $CallCategoryId => $CallCategoryName ){
				$CallCategory[$CallCategoryId] = $CallCategoryName; 
			}
		}
	}
	
	return $CallCategory;
}  

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _getOrders()
{
	$_conds = array();
	
	if(class_exists('M_SetResultCategory'))
	{
		$_conds = $this ->M_SetResultCategory ->_getOrder(200);
	}	
	
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SaveCallResult()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveCallResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / Delete
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function UpdateCallResult()
{
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateCallResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / Delete
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Delete()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setDeleteCallResult( $this->URI->_get_array_post('CallResultId'))) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function AddView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array(
			'Event' => $this->{base_class_model($this)}->_getBoolean(),
			'CallCategoryId' => $this -> getReasonCategoryId(),
			'Orders' => $this -> _getOrders()
			);
		$this -> load -> view('set_result_call/view_result_call_add',$UI);
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function EditView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$UI = array
		(
			'Event' => $this->{base_class_model($this)}->_getBoolean(),
			'Data' => $this->{base_class_model($this)}->_getDataResult( $this->URI->_get_post('CallReasonId') ),
			'CallCategoryId' => $this -> getReasonCategoryId(),
			'Orders' => $this -> _getOrders()
		);
		
		$this -> load -> view('set_result_call/view_result_call_edit',$UI);
	}	
 } 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
  function getEventType()
  {
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$CallResultId = $this -> URI->_get_post('CallResultId');
		if(isset($CallResultId))
		{
			$EventReason = $this -> {base_class_model($this)}->_getEventType($CallResultId); 
			if(!is_null($EventReason) )
			{
				$_conds = array('success' => 1, 'event' => $EventReason);
			}
		}	
	}
	
	echo json_encode($_conds); 
	//= array('success' => 0, 'event' => null);
	
  }
  
}
?>