<?php 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_SrcApplication extends EUI_Model 
{
	
private static $arr_usr_level = null;

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var $sender_keeper = null;
var $arr_limit_page  = 20;

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private static $Instance = null;
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public static function &Instance() 
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
  
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function __construct()  {
	$this->load->model(array ( 
		'M_SetCallResult', 
		'M_SrcCustomerList', 
		'M_SetProduct',
		'M_UserRole',
		'M_ApplicationSender'
	));
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public static function &UserLevelId() 
 {
   if(is_null(self::$arr_usr_level)) {	
		self::$arr_usr_level =& AllUserIdByLevel(array(USER_ROOT,USER_ADMIN));
   }
   return self::$arr_usr_level;
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 protected function _select_row_static_call() 
{
	$arr_call_status =& Spliter(CALL_STS_SEND_APPLIKASI)->get_array();
	if( count( $arr_call_status) != 0 ){
		return $arr_call_status;
	}
	return null;
  } 
  
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 public function _select_default_page()
{
	
// default nilai object URI && Cookies && Config 
 $out  = UR(); $cok = CK(); $cof = CF();
 
 // set default of pager 
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  
  // biar enteng aja di keep di counting data .
  $this->EUI_Page->_setCount(TRUE);
  $this->EUI_Page->_setSelect("count(a.Assign_Sell_Id) as tot", FALSE);
  $this->EUI_Page->_setFrom("t_gn_selling_assignment a" );
  $this->EUI_Page->_setJoin("t_gn_customer_master b", "a.Assign_Sell_CustId = b.DM_Id", "LEFT" );
  $this->EUI_Page->_setJoin("t_gn_campaign c", "b.DM_CampaignId = c.CampaignId", "LEFT" );
  $this->EUI_Page->_setJoin("tms_agent e ","a.Assign_Sell_AdminId=e.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment d", "a.Assign_Sell_CustId=d.AssignCustId", "LEFT", true);
   
  // default where on 
  $this->EUI_Page->_setAnd("a.Assign_Sell_AdminId<>0", FALSE );
  $this->EUI_Page->_setWhereIn("b.DM_AdmCategoryId", array(APRV,YCOM));
  
  // filter data dari sisi user client browser 
  $this->EUI_Page->_setAndCache("b.DM_SellerId", 'FA_User_SellerId', TRUE);
  $this->EUI_Page->_setAndCache("b.DM_QualityUserId", 'FA_User_Quality', TRUE);
  $this->EUI_Page->_setAndCache("b.DM_AdmId", 'FA_User_AdminId', TRUE);
  $this->EUI_Page->_setBeginCache("b.DM_UpdatedTs", 'FA_UpdateTs_start_date', TRUE);
  $this->EUI_Page->_setStopCache("b.DM_UpdatedTs", 'FA_UpdateTs_end_date', 	TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'FA1_filter_field', "FA1_filter_value", TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'FA2_filter_field', "FA2_filter_value", TRUE);
  
 	
// USER_ROOT | USER_ADMIN 
  if( $cok->cookie(array(USER_ROOT, USER_ADMIN) ) ){
	 $this->EUI_Page->_setWhereIn('d.AssignAdmin', $cof->field('default_admin') );
	// all data on process 
  }
  // USER_ACCOUNT_MANAGER
  if( $cok->cookie(array(USER_ACCOUNT_MANAGER) ) ){
	$this->EUI_Page->_setAnd("d.AssignAmgr", $cok->field('UserId'));
  }
  
// USER_MANAGER
  if( $cok->cookie(array(USER_MANAGER) ) ){
	$this->EUI_Page->_setAnd("d.AssignMgr", $cok->field('UserId'));
	
  }	
  
// USER_SUPERVISOR
  if( $cok->cookie(array(USER_SUPERVISOR) ) ){
	$this->EUI_Page->_setAnd("e.spv_id", $cok->field('UserId')); 
  }
	
// USER_LEADER
  if( $cok->cookie(array(USER_LEADER) ) ){
	$this->EUI_Page->_setAnd("d.AssignLeader", $cok->field('UserId'));   
  }
	
	
// USER_AGENT_OUTBOUND 
  if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) ) ){
	$this->EUI_Page->_setAnd("d.AssignSelerId", $cok->field('UserId'));   
  }
  
 // USER_ADMIN_FOLLOWUP 
  if( $cok->cookie(array(USER_ADMIN_FOLLOWUP) ) ){
	$this->EUI_Page->_setAnd("a.Assign_Sell_AdminId", $cok->field('UserId'));   
  }
   
  
  //debug($this->EUI_Page->_getCompiler());
 return $this->EUI_Page;	
 
} 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _select_page_content()
{
 // get all parameter data on client 
	$out = UR();  $cok = CK(); $cof  = CF();
	
  // get data variable process =
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage( DEFAULT_COUNT_PAGE );
	$this->EUI_Page->_setArraySelect( array(
		'a.Assign_Sell_CustId as DM_Id' 					 => array('DM_Id', 				'DM_Id','Primary'),
		'b.DM_CampaignId as DM_CampaignId' 					 => array('DM_CampaignId', 		'DM_CampaignId' ),
		'b.DM_Custno as DM_Custno' 							 => array('DM_Custno', 			'DM_Custno' ),
		'b.DM_FirstName as DM_FirstName' 					 => array('DM_FirstName', 		'DM_FirstName' ),
		'b.DM_AddressLine1 as DM_AddressLine1' 				 => array('DM_AddressLine1', 	'DM_AddressLine1' ),
		'b.DM_AddressLine2 as DM_AddressLine2' 				 => array('DM_AddressLine2', 	'DM_AddressLine2' ),
		'b.DM_AddressLine3 as DM_AddressLine3' 				 => array('DM_AddressLine3', 	'DM_AddressLine3' ), 
		'b.DM_DataType as DM_DataType' 				 		 => array('DM_DataType', 		'DM_DataType' ), 
		'b.DM_SellerId as DM_SellerId' 						 => array('DM_SellerId', 			'DM_SellerId' ),
		'b.DM_CallCategoryKode as DM_CallCategoryKode' 		 => array('DM_CallCategoryKode', 	'DM_CallCategoryKode' ),
		'b.DM_QualityUserId as DM_QualityUserId' 			 => array('DM_QualityUserId', 		'DM_QualityUserId' ),
		'b.DM_QualityCategoryKode as DM_QualityCategoryKode' => array('DM_QualityCategoryKode', 'DM_QualityCategoryKode' ),
		'b.DM_AdmId as DM_AdmId' 							 => array('DM_AdmId', 				'DM_AdmId' ),
		'b.DM_AdmCategoryKode as DM_AdmCategoryKode' 		 => array('DM_AdmCategoryKode', 	'DM_AdmCategoryKode' ),
		'b.DM_LastCategoryKode as DM_LastCategoryKode' 		 => array('DM_LastCategoryKode', 	'DM_LastCategoryKode' ),
		'b.DM_UpdatedTs as DM_UpdatedTs' 					 => array('DM_UpdatedTs', 			'DM_UpdatedTs' )
	));
	
 // then will get data process from table && Join 
	
	$this->EUI_Page->_setFrom("t_gn_selling_assignment a" );
	$this->EUI_Page->_setJoin("t_gn_customer_master b", "a.Assign_Sell_CustId = b.DM_Id", "LEFT" );
    $this->EUI_Page->_setJoin("t_gn_campaign c", "b.DM_CampaignId = c.CampaignId", "LEFT" );
	$this->EUI_Page->_setJoin("tms_agent e ","a.Assign_Sell_AdminId=e.UserId", "LEFT");
    $this->EUI_Page->_setJoin("t_gn_assignment d", "a.Assign_Sell_CustId=d.AssignCustId", "LEFT", true);
   
	
 // default where on 
	$this->EUI_Page->_setAnd("a.Assign_Sell_AdminId<>0",  false );
	$this->EUI_Page->_setWhereIn("b.DM_AdmCategoryId", array( APRV,YCOM,NCOM ));
	
 // filter data by client process 	
	$this->EUI_Page->_setAndCache("b.DM_SellerId", 'FA_User_SellerId', TRUE);
	$this->EUI_Page->_setAndCache("b.DM_QualityUserId", 'FA_User_Quality', TRUE);
	$this->EUI_Page->_setAndCache("b.DM_AdmId", 'FA_User_AdminId', TRUE);
	$this->EUI_Page->_setBeginCache("b.DM_UpdatedTs", 'FA_UpdateTs_start_date', TRUE);
	$this->EUI_Page->_setStopCache("b.DM_UpdatedTs", 'FA_UpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'FA1_filter_field', "FA1_filter_value", TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'FA2_filter_field', "FA2_filter_value", TRUE);
  
  	
// USER_ROOT | USER_ADMIN 
   if( $cok->cookie(array(USER_ROOT, USER_ADMIN) ) ){
	 $this->EUI_Page->_setWhereIn('d.AssignAdmin', $cof->field('default_admin') );
	// all data on process 
   }
  
  // USER_ACCOUNT_MANAGER
  if( $cok->cookie(array(USER_ACCOUNT_MANAGER) ) ){
	$this->EUI_Page->_setAnd("d.AssignAmgr", $cok->field('UserId'));
  }
  
// USER_MANAGER
  if( $cok->cookie(array(USER_MANAGER) ) ){
	$this->EUI_Page->_setAnd("d.AssignMgr", $cok->field('UserId'));
  }	
  
// USER_SUPERVISOR
  if( $cok->cookie(array(USER_SUPERVISOR) ) ){
	$this->EUI_Page->_setAnd("e.spv_id", $cok->field('UserId')); 
  }
	
// USER_LEADER
  if( $cok->cookie(array(USER_LEADER) ) ){
	$this->EUI_Page->_setAnd("d.AssignLeader", $cok->field('UserId'));   
  }
  
// USER_AGENT_OUTBOUND 
  if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) ) ){
	$this->EUI_Page->_setAnd("d.AssignSelerId", $cok->field('UserId'));   
  }
  
 // USER_ADMIN_FOLLOWUP 
  if( $cok->cookie(array(USER_ADMIN_FOLLOWUP) ) ){
	$this->EUI_Page->_setAnd("a.Assign_Sell_AdminId", $cok->field('UserId'));   
  }
  
