<?php
/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
class M_ModApprovePhone extends EUI_Model 
{

/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 var $arr_status = array( 0=> 'Reject', 1=> 'Approve', 2=> 'Request');
 var $set_limit_page = 10;
 
/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
  private static $Instance = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }
 
/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
  function __construct() {
	$this->load->model(array('M_UserRole','M_SrcCustomerList'));
  }
  
/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _get_default()
{
	
// panggil semua fungsi untuk mempersingkat process 
	$out = UR();  $cok = CK();
	
	
//  membuat object pager untuk Process Paging 
// disisi server maupun client 
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
 $this->EUI_Page->_setCount(true);
 $this->EUI_Page->_setSelect("count(a.ApprovalHistoryId) as tot", false);
 $this->EUI_Page->_setFrom("t_gn_approvalhistory a");
 $this->EUI_Page->_setJoin("t_gn_customer_master b "," a.CustomerId=b.DM_Id", "LEFT");
 $this->EUI_Page->_setJoin("t_lk_approvalitem c "," a.ApprovalItemId=c.ApprovalItemId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_campaign g", "b.DM_CampaignId=g.CampaignId", "LEFT");
 $this->EUI_Page->_setJoin("t_gn_assignment e "," a.CustomerId=e.AssignCustId", "LEFT"); 
 $this->EUI_Page->_setJoin("tms_agent f "," a.CreatedById=f.UserId", "LEFT", true);
  
 
 
// secara default data yang di munculkan adalah data dengan status 
// "REQUEST", "APPROVE", "REJECT" Untuk Semua Level User.
// jika ingin dibedakan silahkan tambahkan filter tersebut pada
// tiap2 level user.
  
  $this->EUI_Page->_setWhereIn("a.ApprovalApprovedFlag", array('0','1','2'));
// session user filter 
// USER_ADMIN
  if( $cok->cookie(array( USER_ADMIN,  USER_ROOT) )) {
   $this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL", FALSE );
  }
 // USER_ACCOUNT_MANAGER
  if( $cok->cookie(array( USER_ACCOUNT_MANAGER ))) {
    $this->EUI_Page->_setAnd("e.AssignAmgr", $cok->field('UserId'));
  }	
 // USER_MANAGER
   if( $cok->cookie( array( USER_MANAGER ) ) ) {
    $this->EUI_Page->_setAnd("e.AssignMgr",$cok->field('UserId'));
  }	
  // SUPERVISOR
  // var_dump($cok->cookie(array( USER_SUPERVISOR )));
  if( $cok->cookie(array( USER_SUPERVISOR ))) {
	if( in_array(SPVADF, $cok->field('UserRole')  )){
		$this->EUI_Page->_setAnd('f.spv_id', $cok->field('UserId'));
	} 
	
	if( in_array(SPV1, $cok->field('UserRole')  )){
		$this->EUI_Page->_setAnd('e.AssignSpv', $cok->field('UserId'));
	}  
  }	
 // USER_LEADER
  if( $cok->cookie(array( USER_LEADER ) )) {
     $this->EUI_Page->_setAnd("e.AssignLeader",$cok->field('UserId'));
  }	
  // USER_AGENT_INBOUND
  if( $cok->cookie(array( USER_AGENT_INBOUND, USER_AGENT_OUTBOUND) )) {
	$this->EUI_Page->_setAnd("e.AssignSelerId",$cok->field('UserId'));
  }	
  
 // set filte post vars  --------------------------
 /* FIELD :
			[ADD1_filter_value] => sas
            [ADD2_filter_value] => asas
            [DM_ContactCreateTs_start_date] => 07-09-2017
            [DM_ContactCreateTs_end_date] => 13-09-2017
            [ADD1_filter_field] => d.CampaignDesc
            [DM_ContactType] => 1
            [DM_ContactReqByUser] => 38
            [ADD2_filter_field] => d.CampaignDesc
            [DM_ContactStatus] => 1
 */
 
 $this->EUI_Page->_setAndCache("a.ApprovePhoneType", 'DM_ContactType', TRUE);
 $this->EUI_Page->_setAndCache("a.ApprovalApprovedFlag", 'DM_ContactStatus', TRUE);
 $this->EUI_Page->_setAndCache("a.CreatedById", 'DM_ContactReqByUser', TRUE);
 $this->EUI_Page->_setBeginCache("a.ApprovalCreatedTs", 'DM_ContactCreateTs_start_date', TRUE);
 $this->EUI_Page->_setStopCache("a.ApprovalCreatedTs", 'DM_ContactCreateTs_end_date', TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'ADD1_filter_field', 'ADD1_filter_value', TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'ADD2_filter_field', 'ADD2_filter_value', TRUE);
	
 
 // echo $this->EUI_Page->_getCompiler();
 //------------------------------------------------------------------------------
 return $this->EUI_Page;
 
	
 }
