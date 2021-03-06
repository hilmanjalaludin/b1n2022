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
 
class M_SrcCustomerClosing extends EUI_Model
{

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var $arr_limit_page  = 20;
var $arr_call_status = array();
var $arr_user_privilege = array();

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private static $arr_usr_level = null;


 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private static $Instance = null;

 /**
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


 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function __construct() {
	$this->load->model(array ( 'M_SrcCustomerList', 'M_UserRole' ));
	
}


 /**
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
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 protected function _select_row_static_call() 
 {
	$arr_call_static = array(); 
	$arr_call_static = CallResultInterest();
	if( count($arr_call_static) > 0 ){
		return array_keys($arr_call_static);
	}
	return $arr_call_static;
	
  } 

  /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _get_default()
{
	
  // get all process request data from client
  $out = UR();  $cok = CK(); $cnf = CF();
  //print_r($out);
  
// user level data on by process 
 
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  $this->EUI_Page->_setCount(true);
  $this->EUI_Page->_setSelect("count(a.DM_Id) as total", FALSE);
  $this->EUI_Page->_setFrom("t_gn_customer_master a");
  $this->EUI_Page->_setJoin("t_gn_frm_usage d", "a.DM_Id=d.TX_Usg_CustId","LEFT");
  $this->EUI_Page->_setJoin("t_gn_frm_balcon e", "a.DM_Id=e.TX_Usg_CustId","LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment b "," a.DM_Id=b.AssignCustId", "INNER" );
  $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
  
   
// find cookies data 
//edit hilman & andi
  if( $cok->find_value('UserId') ){
	$this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(APRV,CLOS,RDPC));	
	// $this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(APRV,CLOS,YCOM,NCOM ));	
  }

  if( $cok->find_value('UserId') ){
  // $this->EUI_Page->_setAnd("a.DM_DateExpired >= curdate()"); 
  $this->EUI_Page->_setAnd("c.CampaignEndDate >= curdate()"); 
  }

// ADMIN / ROOT 	
  if( $cok->cookie(array(USER_ROOT, USER_ADMIN) )) {
	 $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
  }
	
// ACC MANAGER  -- 
  if( $cok->cookie(array(USER_ACCOUNT_MANAGER))) {
	$this->EUI_Page->_setAnd("b.AssignAmgr", $cok->field('UserId'));
  }
	
// MANAGER --
  if( $cok->cookie(array(USER_MANAGER))) {
	$this->EUI_Page->_setAnd("b.AssignMgr", $cok->field('UserId'));
  }	
	
// SPV -- 
 if( $cok->cookie(array(USER_SUPERVISOR))) { 
	$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
 }
	
// LEADER ( TL )	-- 
 if( $cok->cookie(array(USER_LEADER))) {
	$this->EUI_Page->_setAnd("b.AssignLeader",$cok->field('UserId'));
 }
	
// AGENT ( TSR )	-- 
 if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))) {
	$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
	// $this->EUI_Page->_setAnd("d.TX_Usg_SellerId", $cok->field('UserId'));
 }
	
// default data filter data process pager.
  $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'SEL_CallKategoryId', 	 TRUE);
  $this->EUI_Page->_setAndCache("a.DM_QualityCategoryId", 'SEL_QualityCategoryId',  TRUE);
  $this->EUI_Page->_setAndCache("a.DM_AdmCategoryId", 'SEL_AdmCategoryId', 	 TRUE);
  $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs", 'SEL_UpdateTs_start_date',TRUE);
  $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 'SEL_UpdateTs_end_date',  TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'SEL1_filter_field', 'SEL1_filter_value', TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'SEL2_filter_field', 'SEL2_filter_value', TRUE);
   
// return data pager to client 'state' 
 //echo $this->EUI_Page->_getCompiler();
  return $this->EUI_Page;	
 
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _get_content()
{
	
// get all data proces in out 
  $out = UR(); $cok = CK(); $cnf = CF();

// then testing group user .
  $this->EUI_Page->_postPage($out->field('v_page'));
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  
  
  // select data array convert to page.
  $this->EUI_Page->_setArraySelect(array(
		"a.DM_Id as CustomerId"							 => array("CustomerId",			 "CustomerId","primary"),
		"a.DM_CampaignId as DM_CampaignId"				 => array("DM_CampaignId", 		 "DM_CampaignId"),
		"a.DM_Custno as DM_Custno"						 => array("DM_Custno", 	 	 	 "DM_Custno"),
		"a.DM_FirstName as DM_FirstName"				 => array("DM_FirstName",		 "DM_FirstName"),
		// "a.DM_AddressLine1 as DM_AddressLine1"			=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
		// "a.DM_AddressLine2 as DM_AddressLine2"			=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
		// "a.DM_AddressLine3 as DM_AddressLine3"			=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
		
		//"a.DM_Id as DM_CustomerAddress"					 => array("DM_CustomerAddress", "DM_CustomerAddress"), 
		// "a.DM_GenderId as DM_GenderId"					 => array("DM_GenderId", 		 "DM_GenderId"),
		"a.DM_SellerId as DM_SellerId"					 => array("DM_SellerId", 		 "DM_SellerId"),
    "d.TX_Usg_JumlahDana as TX_Usg_JumlahDana"           => array("TX_Usg_JumlahDana", "Dana"),
		"a.DM_CallCategoryId as DM_CallCategoryId"		 => array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		"a.DM_QualityUserId as DM_QualityUserId"	 	 => array("DM_QualityUserId", 	 "DM_QualityUserId"),	
		
		"a.DM_QualityCategoryId as DM_QualityCategoryId" => array("DM_QualityCategoryId","DM_QualityCategoryId"),
		"a.DM_AdmCategoryId as DM_AdmCategoryId" 		 => array("DM_AdmCategoryId",	 "DM_AdmCategoryId"),
		"a.DM_LastCategoryKode as DM_LastCategoryKode" 	 => array("DM_LastCategoryKode", "DM_LastCategoryKode"),
		"a.DM_LastReasonKode as DM_LastReasonKode" 		 => array("DM_LastReasonKode",	 "DM_LastReasonKode"), 
		
		//"a.DM_ApproveTs as DM_ApproveTs" 		    	 => array("DM_ApproveTs", 		 "DM_ApproveTs"), 
		"a.DM_UpdatedTs as DM_UpdatedTs" 		    	 => array("DM_UpdatedTs", 		 "DM_UpdatedTs") 
		
	));
	
  $this->EUI_Page->_setFrom("t_gn_customer_master a");
  $this->EUI_Page->_setJoin("t_gn_frm_usage d", "a.DM_Id=d.TX_Usg_CustId","LEFT");
  $this->EUI_Page->_setJoin("t_gn_frm_balcon e", "a.DM_Id=e.TX_Usg_CustId","LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment b "," a.DM_Id=b.AssignCustId", "INNER");
  $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
  
 
// find cookies data 
//edit hilman & andi 05112020
  if( $cok->find_value('UserId') ){
	$this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(APRV,CLOS,RDPC ));
	// $this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(APRV,CLOS,YCOM,NCOM ));	
  }

  if( $cok->find_value('UserId') ){
  // $this->EUI_Page->_setAnd("a.DM_DateExpired >= curdate()"); 
  $this->EUI_Page->_setAnd("c.CampaignEndDate >= curdate()"); 
 }
	
// ADMIN / ROOT 	
  if( $cok->cookie(array(USER_ROOT, USER_ADMIN) )) {
	 $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
  }
	
// ACC MANAGER  -- 
  if( $cok->cookie(array(USER_ACCOUNT_MANAGER))) {
	$this->EUI_Page->_setAnd("b.AssignAmgr", $cok->field('UserId'));
  }
	
// MANAGER --
  if( $cok->cookie(array(USER_MANAGER))) {
	$this->EUI_Page->_setAnd("b.AssignMgr", $cok->field('UserId'));
  }	
	
// SPV -- 
 if( $cok->cookie(array(USER_SUPERVISOR))) { 
	$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
 }
	
// LEADER ( TL )	-- 
 if( $cok->cookie(array(USER_LEADER))) {
	$this->EUI_Page->_setAnd("b.AssignLeader",$cok->field('UserId'));
 }
	
// AGENT ( TSR )	-- 
 if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))) {
	$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
	// $this->EUI_Page->_setAnd("d.TX_Usg_SellerId", $cok->field('UserId'));	
 }
	
 	//debug($out);
	
// default data filter data process pager.
  $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'SEL_CallKategoryId', TRUE);
  $this->EUI_Page->_setAndCache("a.DM_QualityCategoryId", 'SEL_QualityCategoryId',  TRUE);
  $this->EUI_Page->_setAndCache("a.DM_AdmCategoryId", 'SEL_AdmCategoryId', 	 TRUE);
  $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs", 'SEL_UpdateTs_start_date',TRUE);
  $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 'SEL_UpdateTs_end_date',  TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'SEL1_filter_field', 'SEL1_filter_value', TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 'SEL2_filter_field', 'SEL2_filter_value', TRUE);
	
		
// set order ---------------------------
 if( $out->find_value('order_by') ){
	$this->EUI_Page->_setOrderBy( $out->field('order_by'), $out->field('type') ); 
 } else {
	$this->EUI_Page->_setOrderBy("a.DM_UpdatedTs","ASC");
 }
 
 $this->EUI_Page->_setLimit();
 //echo $this->EUI_Page->_getCompiler(); 


	
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
  
 public function _select_attr_row_pod( $out = null ) 
{
  $arr_style = array( 'attr' =>  null );
  
  $sql = sprintf("select a.pod_id from t_gn_pod a where a.customer_id = '%s'", $out->get_value('CustomerId'));
  $res = $this->db->query( $sql );
  if( $res->num_rows() > 0 ) {
	$arr_style = array( 'attr' =>  'ui-disabled' );
  }
  return $arr_style;
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

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function _getPolicyAutogen( $CustomerId =null  ) { } 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function _getAvailProduct( $CustomerId = 0 ) { }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _getLastCallPhone($CustomerId = 0 ) { }


// ----------------------------- END CLASS ---------------------------------------------
 

}

?>