//  set order ---------------------------
 if( $out->find_value('order_by') ){
	$this->EUI_Page->_setOrderBy($out->field('order_by'), $out->field('type') ); 
 } else {
	$this->EUI_Page->_setOrderBy("a.Assign_Sell_Id","DESC");
 }

 //  debug data all ---------------------------------
 $this->EUI_Page->_setLimit();
 //debug( $this->EUI_Page->_getCompiler() );

 
	
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function _select_page_source()
{
  $this->_select_page_content();
   if( $this->EUI_Page->_get_query()!='') 
  {
	return $this->EUI_Page->_result();
  }
  
}
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_page_number() 
{
	if( $this->EUI_Page->_get_query()!='' ) {
		return $this->EUI_Page->_getNo();
	}	
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_event_insec_data( $CustomerId = 0 ) 
{
  $row_arr_value=& get_class_instance('M_SrcCustomerList')->_getDetailCustomer( $CustomerId );
  return Objective( $row_arr_value );
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function _set_event_row_retry( $out = null )  
{
  
  $this->sender_keeper  = FALSE;
  
 // -- get all attribute data  --- 
  
  $obj = $this->_select_event_insec_data( $out->get_value('CustomerId') ); 
  if( !$obj->find_value('ProductId') ) {
	return FALSE;
  }
  
 // -- cek product type --- 
 
  $ProductType = & get_class_instance('M_SetProduct')->_select_product_type($obj->get_value('ProductId')); 
  
  if( $ProductType == PRODUCT_LONG_FORM )
 {
    $Sender =& get_class_instance('M_ApplicationSender')->_set_inialize_row_application(array(
		'CustomerId' => $obj->get_value('CustomerId'),
		'ProductId' => $obj->get_value('ProductId') 
	));
	
	$this->sender_keeper = $Sender->_set_row_keep_transport_tmp(); // transport ffile to tmp then cronjob will process  
	if( $this->sender_keeper == FALSE ) {
		return FALSE;
	}
 }
 
//---------------- short form regenerate -------------------------
 
  if( $ProductType == PRODUCT_SHORT_FORM )
 {
    $Sender =& get_class_instance('M_ApplicationSender')->_set_inialize_row_application(array(
		'CustomerId' => $obj->get_value('CustomerId'),
		'ProductId' => $obj->get_value('ProductId') 
	));
	
	$this->sender_keeper = $Sender->_set_row_keep_transport_tmp(); // transport ffile to tmp then cronjob will process  
	if( $this->sender_keeper == FALSE ) {
		return FALSE;
	}
 }
 
  return (bool)$this->sender_keeper;
  
  
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
// ===================================== END CLASS ================================================================

}

?>