/*
 * [Recovery data failed upload <@PROJECT_ID>]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _get_content() {
	 
// panggil semua fungsi untuk mempersingkat process 
	$out = UR();  $cok = CK();
	
//  membuat object pager untuk Process Paging 
// disisi server maupun client 

	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage( DEFAULT_COUNT_PAGE);
	
	$this->EUI_Page->_setArraySelect(array(
		"a.ApprovalHistoryId as ApprovalHistoryId" 		=> array("ApprovalHistoryId", 	"ApprovalHistoryId", "primary"),
		"b.DM_CampaignId AS DM_CampaignId" 				=> array("DM_CampaignId",	  	"DM_CampaignId"),
	///	"b.DM_Recsource as DM_Recsource" 				=> array("DM_Recsource",	  	"DM_Recsource"),
		"b.DM_Custno as DM_Custno" 						=> array("DM_Custno",		  	"DM_Custno"),
		"b.DM_FirstName as DM_FirstName" 				=> array("DM_FirstName",	  	"DM_FirstName"),
		"a.ApprovalNewValue as DM_ContactNumber" 		=> array("DM_ContactNumber",  	"DM_ContactNumber"),
		"a.CreatedById as DM_ContactReqByUser"			=> array("DM_ContactReqByUser", "DM_ContactReqByUser"),
		"a.ApprovePhoneType as DM_ContactType" 			=> array("DM_ContactType",	  	"DM_ContactType"),
		"a.ApprovalApprovedFlag as DM_ContactStatus"	=> array("DM_ContactStatus",	 "DM_ContactStatus"),
		"a.ApprovalCreatedTs as DM_ContactCreateTs" 	=> array("DM_ContactCreateTs",  "DM_ContactCreateTs")
		
	));
	
  $this->EUI_Page->_setFrom("t_gn_approvalhistory a");
  $this->EUI_Page->_setJoin("t_gn_customer_master b "," a.CustomerId=b.DM_Id", "LEFT");
  $this->EUI_Page->_setJoin("t_lk_approvalitem c "," a.ApprovalItemId=c.ApprovalItemId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_campaign g", "b.DM_CampaignId=g.CampaignId", "LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment e ","a.CustomerId=e.AssignCustId", "LEFT" ); 
  $this->EUI_Page->_setJoin("tms_agent f "," a.CreatedById=f.UserId", "LEFT", true);
  
// secara default data yang di munculkan adalah data dengan status 
// "REQUEST", "APPROVE", "REJECT" Untuk Semua Level User.
// jika ingin dibedakan silahkan tambahkan filter tersebut pada
// tiap2 level user.
  
  $this->EUI_Page->_setWhereIn("a.ApprovalApprovedFlag", array('0','1','2'));
// session user filter 
// USER_ADMIN
  if( $cok->cookie(array( USER_ADMIN,  USER_ROOT) )) {
   $this->EUI_Page->_setAnd("e.AssignAdmin IS NOT NULL", FALSE );
  }
 // USER_ACCOUNT_MANAGER
  if( $cok->cookie(array( USER_ACCOUNT_MANAGER ))) {
    $this->EUI_Page->_setAnd("e.AssignAmgr", $cok->field('UserId'));
  }	
 // USER_MANAGER
   if( $cok->cookie( array( USER_MANAGER ) ) ) {
    $this->EUI_Page->_setAnd("e.AssignMgr",$cok->field('UserId'));
  }	
   // SUPERVISOR
  // var_dump($cok->cookie(array( USER_SUPERVISOR )));
  if( $cok->cookie(array( USER_SUPERVISOR ))) {
	if( in_array(SPVADF, $cok->field('UserRole')  )){
		$this->EUI_Page->_setAnd('f.spv_id', $cok->field('UserId'));
	} 
	
	if( in_array(SPV1, $cok->field('UserRole')  )){
		$this->EUI_Page->_setAnd('e.AssignSpv', $cok->field('UserId'));
	}  
  }
 // USER_LEADER
  if( $cok->cookie(array( USER_LEADER ) )) {
     $this->EUI_Page->_setAnd("e.AssignLeader",$cok->field('UserId'));
  }	
  // USER_AGENT_INBOUND
  if( $cok->cookie(array( USER_AGENT_INBOUND, USER_AGENT_OUTBOUND) )) {
	$this->EUI_Page->_setAnd("e.AssignSelerId",$cok->field('UserId'));
  }	
  
 //  set filte post vars  --------------------------
 $this->EUI_Page->_setAndCache("a.ApprovePhoneType", 'DM_ContactType', TRUE);
 $this->EUI_Page->_setAndCache("a.ApprovalApprovedFlag", 'DM_ContactStatus', TRUE);
 $this->EUI_Page->_setAndCache("a.CreatedById", 'DM_ContactReqByUser', TRUE);
 $this->EUI_Page->_setBeginCache("a.ApprovalCreatedTs", 'DM_ContactCreateTs_start_date', TRUE);
 $this->EUI_Page->_setStopCache("a.ApprovalCreatedTs", 'DM_ContactCreateTs_end_date', TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'ADD1_filter_field', 'ADD1_filter_value', TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'ADD2_filter_field', 'ADD2_filter_value', TRUE);
 
// set order data field  
	
 if( !$out->find_value('order_by')){
	$this->EUI_Page->_setOrderBy('a.ApprovalHistoryId','DESC');
 } else {
	$this->EUI_Page->_setOrderBy( $out->field('order_by'), $out->field('type'));
 }
 
// set limit page 
	
	// echo $this->EUI_Page->_getCompiler();
	$this->EUI_Page->_setLimit(); 
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _get_resource()
 {
	self::_get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _get_page_number() 
 {
	
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _getApproveItem()
 {
	$_conds = array();
	
	$this -> db->select('*');
	$this -> db->from('t_lk_approvalitem');
	
	foreach( $this -> db->get()->result_assoc() as $rows )
	{
		$_conds[$rows['ApprovalItemId']] = $rows['ApprovalItem'];
	}
	
	return $_conds;
	
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _update_row_item_approval( $out =null )
{
 
 // check data tersebut apakah benar2 
 // object 
 $cok = CK();
 if( !is_object( $out ) ){
	return false; 
 }
 
 // then will clear cache 
 $this->db->reset_write();
 $this->db->where("ApprovalHistoryId", $out->field('ApproveItemId') );
 $this->db->set("ApprovalApprovedFlag",$out->field('ApprovalStatus'));
 if( $this->db->update('t_gn_approvalhistory') )
 { 

// ambil row detail -nya untuk update ke table history dan customer 
// untuk di catat log. -nya 
  
	$obDts = $this->_select_row_call_history( $out->field('CustomerId') );
	$obItm = $this->_select_row_item_detail( $out->field('ApproveItemId') );
	

// Jika status Approve maka data Di masukan 
// ke " t_gn_addphone " 

	$this->db->reset_write();
	$this->db->set("CustomerId",  $obItm->field('CustomerId'));
	$this->db->set("AddPhoneType", $obItm->field('ApprovePhoneType')); 
	$this->db->set("AddPhoneNumber", $obItm->field('ApprovalNewValue'));
	$this->db->set("AddPhoneApproveId", $obItm->field('ApprovalHistoryId'));
	$this->db->insert("t_gn_addphone");
	
// jika data bernilai object lakukan fetch data 
// dengan object 
	if( $obItm->field('CustomerId') ) {
		
	//ambil semua data object yang terkait process update ini.	
		$obOut  = Singgleton('M_SysUser'); //model user 
		$dtOut  = Singgleton('M_SrcCustomerList'); // model data 
		
		
	// ambil attribute data master 	
		$obDta = Objective( $dtOut->_select_row_master_detail( $out->field('CustomerId') ));
		
	// ambil attribute data user 
		
		$obUsr = Objective( $obOut->_getUserDetail( $cok->field('UserId')));
		//debug($obUsr);
		$obTls = Objective( $obOut->_getUserDetail( $obUsr->field('tl_id')));
		$obAtm = Objective( $obOut->_getUserDetail( $obUsr->field('spv_id')));
		
	// push data ke model Object 
	//$rowItem =  new EUI_Object(); // buat object baru .
	
		$obItm->add('CallHistoryNotes', sprintf( "USER APPROVE ADD PHONE - WITH STATUS < <strong>%s</strong> ><br>PHONE NUMBER : < <strong>%s</strong> ><br><b>NOTES</b>: <  %s  >", 
												  $this->_select_row_status_item($out->field('ApprovalStatus')),
												  $obItm->field('ApprovalNewValue', 'SetMasking'), 
												  ucfirst($out->field('ContactRemarks','strtolower')) ));
		
		$obItm->add('CustomerId', 	  $obItm->field('CustomerId'));
		$obItm->add('CallCategoryId', $obDta->field('DM_LastCategoryId'));
		$obItm->add('CallReasonId',   $obDta->field('DM_LastReasonId'));
		$obItm->add('CreatedById',    $obUsr->field('UserId'));
		$obItm->add('AgentCode', 	  $obUsr->field('Username'));
		$obItm->add('SPVCode', 		  $obTls->field('Username'));
		$obItm->add('ATMCode', 		  $obAtm->field('Username'));
		$obItm->add('HistoryType',    CHANGE_ACTIVITY);
		$obItm->add('DateTs', 		  date('Y-m-d H:i:s'));
		$obItm->add('CallSessionId',  0);
		
	// end then will insert on history Process 
	// with data proces its.
	
		$this->db->reset_write();	
		$this->db->set("CustomerId", $obItm->field('CustomerId','strtoupper')); 
		$this->db->set("CallSessionId", $obItm->field('CallSessionId','strtoupper'));
		$this->db->set("CallCategoryId", $obItm->field('CallCategoryId','strtoupper'));
		$this->db->set("CallReasonId", $obItm->field('CallReasonId','strtoupper'));
		$this->db->set("CallNumber", $obItm->field('ApprovalNewValue','strtoupper'));
		$this->db->set("CreatedById", $obItm->field('CreatedById','strtoupper'));
		$this->db->set("UpdatedById", $obItm->field('CreatedById','strtoupper'));
		$this->db->set("AgentCode", $obItm->field('AgentCode','strtoupper')); 
		$this->db->set("SPVCode", $obItm->field('SPVCode','strtoupper')); 
		$this->db->set("ATMCode", $obItm->field('ATMCode','strtoupper')); 
		$this->db->set("ApprovalStatusId", $obItm->field('ApprovalApprovedFlag','strtoupper'));
		$this->db->set("HistoryType", $obItm->field('HistoryType','strtoupper'));
		$this->db->set("CallHistoryCreatedTs", $obItm->field('DateTs','strtoupper'));
		$this->db->set("CallHistoryUpdatedTs", $obItm->field('DateTs','strtoupper'));
		$this->db->set("CallHistoryNotes", $obItm->field('CallHistoryNotes'));
		$this->db->insert("t_gn_callhistory");
		//debug($this->db->last_query());
		
		
	// update table master jika di perlukan .
	
		// $this->db->reset_write();
		// $this->db->set("UpdatedById",_get_session('UserId'));
		// $this->db->set("CustomerUpdatedTs", date('Y-m-d H:i:s'));
		// $this->db->where("CustomerId", $out->get_value('CustomerId'));
		// $this->db->update("t_gn_customer");
		
		
	}
	
	return TRUE;
	
 }	else {
	 return FALSE;
 } 
 
 }
 
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_row_status_item( $sts = 0 ) {
	$sts = (int)$sts;
	return (string)$this->arr_status[$sts];
}
 
  /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_row_form_action( $uid = null ){
	 $uid = get_class($uid); 
	 if( is_null( $uid ) ){
		 return null;
	 }
	 // return data array process on object 
	 //var_dump($uid);
	 $result_array = $this->M_UserRole->_select_role_form_action( $uid );
	 return new EUI_Object($result_array);
 } 
 
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _select_row_call_history( $CustomerId = 0 ) 
{
 $this->db->reset_select();
 $this->db->select("*", false);
 $this->db->from("t_gn_callhistory a ");
 $this->db->where("a.CustomerId", $CustomerId);
 $this->db->where_not_in("a.CreatedById",array(_get_session('UserId')));
 $this->db->order_by("a.CallHistoryId","DESC");
 $this->db->limit(1);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	return Objective( $rs->result_first_assoc() );
} else{
	return Objective( array() );
 }
 
} 

 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_row_item_detail( $ApprovalHistoryId = 0 ) 
{
 $this->db->reset_select();
 $this->db->select("*", false);
 $this->db->from("t_gn_approvalhistory a ");
 $this->db->join("t_lk_phonetype b", "a.ApprovePhoneType=b.PhoneType", "LEFT");
 $this->db->where("a.ApprovalHistoryId", $ApprovalHistoryId);

 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	return Objective( $rs->result_first_assoc() );
} else{
	return Objective( array() );
 }
 
} 
 
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_row_customer_data( $ApprovalHistoryId  = 0 )
{
	if( !$ApprovalHistoryId ){
		return false;
	}
	
// --- next process  ------------------------------------
	
	$arr_result  = 0;
	$this->db->reset_select();
	$this->db->select('a.CustomerId', false);
	$this->db->from('t_gn_approvalhistory a');
	$this->db->where('a.ApprovalHistoryId',$ApprovalHistoryId);
	
	$rs  = $this->db->get();
	if( $rs->num_rows() > 0 )
	{
		$arr_result =(int)$rs->result_singgle_value();
	}
	
	return (int)$arr_result;
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _getPhoneTypeIdByName( $Name = null ) 
 {
	$this ->db ->select('a.PhoneTypeId');
	$this ->db ->from('t_lk_phonetype a ');
	$this ->db ->where('a.PhoneField', $Name);
	
	if( $rows = $this ->db ->get() -> result_first_assoc() )
	{
		return $rows['PhoneTypeId'];
	}
	else
		return null;
 }
 /*
  * [_SaveSubmitPhone]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _submit_row_item_contact( $out = null )
{
 // nilai default untuk process 

  $this->callBackMsg  = 0;
  $this->callBackContinue = 0;
 
 // cek data 
 $cok = CK();
 
 // add FIELD data process 
 
  $out->add('CreatedById', $cok->field('UserId'));
  $out->add('ApprovalItemId', ADDITIONAL_PHONE);
  $out->add('ApprovalApprovedFlag',CHANGE_REQUEST );
  $out->add('ApprovalCreatedTs', date('Y-m-d H:i:s') );
   
 // masukan data ke t_gn_addphone 
  
  $this->db->reset_write();
  $this->db->set('CustomerId', $out->field('CustomerId') );
  $this->db->set('CreatedById', $out->field('CreatedById')); 
  $this->db->set('ApprovalOldValue', $out->field('ContactNumber'));
  $this->db->set('ApprovalNewValue', $out->field('ContactNumber'));
  $this->db->set('ApprovePhoneType', $out->field('ContactType'));
  $this->db->set('ApprovalItemId', $out->field('ApprovalItemId'));
  $this->db->set('ApprovalApprovedFlag', $out->field('ApprovalApprovedFlag'));
  $this->db->set('ApprovalCreatedTs', $out->field('ApprovalCreatedTs'));
  
  // insert data to table tmp 
  $this->db->insert('t_gn_approvalhistory');
  
  if( $this->db->affected_rows() > 0 ) {
	$this->callBackContinue++;
  }
  
  // jika duplikasi  printf("%s", mysql_errno());
  
  if( !strcmp(mysql_errno(), '1062' )){ 
	$this->callBackContinue++;
 }
 
 // return false jika tidak benar .	
  if( !$this->callBackContinue ){
	 return false;
  }
 
 // kemudian masukan ke history. 
	return $this->callBackContinue;
 }
 /*
  * [Recovery data failed upload <@PROJECT_ID>]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_row_approval_item( $ApprovalHistoryId = 0 )
 {
	$this->result_array = array(); 
	$sql = sprintf(" SELECT a.*, d.*
				FROM t_gn_approvalhistory a
				LEFT JOIN t_gn_customer_master b ON a.CustomerId=b.DM_Id
				LEFT JOIN t_lk_approvalitem c ON a.ApprovalItemId=c.ApprovalItemId
				LEFT JOIN tms_agent d ON a.CreatedById=d.UserId
				LEFT JOIN t_gn_assignment e ON a.CustomerId=e.AssignCustId
				WHERE a.ApprovalHistoryId ='%s'", $ApprovalHistoryId );
	//debug($sql);			
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ){
		$this->result_array = $qry->result_first_assoc();
	}
	return (array)$this->result_array;
 }
  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 // ============================ END CLASS ============================================== 
}
?>