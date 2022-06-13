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
 
class M_SrcPrintPdf extends EUI_Model
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
 
private static $arr_usr_level = null;

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


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &UserLevelId() 
 {
   if(is_null(self::$arr_usr_level)) {	
		self::$arr_usr_level =& AllUserIdByLevel(array(USER_ROOT,USER_ADMIN));
   }
   return self::$arr_usr_level;
}


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 protected function _select_row_static_call() 
 {
	$arr_call_status = array_keys(CallResultPrintPdf());
	if( count( $arr_call_status ) != 0 ){
		return $arr_call_status;
	}
  } 

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 public function _get_default()
{
  $out = _find_all_object_request(); 
  $arr_user_level =& self::UserLevelId();
  
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  $this->EUI_Page->_setSelect("a.CustomerId", FALSE);
  $this->EUI_Page->_setFrom("t_gn_customer a");
  $this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId", "INNER");
  $this->EUI_Page->_setJoin("tms_agent c", "a.SellerId=c.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_callreason d", "a.CallReasonId=d.CallReasonId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_product_master e","a.ProductId=e.ProductId", "INNER");
  $this->EUI_Page->_setJoin("t_lk_producttype f","e.ProductTypeId=f.ProductTypeId", "INNER");
	
// ---------------- set filter constant ----------------------------
	
  $this->EUI_Page->_setAnd("b.AssignAdmin",  "IS NOT NULL");
  $this->EUI_Page->_setAnd("b.AssignAmgr", "IS NOT NULL");
  $this->EUI_Page->_setAnd("b.AssignLeader", "IS NOT NULL");
  $this->EUI_Page->_setAnd("b.AssignSelerId", "IS NOT NULL");
  
  $this->EUI_Page->_setAnd("b.AssignBlock", 0);
  $this->EUI_Page->_setWhereIn("e.ProductTypeId", array(PRODUCT_SHORT_FORM));
  $this->EUI_Page->_setWhereNotIn("a.POD", array(AGENT_REQUEST_POD,SPV_REJECT_POD, AGENT_APPROVE_POD));
  $this->EUI_Page->_setWhereIn("a.ProductId", array(ID_PRODUCT_ADDON,ID_PRODUCT_XSELL,ID_PRODUCT_PILL,ID_PRODUCT_CARD));
   
	
// ---------------- call privilege status --------------------------

  if( !is_null( $this->_select_row_static_call() ) ){		
	$this->EUI_Page->_setWhereIn("a.CallReasonId", $this->_select_row_static_call());
  }
	
// ---------------- set filter session  ----------------------------

 // -- admin / root 	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ROOT, USER_ADMIN) )) 
	{
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $arr_user_level);	
	}
	
	
// -- manager --
	if( in_array( _get_session('HandlingType'), 
		array( USER_MANAGER )) )
	{
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}	
	
// -- acc Manager  -- 
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", _get_session('UserId'));
	}
	
