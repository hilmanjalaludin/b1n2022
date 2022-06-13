<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
class M_SrcApprovalPod extends EUI_Model
{
	

var $arr_call_status = array();
var $arr_user_privilege = array();


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  	
 private static $arr_usr_level = null;
 private static $Instance = null;
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

 function __construct() { 
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
 
 public function _select_pager_count()
{
	
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
  $this->EUI_Page->_setAnd("b.POD", AGENT_WRITE_POD);
  $this->EUI_Page->_setWhereNotIn("b.ProductId", array(ID_PRODUCT_ADDON));
  
  $this->EUI_Page->_setWhereIn("e.ProductType", array('LF','SF'));
  $this->EUI_Page->_setLikeCache("a.pod_code", 'aprv_ref_no_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_name", 'aprv_name_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_id", 'aprv_id_pod', true); 
  $this->EUI_Page->_setLikeCache("a.address_wilayah", 'aprv_wilayah_pod', true); 
  $this->EUI_Page->_setLikeCache("a.tujuan_kirim", 'aprv_tujuan_kirim_pod', true); 
  $this->EUI_Page->_setLikeCache("a.document_type", 'aprv_doc_type_pod', true);
  $this->EUI_Page->_setAndCache("a.recsource", 'aprv_recsource_pod', true);
  $this->EUI_Page->_setAndCache("a.agent_id", 'aprv_agent_id_pod', true);
  $this->EUI_Page->_setAndCache("a.campaign_id", 'aprv_campaign_pod', true);	
  $this->EUI_Page->_setAndOrCache("a.pick_up_date>='".StartDate(_get_post('aprv_pickup_pod_start_date'))."' ", 'aprv_pickup_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pick_up_date<='".EndDate(_get_post('aprv_pickup_pod_end_date'))."' ", 'aprv_pickup_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date>='".StartDate(_get_post('aprv_write_pod_start_date'))."' ", 'aprv_write_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date<='".EndDate(_get_post('aprv_write_pod_end_date'))."' ", 'aprv_write_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date>='".StartDate(_get_post('aprv_print_pod_start_date'))."' ", 'aprv_print_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date<='".EndDate(_get_post('aprv_print_pod_end_date'))."' ", 'aprv_print_pod_end_date', true);

 
 return $this->EUI_Page;	
 
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 
 public function _select_page_content()
{
	$arr_user_level =& self::UserLevelId();
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	
	$this->EUI_Page->_setArraySelect( array(
		 "a.customer_id as CustomerId" => array("CustomerId", "CustomerId", "primary"),
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
  
  $this->EUI_Page->_setAnd("b.POD", AGENT_WRITE_POD);
  $this->EUI_Page->_setWhereNotIn("b.ProductId", array(ID_PRODUCT_ADDON));
  
  
  $this->EUI_Page->_setWhereIn("e.ProductType", array('LF','SF'));
  $this->EUI_Page->_setLikeCache("a.pod_code", 'aprv_ref_no_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_name", 'aprv_name_pod', true); 
  $this->EUI_Page->_setLikeCache("a.customer_id", 'aprv_id_pod', true); 
  $this->EUI_Page->_setLikeCache("a.address_wilayah", 'aprv_wilayah_pod', true); 
  $this->EUI_Page->_setLikeCache("a.tujuan_kirim", 'aprv_tujuan_kirim_pod', true); 
  $this->EUI_Page->_setLikeCache("a.document_type", 'aprv_doc_type_pod', true);
  $this->EUI_Page->_setAndCache("a.recsource", 'aprv_recsource_pod', true);
  $this->EUI_Page->_setAndCache("a.agent_id", 'aprv_agent_id_pod', true);
  $this->EUI_Page->_setAndCache("a.campaign_id", 'aprv_campaign_pod', true);	
  $this->EUI_Page->_setAndOrCache("a.pick_up_date>='".StartDate(_get_post('aprv_pickup_pod_start_date'))."' ", 'aprv_pickup_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pick_up_date<='".EndDate(_get_post('aprv_pickup_pod_end_date'))."' ", 'aprv_pickup_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date>='".StartDate(_get_post('aprv_write_pod_start_date'))."' ", 'aprv_write_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.pod_date<='".EndDate(_get_post('aprv_write_pod_end_date'))."' ", 'aprv_write_pod_end_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date>='".StartDate(_get_post('aprv_print_pod_start_date'))."' ", 'aprv_print_pod_start_date', true);
  $this->EUI_Page->_setAndOrCache("a.print_date<='".EndDate(_get_post('aprv_print_pod_end_date'))."' ", 'aprv_print_pod_end_date', true);

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
 
 function _select_pager_source()
{
	$this->_select_page_content();	
	
	if( $this->EUI_Page->_get_query() !='' ) {
		return $this->EUI_Page->_result();
	}	
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _select_pager_number()  
{
	if( $this->EUI_Page->_get_query()!='' ) {
		return $this->EUI_Page->_getNo();
	}	
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


 public function _set_row_save_user_approve_pod( $out = null )
{
  if( is_null($out) OR !is_object($out) ){
	  return FALSE;
  }
  
 // --- load call result  --  
 
    $CustomerId 	= $out->get_value('CustomerId');
	$SpvName 		= _get_session('Username', 'strtoupper');
	$SpvId  		= _get_session('UserId');
	$PODStatus 		= SPV_APPROVE_POD;
 
	$obUsys 		=& get_class_instance('M_SysUser');
	$obRslt 		=& get_class_instance('M_SetCallResult');
	$obCust 		=& get_class_instance('M_SrcCustomerList'); //_getDetailCustomer

// --- lihat ini bro ...!
	
	$this->db->query(sprintf( "UPDATE t_gn_customer a set a.CallReasonId='%s'
					  WHERE a.CustomerId='%s'", 
					  CALL_STS_REQUEST_PICKUP, 
					  $CustomerId
					));
	
// --- update t_gn_customer then will set 
	
	$obval = Objective( $obRslt->_select_row_detail_status(CALL_STS_REQUEST_PICKUP));
	
	
// -- update status ,customer on tgn customer -----------------
	
	$CallReasonId 	  = $obval->get_value('CallReasonId');
	$CallReasonCode   = $obval->get_value('CallReasonCode');
	$CallCategoryId   = $obval->get_value('CallReasonCategoryId');
	$CallCategoryCode = $obval->get_value('CallReasonCategoryCode');
	
	
	$sql = sprintf("UPDATE t_gn_customer a 
						INNER JOIN t_gn_pod b ON ( a.CustomerId=b.customer_id AND a.CustomerNumber=b.customer_number )
					SET 
						a.POD = '%s',
						a.SPV_UpdateTs = NOW(),
						a.CustomerUpdatedTs = NOW(),
						a.SPV_Id = '%s',
						a.UpdatedById='%s',
						a.SPV_CallReasonId='%s',
						a.Agent='%s',
						a.CallReasonId='%s',
						a.CallReasonCode='%s',
						a.CallCategoryCode='%s',
						a.CallCategoryId='%s'
					WHERE b.customer_id='%s'", 
						$PODStatus,
						$SpvId,
						$SpvId,
						$CallReasonId,
						$SpvName,
						$CallReasonId,
						$CallReasonCode,
						$CallCategoryCode,
						$CallCategoryId,
						$CustomerId
				);
					
	$this->db->query($sql);
	
	// --- history  track activity user by OK --------- 
	
	$obUser   =& Objective( $obUsys->_getUserDetail(_get_session('UserId')) );
	$obTls    =& Objective( $obUsys->_getUserDetail($obUser->get_value('tl_id')) );
	$obAtm    =& Objective( $obUsys->_getUserDetail($obUser->get_value('spv_id')) );
	$obAmgr   =& Objective( $obUsys->_getUserDetail($obUser->get_value('act_mgr')) );
	$obMgr    =& Objective( $obUsys->_getUserDetail($obUser->get_value('mgr_id')) );
	$obAdmin  =& Objective( $obUsys->_getUserDetail($obUser->get_value('admin_id')) );
	 
    // -- auto notes --- 
	
	$Notes = sprintf("%s - %s", "<b>USER APROVE POD</b>", "APPROVAL POD AUTOMATIC APROVE.");
	
	// --  
	$this->db->reset_write();
	
	$this->db->set('CustomerId',$CustomerId);
	$this->db->set('CallHistoryNotes', $Notes); 
	$this->db->set('CallReasonId',$obval->get_value('CallReasonId')); 
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
	if( $this->db->insert('t_gn_callhistory') ){
		return true;
	}
	
	return FALSE;
	
}
 
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


 public function _set_row_save_user_reject_pod( $out = null )
{
  if( is_null($out) OR !is_object($out) ){
	  return FALSE;
  }
  
 // --- load call result  --  
 
    $CustomerId 	= $out->get_value('CustomerId');
	$SpvName 		= _get_session('Username', 'strtoupper');
	$SpvId  		= _get_session('UserId');
	$PODStatus 		= SPV_REJECT_POD;
 
	$obUsys 		=& get_class_instance('M_SysUser');
	$obRslt 		=& get_class_instance('M_SetCallResult');
	$obCust 		=& get_class_instance('M_SrcCustomerList'); //_getDetailCustomer
	$obval			=Objective( $obCust->_getDetailCustomer($CustomerId) );
	
// -- update status ,customer on tgn customer -----------------
	
	$CallReasonId = $obval->get_value('CallReasonId');
	
	$sql = sprintf("UPDATE t_gn_customer a 
						INNER JOIN t_gn_pod b ON ( a.CustomerId=b.customer_id AND a.CustomerNumber=b.customer_number )
					SET 
						a.POD = '%s',
						a.SPV_UpdateTs = NOW(),
						a.CustomerUpdatedTs = NOW(),
						a.SPV_Id = '%s',
						a.UpdatedById='%s',
						a.SPV_CallReasonId='%s',
						a.Agent='%s'
					WHERE b.customer_id='%s'", 
						$PODStatus,
						$SpvId,
						$SpvId,
						$CallReasonId,
						$SpvName,
						$CustomerId
				);
					
	$this->db->query($sql);
	
	// --- history  track activity user by OK --------- 
	
	$obUser   =& Objective( $obUsys->_getUserDetail(_get_session('UserId')) );
	$obTls    =& Objective( $obUsys->_getUserDetail($obUser->get_value('tl_id')) );
	$obAtm    =& Objective( $obUsys->_getUserDetail($obUser->get_value('spv_id')) );
	$obAmgr   =& Objective( $obUsys->_getUserDetail($obUser->get_value('act_mgr')) );
	$obMgr    =& Objective( $obUsys->_getUserDetail($obUser->get_value('mgr_id')) );
	$obAdmin  =& Objective( $obUsys->_getUserDetail($obUser->get_value('admin_id')) );
	 
    // -- auto notes --- 
	
	$Notes = sprintf("%s - %s", "<b>USER REJECT POD</b>", "APPROVAL POD AUTOMATIC REJECT.");
	
	// --  
	$this->db->reset_write();
	
	$this->db->set('CustomerId',$CustomerId);
	$this->db->set('CallHistoryNotes', $Notes); 
	$this->db->set('CallReasonId',$obval->get_value('CallReasonId')); 
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
	if( $this->db->insert('t_gn_callhistory') ){
		return true;
	}
	
	return FALSE;
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
}

?>