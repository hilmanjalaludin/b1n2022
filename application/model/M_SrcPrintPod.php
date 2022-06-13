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
 
class M_SrcPrintPod extends EUI_Model
{
	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 	
private static $arr_usr_level = null;
	
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




// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 protected function _select_row_static_call() 
 {
	$arr_call_status = PrivilegeStatusCall(_get_session('HandlingType'));
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
	
// -- re pickup --- 
	
  $arr_call_req_pickup = array_keys(CallRequestPickup());  
  $arr_user_level =& self::UserLevelId();
  
  $out = _find_all_object_request(); 
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  $this->EUI_Page->_setSelect("a.pod_id", FALSE);
  $this->EUI_Page->_setFrom("t_gn_pod a");
  $this->EUI_Page->_setJoin("t_gn_customer b ","a.customer_id=b.CustomerId", "INNER");  
  $this->EUI_Page->_setJoin("tms_agent c ", "a.agent_id=c.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_product_master d "," a.product_id=d.ProductId", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_producttype e "," d.ProductTypeId=e.ProductTypeId", "LEFT", true);
 
  
// ---------------- set filter constant ----------------------------
  $this->EUI_Page->_setWhereIn("e.ProductType", array('LF','SF'));
  $this->EUI_Page->_setWhereNotIn("b.POD", array(AGENT_REQUEST_POD,SPV_REJECT_POD));
  $this->EUI_Page->_setWhereNotIn("b.ProductId", array(ID_PRODUCT_ADDON));
  $this->EUI_Page->_setWhereIn("b.CallReasonId", $arr_call_req_pickup );
  
  $this->EUI_Page->_setLikeCache("a.pod_code", 'cust_ref_no_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_name", 'cust_name_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_id", 'cust_id_pod', true); 
  $this->EUI_Page->_setLikeCache("a.address_wilayah", 'cust_wilayah_pod', true); 
  $this->EUI_Page->_setLikeCache("a.tujuan_kirim", 'cust_tujuan_kirim_pod', true); 
  $this->EUI_Page->_setLikeCache("a.document_type", 'cust_doc_type_pod', true);
  $this->EUI_Page->_setAndCache("a.recsource", 'cust_recsource_pod', true);
  $this->EUI_Page->_setAndCache("a.agent_id", 'cust_agent_id_pod', true);
  $this->EUI_Page->_setAndCache("a.campaign_id", 'cust_campaign_pod', true);	
  $this->EUI_Page->_setAndOrCache("a.pick_up_date>='".StartDate(_get_post('pickup_pod_start_date'))."' ", 'pickup_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pick_up_date<='".EndDate(_get_post('pickup_pod_end_date'))."' ", 'pickup_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date>='".StartDate(_get_post('write_pod_start_date'))."' ", 'write_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date<='".EndDate(_get_post('write_pod_end_date'))."' ", 'write_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date>='".StartDate(_get_post('print_pod_start_date'))."' ", 'print_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date<='".EndDate(_get_post('print_pod_end_date'))."' ", 'print_pod_end_date', true);

 
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
		
// -- re pickup --- 
	$arr_call_req_pickup = array_keys(CallRequestPickup());  
	$arr_user_level =& self::UserLevelId();
	
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	
	$this->EUI_Page->_setArraySelect( array(
		 "a.pod_id as PodId" => array("PodId", "PodId", "primary"),
		 "a.recsource as Recsource" => array("Recsource", "Recsource"),
		 "d.ProductCode as ProductCode" => array("ProductCode", "Product"),
		 "e.ProductType as ProductType" => array("ProductType", "Type"),
		 "a.customer_number as CustomerNumber" => array("CustomerNumber", "Customer ID"),
		 "a.pod_code as ReffPodNo" => array("ReffPodNo"," Reff. POD"),
		 "a.customer_name as CustomerName" => array("CustomerName"," Customer Name"),
		 "a.address_wilayah as Wilayah" => array("Wilayah","Wilayah"),
		 "a.tujuan_kirim as TujuanKirim" => array("TujuanKirim","Tujuan Kirim"),
		 "a.document_type as Document" => array("Document","Jenis Dokument"),
		 "a.agent_code as AgentId" => array("AgentId","Agent ID"),
		 "(select ds.CallReasonDesc from t_lk_callreason ds where ds.CallReasonId=b.CallReasonId) 
		  as CallStatus" => array("CallStatus", "Call Status"),
		 "a.pick_up_date as PickupDate" => array("PickupDate","Pick Up Date"),
		 "a.pod_date as PodWrite" => array("PodWrite","POD Date"),
		 "a.print_date as PrintDate" => array("PrintDate","Print Date"),
		 "a.customer_id as PrintId" => array("PrintId","Action")
		 
	));
	
  $this->EUI_Page->_setFrom("t_gn_pod a");
  $this->EUI_Page->_setJoin("t_gn_customer b ","a.customer_id=b.CustomerId", "INNER");  
  $this->EUI_Page->_setJoin("tms_agent c ", "a.agent_id=c.UserId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_product_master d "," a.product_id=d.ProductId", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_producttype e "," d.ProductTypeId=e.ProductTypeId", "LEFT", true);
  
  
  // ---------------- set filter constant ----------------------------
  
  $this->EUI_Page->_setWhereIn("e.ProductType", array('LF','SF'));
  $this->EUI_Page->_setWhereNotIn("b.POD", array(AGENT_REQUEST_POD,SPV_REJECT_POD));
  $this->EUI_Page->_setWhereNotIn("b.ProductId", array(ID_PRODUCT_ADDON));
  $this->EUI_Page->_setWhereIn("b.CallReasonId", $arr_call_req_pickup);
  
  
  $this->EUI_Page->_setLikeCache("a.pod_code", 'cust_ref_no_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_name", 'cust_name_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_id", 'cust_id_pod', true); 
  $this->EUI_Page->_setLikeCache("a.address_wilayah", 'cust_wilayah_pod', true); 
  $this->EUI_Page->_setLikeCache("a.tujuan_kirim", 'cust_tujuan_kirim_pod', true); 
  $this->EUI_Page->_setLikeCache("a.document_type", 'cust_doc_type_pod', true);
  $this->EUI_Page->_setAndCache("a.recsource", 'cust_recsource_pod', true);
  $this->EUI_Page->_setAndCache("a.agent_id", 'cust_agent_id_pod', true);
  $this->EUI_Page->_setAndCache("a.campaign_id", 'cust_campaign_pod', true);	
  $this->EUI_Page->_setAndOrCache("a.pick_up_date>='".StartDate(_get_post('pickup_pod_start_date'))."' ", 'pickup_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pick_up_date<='".EndDate(_get_post('pickup_pod_end_date'))."' ", 'pickup_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date>='".StartDate(_get_post('write_pod_start_date'))."' ", 'write_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date<='".EndDate(_get_post('write_pod_end_date'))."' ", 'write_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date>='".StartDate(_get_post('print_pod_start_date'))."' ", 'print_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date<='".EndDate(_get_post('print_pod_end_date'))."' ", 'print_pod_end_date', true);

// -------------- set order ---------------------------
	
 if( _get_have_post('order_by') ){
	$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type') ); 
 } else {
	$this->EUI_Page->_setOrderBy("a.pod_id","DESC");
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


 public function _set_row_save_user_print_pod( $out = null )
{
  if( is_null($out) OR !is_object($out) ){
	  return FALSE;
  }
  
 // --- load call result  --  
 
 $CustomerId = $out->get_value('CustomerId');
 $PodId = $out->get_value('PodId');
 $AgentName = _get_session('Username', 'strtoupper');
 $AgentId  = _get_session('UserId');
 
 $obUsys =& get_class_instance('M_SysUser');
 $obRslt =& get_class_instance('M_SetCallResult');
 $xlRslt =& Objective($obRslt->_select_row_detail_status(CALL_STS_PICKUP_APPLIKASI) );
  
 // -- update print date --   
  
 $sql = sprintf("UPDATE t_gn_pod a SET a.print_date=NOW(),  a.print_status=1, a.updated_by='%s' WHERE a.pod_id=%d", $AgentName, $PodId);

 if( $this->db->query($sql) )
 {
	// -- update status ,customer on tgn customer -----------------
	
	$PODStatus			= AGENT_PICKUP_POD;
	$CallReasonId  		= $xlRslt->get_value('CallReasonId');
	$Adm_CallReasonId 	= $xlRslt->get_value('CallReasonId');
	$CallCategoryId 	= $xlRslt->get_value('CallReasonCategoryId');
	$CallCategoryCode  	= $xlRslt->get_value('CallReasonCategoryCode');
	$CallReasonCode 	= $xlRslt->get_value('CallReasonCode');
	
	$sql = sprintf("UPDATE t_gn_customer a 
						INNER JOIN t_gn_pod b ON ( a.CustomerId=b.customer_id AND a.CustomerNumber=b.customer_number )
					SET 
						a.CallReasonId = '%s',
						a.CallCategoryId = '%s',
						a.CallCategoryCode ='%s',
						a.CallReasonCode = '%s',
						a.POD = '%s',
						a.Adm_UpdateTs = NOW(),
						a.CustomerUpdatedTs = NOW(),
						a.Adm_CallReasonId ='%s',
						a.Adm_Id = '%s',
						a.UpdatedById='%s'
					WHERE b.pod_id='%s'", 
					$CallReasonId,
					$CallCategoryId,
					$CallCategoryCode,
					$CallReasonCode,
					$PODStatus,
					$Adm_CallReasonId,
					$AgentId,
					$AgentId,
					$PodId);
	$this->db->query($sql);
	
	// --- history  track activity user by OK --------- 
	
	$obUser   =& Objective( $obUsys->_getUserDetail(_get_session('UserId')) );
	$obTls    =& Objective( $obUsys->_getUserDetail($obUser->get_value('tl_id')) );
	$obAtm    =& Objective( $obUsys->_getUserDetail($obUser->get_value('spv_id')) );
	$obAmgr   =& Objective( $obUsys->_getUserDetail($obUser->get_value('act_mgr')) );
	$obMgr    =& Objective( $obUsys->_getUserDetail($obUser->get_value('mgr_id')) );
	$obAdmin  =& Objective( $obUsys->_getUserDetail($obUser->get_value('admin_id')) );
	 
    // -- auto notes --- 
	
	$Notes = sprintf("%s - %s", "<b>ADMIN PRINT</b>", "PRINT POD AND AUTOMATIC CHANGE STATUS PICK UP.");
	
	// --  
	$this->db->reset_write();
	
	$this->db->set('CustomerId',$CustomerId);
	$this->db->set('CallHistoryNotes', $Notes); 
	$this->db->set('CallReasonId',$xlRslt->get_value('CallReasonId')); 
	$this->db->set('CreatedById',$obUser->get_value('UserId','intval'));
	$this->db->set('AgentCode',$obUser->get_value('Username',array('evalute','strtoupper')));
	$this->db->set('SPVCode',$obTls->get_value('Username',array('evalute','strtoupper')),true);
	$this->db->set('ATMCode',$obAtm->get_value('Username',array('evalute','strtoupper')),true);
	$this->db->set('AMGRCode',$obAmgr->get_value('Username',array('evalute','strtoupper')),true);
	$this->db->set('MGRCode',$obMgr->get_value('Username',array('evalute','strtoupper')),true);
	$this->db->set('ADMINCode',$obAdmin->get_value('Username',array('evalute','strtoupper')),true);
	$this->db->set('HistoryType',CHANGE_ACTIVITY);
	
	$this->db->set('CallHistoryCallDate',date('Y-m-d H:i:s'));
	$this->db->set('CallHistoryCreatedTs',date('Y-m-d H:i:s'));
	$this->db->set('CallSessionId', '0');
	$this->db->insert('t_gn_callhistory');
	
	return array(
		'print_date' => date('d-m-Y'), 
		'print_status' => IsPrinted(1) 
	);
			
 }			
	return FALSE;
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 public function _select_attr_confirm_detail( $CustomerId = 0  )
{
  
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