// -- spv -- 
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
// -- leader ( TL )	-- 
	if( in_array(_get_session('HandlingType'), 
		array(USER_LEADER))) {
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	
// -- agent ( TSR )	-- 
	if( in_array(_get_session('HandlingType'), 
		array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
	}
// -- filter date cust --- 

 $this->EUI_Page->_setLikeCache("a.CustomerFirstName", 'wpdf_cust_name', true); 
 $this->EUI_Page->_setLikeCache("a.CustomerNumber", 'wpdf_cust_id', true); 
 $this->EUI_Page->_setLikeCache("a.Recsource", 'wpdf_cust_source', true); 
 $this->EUI_Page->_setAndCache("a.CallCategoryId", 'wpdf_call_category', true);
 $this->EUI_Page->_setAndCache("a.CallReasonId", 'wpdf_call_status', true);
 $this->EUI_Page->_setAndCache("b.AssignSelerId", 'wpdf_user_agent', true);
 $this->EUI_Page->_setAndCache("a.CampaignId", 'wpdf_campaign_id', true);	
 $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs>='".StartDate(_get_post('wpdf_call_start_date'))."' ", 'wpdf_call_start_date', true);
 $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs<='".EndDate(_get_post('wpdf_call_end_date'))."' ", 'wpdf_call_end_date', true);
 
// ----------------- group by ------------------------
 $this->EUI_Page->_setGroupBy('CustomerId');
 return $this->EUI_Page;	
 
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 
 public function _get_content()
{
	$arr_user_level =& self::UserLevelId();
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	
	$this->EUI_Page->_setArraySelect( array(
		 "a.CustomerId as CustomerId" => array("CustomerId", "CustomerId", "primary"),
		 "a.Recsource as Recsource" => array("Recsource", "Recsource"),
		 "e.ProductCode as ProductCode" => array("ProductCode", "Product"),
		 //"f.ProductType as ProductType" => array("ProductType", "Type"),
		 "a.CustomerNumber as CustomerNumber" => array("CustomerNumber"," Customer ID"),
		 "a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName"," Customer Name"),
		 "( select ag.init_name from tms_agent ag where ag.UserId = b.AssignSelerId ) as AgentID" => array("AgentID", "Agent ID"),
		 "(select ag.init_name from tms_agent ag where ag.UserId = b.AssignLeader) as SupervisorID" => array("SupervisorID", "Supervisor"),
		 "( SELECT a.CallReasonCategoryName as CategoryName from t_lk_callreasoncategory a  
			WHERE a.CallReasonCategoryId=a.CallCategoryId ) as CategoryName"=> array("CategoryName", "Category Status"),
		 "d.CallReasonDesc as CallResultId" => array("CallResultId","Call Status"),
		 "a.CustomerUpdatedTs as CallDate" => array("CallDate","Call Date"),
		 "a.CustomerId as PrintId" => array("PrintId","Action")
	));
	
	$this->EUI_Page->_setFrom("t_gn_customer a");
	$this->EUI_Page->_setJoin("t_gn_assignment b "," a.CustomerId=b.CustomerId", "INNER");
	$this->EUI_Page->_setJoin("tms_agent c", "a.SellerId=c.UserId", "LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason d", "a.CallReasonId=d.CallReasonId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_product_master e","a.ProductId=e.ProductId", "INNER");
	$this->EUI_Page->_setJoin("t_lk_producttype f","e.ProductTypeId=f.ProductTypeId", "INNER");
	
	
// ---------------- set filter constant ----------------------------
	
	$this->EUI_Page->_setAnd("b.AssignAdmin",  "IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignAmgr", "IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignLeader", "IS NOT NULL");
	$this->EUI_Page->_setAnd("b.AssignSelerId", "IS NOT NULL");
  
	$this->EUI_Page->_setAnd("b.AssignBlock", 0);
	$this->EUI_Page->_setWhereIn("e.ProductTypeId", array(PRODUCT_SHORT_FORM));
    $this->EUI_Page->_setWhereNotIn("a.POD", array(AGENT_REQUEST_POD,SPV_REJECT_POD, AGENT_APPROVE_POD));
    $this->EUI_Page->_setWhereIn("a.ProductId", array(ID_PRODUCT_ADDON,ID_PRODUCT_XSELL,ID_PRODUCT_PILL,ID_PRODUCT_CARD));
	
// ---------------- call privilege status --------------------------

  if( !is_null( $this->_select_row_static_call() ) ){		
	$this->EUI_Page->_setWhereIn("a.CallReasonId", $this->_select_row_static_call());
  }
  
// ---------------- set filter session  ----------------------------

 // -- admin / root 	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ROOT, USER_ADMIN) )) 
	{
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $arr_user_level);	
	}
	
	
// -- manager --
	if( in_array( _get_session('HandlingType'), 
		array( USER_MANAGER )) )
	{
		$this->EUI_Page->_setAnd("b.AssignMgr", _get_session('UserId'));
	}	
	
// -- acc Manager  -- 
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_ACCOUNT_MANAGER))) {
		$this->EUI_Page->_setAnd("b.AssignAmgr", _get_session('UserId'));
	}
	
// -- spv -- 
	
	if( in_array(_get_session('HandlingType'), 
		array(USER_SUPERVISOR))) {
		$this->EUI_Page->_setAnd("b.AssignSpv", _get_session('UserId'));
	}
	
// -- leader ( TL )	-- 
	if( in_array(_get_session('HandlingType'), 
		array(USER_LEADER))) {
		$this->EUI_Page->_setAnd("b.AssignLeader", _get_session('UserId'));
	}
	
	
// -- agent ( TSR )	-- 
	if( in_array(_get_session('HandlingType'), 
		array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) )) {
		$this->EUI_Page->_setAnd("b.AssignSelerId", _get_session('UserId'));	
	}
 	
