<?php
/*
 * E.U.I 
 *
 * ---------------------------------------------------------------------------- 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 * 
 */
 
class M_SrcFollowupPod extends EUI_Model
{
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

var $arr_limit_page  = 20;
var $arr_call_status = array();
var $arr_user_privilege = array();

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
private static $Instance = null;


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public static function &Instance() 
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
  
  
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function __construct() 
{
	$this->load->model(array ( 
		'M_SetCallResult', 
		'M_SetProduct',
		'M_SetCampaign',
		'M_SrcCustomerList', 
		'M_SetResultQuality',
		'M_SetResultCategory', 
		'M_MaskingNumber',
		'M_UserRole',
		'M_SysUser',
		'M_Combo'
	));
	
}



/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 
 protected function _select_row_static_call() 
 {
	$arr_call_status = PrivilegeStatusCall(_get_session('HandlingType'));
	if( count( $arr_call_status ) != 0 ){
		return $arr_call_status;
	}
  } 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 public function _get_default()
{
 
 // get all parameter data on client 
	$out = UR();  $cok = CK(); $cof  = CF();
  
  // set default of pager 
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  
  // biar enteng aja di keep di counting data .
  $this->EUI_Page->_setCount(TRUE);
  $this->EUI_Page->_setSelect("count(a.Assign_Sell_Id) as tot", FALSE);
  $this->EUI_Page->_setFrom("t_gn_selling_assignment a" );
  $this->EUI_Page->_setJoin("t_gn_customer_master b", "a.Assign_Sell_CustId = b.DM_Id", "INNER" );
  //$this->EUI_Page->_setJoin("t_gn_campaign c", "b.DM_CampaignId = c.CampaignId", "LEFT" );
  //$this->EUI_Page->_setJoin("tms_agent e ","a.Assign_Sell_AdminId=e.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment d", "a.Assign_Sell_CustId=d.AssignCustId", "INNER", true);
   
  // default where on 
  $this->EUI_Page->_setAnd("a.Assign_Sell_AdminId<>0", false );
  $this->EUI_Page->_setWhereNotIn("b.DM_AdmCategoryId", array(YCOM));
  
  // filter data by client process 	
	
	$this->EUI_Page->_setAndCache("b.DM_SellerId", 			'FO_User_SellerId', 		TRUE);
	$this->EUI_Page->_setAndCache("b.DM_QualityUserId", 	'FO_User_Quality', 			TRUE);
	$this->EUI_Page->_setAndCache("b.DM_AdmId", 			'FO_User_AdminId', 			TRUE);
	$this->EUI_Page->_setBeginCache("b.DM_UpdatedTs", 		'FO_UpdateTs_start_date', 	TRUE);
	$this->EUI_Page->_setStopCache("b.DM_UpdatedTs", 		'FO_UpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 				'FO1_filter_field', 		"FO1_filter_value", TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 				'FO2_filter_field', 		"FO2_filter_value", TRUE);
   	
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
 //  if( $cok->cookie(array(USER_SUPERVISOR) ) ){
	// $this->EUI_Page->_setAnd("e.spv_id", $cok->field('UserId')); 
 //  }
	
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
 
  
 // debug( $this->EUI_Page->_getCompiler());
  return $this->EUI_Page;	
 
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  
 public function _get_content()
{
    // get all parameter data on client 
	$out = UR();  $cok = CK(); $cof  = CF();
	
  // get data variable process =
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage( DEFAULT_COUNT_PAGE );
	
	$this->EUI_Page->_setArraySelect( array(
		'a.Assign_Sell_CustId as DM_Id' 					 => array('DM_Id', 			 		'DM_Id','Primary'),
		'b.DM_CampaignId as DM_CampaignId' 					 => array('DM_CampaignId', 			'DM_CampaignId' ),
		'b.DM_Custno as DM_Custno' 							 => array('DM_Custno', 				'DM_Custno' ),
		'b.DM_FirstName as DM_FirstName' 					 => array('DM_FirstName', 			'DM_FirstName' ),
		'b.DM_AddressLine1 as DM_AddressLine1' 				 => array('DM_AddressLine1', 		'DM_AddressLine1' ),
		'b.DM_AddressLine2 as DM_AddressLine2' 				 => array('DM_AddressLine2', 		'DM_AddressLine2' ),
		'b.DM_AddressLine3 as DM_AddressLine3' 				 => array('DM_AddressLine3', 		'DM_AddressLine3' ), 
		'b.DM_DataType as DM_DataType' 				 		 => array('DM_DataType', 			'DM_DataType' ), 
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
	$this->EUI_Page->_setJoin("t_gn_customer_master b", "a.Assign_Sell_CustId = b.DM_Id", "INNER" );
    //$this->EUI_Page->_setJoin("t_gn_campaign c", "b.DM_CampaignId = c.CampaignId", "LEFT" );
	//$this->EUI_Page->_setJoin("tms_agent e ","a.Assign_Sell_AdminId=e.UserId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_assignment d", "a.Assign_Sell_CustId=d.AssignCustId", "INNER", true);
   
 // default where on 
	$this->EUI_Page->_setAnd("a.Assign_Sell_AdminId<>0",  false );
	$this->EUI_Page->_setAnd("a.Assign_Sell_IsReady=1",  false );
	$this->EUI_Page->_setWhereNotIn("b.DM_AdmCategoryId", array(APRV,YCOM));
	
// filter data by client process 	
	
	$this->EUI_Page->_setAndCache("b.DM_SellerId", 			'FO_User_SellerId', 		TRUE);
	$this->EUI_Page->_setAndCache("b.DM_QualityUserId", 	'FO_User_Quality', 			TRUE);
	$this->EUI_Page->_setAndCache("b.DM_AdmId", 			'FO_User_AdminId', 			TRUE);
	$this->EUI_Page->_setBeginCache("b.DM_UpdatedTs", 		'FO_UpdateTs_start_date', 	TRUE);
	$this->EUI_Page->_setStopCache("b.DM_UpdatedTs", 		'FO_UpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 				'FO1_filter_field', 		"FO1_filter_value", TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 				'FO2_filter_field', 		"FO2_filter_value", TRUE);
   	
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
 //  if( $cok->cookie(array(USER_SUPERVISOR) ) ){
	// $this->EUI_Page->_setAnd("d.AssignSpv", $cok->field('UserId')); 
 //  }
	
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
	// echo $this->EUI_Page->_getCompiler();
	
}


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
 public function _select_attr_quality_status( $arr_out = null ) 
{
	$out= new EUI_Object( $arr_out );
	return (array)$arr_class;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _set_auto_write_pod_code( $RefCode, $AutoIndex = 0 )
{
	$arr_auto_index  = "000000000";
	$arr_auto_number = $AutoIndex;
	$arr_auto_length = 	(strlen( $arr_auto_index ) - strlen($arr_auto_number));
	
	if( strlen($arr_auto_number) > strlen($arr_auto_index) ) {
		return 0;
	}
	
	$arr_pod_num = join("", array( substr($arr_auto_index,0,$arr_auto_length), $AutoIndex));
	$arr_pod_idx = join("-", array($RefCode, $arr_pod_num));
	return (string)$arr_pod_idx;
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 public function _select_row_agen_customer_pod( $CustomerId = 0 )
{
	
 $arr_select_assoc = array();
 
 $this->db->reset_select();
 $this->db->select("a.SellerId as AgentId, b.id as AgentCode ", FALSE);
 $this->db->from("t_gn_customer a ");
 $this->db->join("tms_agent b ","a.SellerId=b.UserId", "LEFT");
 $this->db->where("a.CustomerId", $CustomerId);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 )
 {
	 $arr_select_assoc =(array)$rs->result_first_assoc();
 }
 return array_map('strtoupper', $arr_select_assoc);
 
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 public function _select_attr_confirm_detail( $CustomerId = 0  )
{
  $arr_attr_closing = array();
  
 // ----------- select last phone followup -----------------
  
  $this->db->reset_select();
  $this->db->select("a.CallNumber", FALSE);
  $this->db->from("t_gn_callhistory a ");
  $this->db->where("a.HistoryType", 0);
  $this->db->where("a.CustomerId", $CustomerId);
  $this->db->order_by("a.CallHistoryId", "DESC");
  $this->db->limit(1);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 
	AND $row = $rs->result_first_assoc() )
{
	$arr_attr_closing['CallNumber'] = $row['CallNumber'];
  }	  
  
  return (array)$arr_attr_closing;
 }

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  public function _getPhoneCustomer( $CustomerId=null ) {}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _getApprovalPhoneItems($CustomerId = 0 ) { } 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function _set_row_admin_followup( $out =null  ) {
	
	$this->cond = 0;
	// set default object set overide 
	
	$out->add('DM_AdmId',CK()->field('UserId'));
	$out->add('DM_Id',$out->field('CustomerId'));
	
	
	// set query data process .
	
	$sql = sprintf("UPDATE t_gn_customer_master a  SET 
						a.DM_AdmId = '%s',
						a.DM_AdmUpdateTs = NOW()
					WHERE a.DM_Id='%s'", $out->field('DM_AdmId'),
										 $out->field('DM_Id')  );
										 					 
	if( $this->db->query( $sql ) ){
		$this->cond++;
	}				
	
	// return kondision data on process.	
	return $this->cond;	
 } 
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
public function _getAvailProduct( $CustomerId = 0 ) { }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _select_row_data_pod_detail(  $CustomerId = 0 ) 
{
	
  $sql = sprintf( "select *
				  from t_gn_pod a 
				  where a.customer_id = '%s'", $CustomerId);	
  $res = $this->db->query( $sql );
  if( $res->num_rows() > 0 && ($row = $res->result_first_assoc() )) {
	  return $row;
  }
  return array();
} 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _select_row_barcode_data( $out = null ) 
{ 
  $sql = sprintf( "select  a.customer_id 
				   from t_gn_pod a 
				   where a.pod_code = '%s'", $out->get_value('Barcode','trim') );				
  $res = $this->db->query( $sql );
  if( $res->num_rows() > 0 && ($row = $res->result_first_assoc() )) {
	  return (int)$row['customer_id'];
  }
  return false;
}


// ----------------------------- END CLASS ---------------------------------------------
 

}

?>