// -- filter date cust --- 

 $this->EUI_Page->_setLikeCache("a.CustomerFirstName", 'wpdf_cust_name', true); 
 $this->EUI_Page->_setLikeCache("a.CustomerNumber", 'wpdf_cust_id', true); 
 $this->EUI_Page->_setLikeCache("a.Recsource", 'wpdf_cust_source', true); 
 $this->EUI_Page->_setAndCache("a.CallCategoryId", 'wpdf_call_category', true);
 $this->EUI_Page->_setAndCache("a.CallReasonId", 'wpdf_call_status', true);
 $this->EUI_Page->_setAndCache("b.AssignSelerId", 'wpdf_user_agent', true);
 $this->EUI_Page->_setAndCache("a.CampaignId", 'wpdf_campaign_id', true);	
 $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs>='".StartDate(_get_post('wpdf_call_start_date'))."' ", 'wpdf_call_start_date', true);
 $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs<='".EndDate(_get_post('wpdf_call_end_date'))."' ", 'wpdf_call_end_date', true);
 
		
// -------------- set order ---------------------------
	
 if( _get_have_post('order_by') ){
   $this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type') ); 
 } else {
   $this->EUI_Page->_setOrderBy("a.CustomerCallDateTs","ASC");
 }
 
// -------  limit page  ---------------- 
 $this->EUI_Page->_setLimit();
// ------- debug  --- 
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


 public function _set_row_save_user_write_pod( $out = null )
{
 if( !is_object($out) ){ 
	return FALSE; 
 }
 
// -----------------------------------------------------------------------------------------------------

 $arrObj = $this->_select_row_agen_customer_pod( $out->get_value('PodCustomerId','strtoupper')  ); 
 $obj = Objective( $arrObj );
 
// ----- reset write --------------------------------------  
 
 $this->db->reset_write();
 $this->db->set("recsource", $out->get_value('PodRecsourceId','strtoupper') );
 $this->db->set("campaign_id", $out->get_value('PodCampaignId','strtoupper') );
 $this->db->set("product_id", $out->get_value('PodProductId','strtoupper') );
 $this->db->set("customer_id", $out->get_value('PodCustomerId','strtoupper') );
 $this->db->set("customer_number", $out->get_value('PodCustomerNumber','strtoupper') );
 $this->db->set("agent_id", $obj->get_value('AgentId') );
 $this->db->set("agent_code", $obj->get_value('AgentCode') );
 $this->db->set("pod_code", $out->get_value('PodCustomerNumber','strtoupper') );
 $this->db->set("customer_name", $out->get_value('PodCustomerFirstName','strtoupper') );
 $this->db->set("tujuan_kirim", $out->get_value('PodBilingAddress') );
 $this->db->set("address_line", $out->get_value('PodAddress') );
 $this->db->set("address_wilayah", $out->get_value('PodWilayah','strtoupper') );
 $this->db->set("document_type", $out->get_value('PodDocumentType','strtoupper') );
 $this->db->set("pick_up_date", $out->get_value('PodPickupDate','_getDateEnglish') );
 $this->db->set("note", $out->get_value('PodUserNote','strtoupper') );
 $this->db->set("updated_by", _get_session('UserId','strtoupper'));
 $this->db->set("pod_date", date('Y-m-d H:i:s'));
 $this->db->set("last_update", date('Y-m-d H:i:s'));

// --- on duplicate --- 
 $this->db->duplicate("last_update", date('Y-m-d H:i:s'));
 $this->db->duplicate("updated_by", _get_session('UserId','strtoupper'));
 $this->db->insert_on_duplicate("t_gn_pod");
 
 $PodId = 0;
  if( $this->db->affected_rows() > 0 ) 
 {
	$PodId = $this->db->insert_id(); 
	
// ------- Update POD Code --------------------------- 	
	$RefPodCode = $this->_set_auto_write_pod_code('RFC', $PodId);
	
	 if( strlen($RefPodCode) > 0 )
	{
		$this->db->reset_write();
		$this->db->set("pod_code", $RefPodCode);
		$this->db->where("pod_id", $PodId);
		$this->db->where("customer_id", $out->get_value('PodCustomerId','strtoupper'));
		$this->db->update("t_gn_pod");
	}
	
// -------- update Customer DATA -----------------------	
	$this->db->reset_write();
	$this->db->where("CustomerNumber", $out->get_value('PodCustomerNumber'));
	$this->db->set("POD", AGENT_WRITE_POD);
	$this->db->update('t_gn_customer');
 }
 
 return (int)$PodId;
 
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