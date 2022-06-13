<?php 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
if( !defined('DEFAULT_ADMIN_ID') ) define('DEFAULT_ADMIN_ID', '30');
if( !defined('DEFAULT_CALL_ID') ) define('DEFAULT_CALL_ID', '99');
if( !defined('DEFAULT_DIS_ID') )  define('DEFAULT_DIS_ID', 'DIS');


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
 class M_ReferalAutomatic extends EUI_Model
{


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
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

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
 
 function __construct() {
	$this->load->model(array('M_SysUser'));
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
 protected function _set_event_automatic_custid( $CustomerNumber = null, $RefId = 0 )
{
	if( is_null($CustomerNumber)){
		return false;
	}
	if( substr($CustomerNumber, 0,2 ) != 'R-'){
		$ar_custid = array("R", $CustomerNumber, $RefId);
	} else {
		$ar_custid = array($CustomerNumber, $RefId);
	}
	return join("-", $ar_custid);
} 


// ---------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 

 protected function _set_event_automatic_stp( $stp = null, $ref_id = 0 )
{
   if( strlen($stp)> 0  )
  {
	 return join("-", array( $stp, $ref_id) );	 
  }
  return $stp;
 
} 
 
 
/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
 protected function _set_event_automatic_recid( $Recsource = null )
{
	if( is_null($Recsource)){
		return false;
	}
	
	if( substr( $Recsource, 0,2 ) != 'R-' ){ 
		$Recsource = array("R", $Recsource);
	} else {
		$Recsource = array($Recsource);
	}
	return join("-", $Recsource);
} 

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 function _select_row_referal_data()
{
	$ar_referal_data = array();
	$this->db->reset_select();
	$this->db->select("
		a.ReferalId,
		a.CustomerId,
		b.CustomerNumber,
		b.CampaignId,
		b.Recsource,
		a.ReferalName,
		a.Phone1,
		a.Phone2,
		a.Phone3,
		a.CreatorId,
		a.CreateDate,
		a.ReferalUpload,
		b.STP", 
	FALSE);
		
	$this->db->from("t_gn_referal a ");
	$this->db->join("t_gn_customer b ","a.CustomerId=b.CustomerId", "LEFT");
	$this->db->where("a.ReferalUpload", 0);
	$this->db->order_by("a.ReferalId", "DESC");
	$this->db->limit(1);
	// $this->db->print_out();
	// exit;
	
	$rs  = $this->db->get();
	if( $rs->num_rows() >  0 ) {
		$ar_referal_data = $rs->result_first_assoc();
	}
	return Objective( $ar_referal_data  );
	
}

 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 function _set_event_process_automatic()
{
 $row = $this->_select_row_referal_data();
 if( !$row->find_value('ReferalId') ){
	print("No record to process ");
	return false;
 }
 
// -- syuser --- 
 $objUsr =& get_class_instance('M_SysUser');
 
// --- default -------------------------- 
 $this->AssignId 	  = 0;
 $this->BucketId 	  = 0;
 $this->CustomerId 	  = 0;
 $this->BucketAssignId  = 0;
 $this->AssignLogId 	= 0;
 
 
// -- ref user by uid --- 
 $User = Objective( $objUsr->_getUserDetail($row->get_value('CreatorId', 'trim')) );
 
 if( !$User->find_value('Username') ){
	return false;
 }
 
 $UploadedById 		= $User->get_value('UserId', 'intval');
 $UserId 			= $User->get_value('UserId', 'intval');
 $Username 			= $User->get_value('Username', 'strval');
 $UserAdminId       = $User->get_value('admin_id', 'intval');
 
 if( !$UserAdminId){
	$UserAdminId = DEFAULT_ADMIN_ID;
 }
 
 $UserManager 		= $User->get_value('mgr_id', 'intval');
 $UserActMgrId 		= $User->get_value('act_mgr', 'intval');
 $UserSpvId 		= $User->get_value('spv_id', 'intval');
 $UserLeaderId 		= $User->get_value('tl_id', 'intval');
 $UserHandling      = $User->get_value('handling_type', 'intval');
 $UserLocation		= $User->get_value('ip_address', 'strval');
 
 
// -- step 1 : upload to bucket  with new ID --

 
 $CustomerNumber		 = $row->get_value('CustomerNumber','trim');
 $CustomerMobilePhoneNum = $row->get_value('Phone2', 'trim');
 $CustomerHomePhoneNum 	 = $row->get_value('Phone1', 'trim');
 $CustomerWorkPhoneNum 	 = $row->get_value('Phone3', 'trim');
 $CustomerUploadedTs 	 = $row->get_value('CreateDate','trim');
 $CustomerFirstName 	 = $row->get_value('ReferalName','strtoupper');
 $ReferalId 		  	 = $row->get_value('ReferalId');
 $Recsource 			 = $row->get_value('Recsource','trim');
 $CampaignId			 = $row->get_value('CampaignId', 'trim');
 $STP					 = $row->get_value('STP', 'trim');
 
 
 
 // --------- on this kontex --------------------------------
 $this->STPref			  = self::_set_event_automatic_stp($STP, $ReferalId);
 $this->RecsourceRef 	  = self::_set_event_automatic_recid($Recsource);
 $this->CustomerNumberRef = self::_set_event_automatic_custid($CustomerNumber, $ReferalId);
 $this->CustomerNumber 	  = $row->get_value('CustomerNumber');
 $this->ReferalId 		  = $row->get_value('ReferalId');
 
 
 
 
 
 // -- next --- 
 
 if( $this->CustomerNumberRef )
 {
	$this->db->reset_write(); // bucket --
	$this->db->set("CustomerNumber", $this->CustomerNumberRef);
	$this->db->set("Recsource", $this->RecsourceRef);
	$this->db->set("STP", $this->STPref);
	$this->db->set("CustomerFirstName", $CustomerFirstName);
	$this->db->set("CustomerHomePhoneNum", $CustomerHomePhoneNum);
	$this->db->set("CustomerMobilePhoneNum", $CustomerMobilePhoneNum);
	$this->db->set("CustomerWorkPhoneNum", $CustomerWorkPhoneNum);
	$this->db->set("UploadedById", $UploadedById);
	$this->db->set("CustomerUploadedTs", $CustomerUploadedTs);
	$this->db->set("AssignCampaign", 1);
	
// --------- on duplicate --  	
	$this->db->duplicate("CustomerUploadedTs", $CustomerUploadedTs);
	$this->db->insert_on_duplicate("t_gn_bucket_customers");
	if( $this->db->affected_rows() > 0 ){
		$this->BucketId = $this->db->insert_id();
	}
	
// --- step 2 :  set dis bucket campaign  --- 
	if( !$this->BucketId ){
		printf("Failed insert to %s \n err: %s \n", "t_gn_bucket_customers", mysql_error() );	
	}
	
	if( $this->BucketId ) 
	{
		$this->db->reset_write(); // bucket --
		$this->db->set("CustomerBucketId", $this->BucketId);
		$this->db->set("CustomerCampaignId",$CampaignId);
		$this->db->set("CreatedDateTs", $CustomerUploadedTs);
		$this->db->set("CreateUserId", $UploadedById);
		$this->db->insert("t_gn_bucket_assigment");
		
		// -- update bucket ---- 
		
		if( $this->db->affected_rows() > 0 ) 
		{
			$this->BucketAssignId = $this->db->insert_id();
			$this->db->query( sprintf("
				UPDATE t_gn_bucket_customers a 
					SET a.AssignCampaign=1 
				WHERE a.CustomerId='%s'", $this->BucketId));
		}
	}
	
// -- to data customer generatId 	

	if( !$this->BucketAssignId ){
		printf("Failed insert to %s \n err: %s \n", 
			   "t_gn_bucket_assigment", mysql_error() );	
	}
	
	if( $this->BucketAssignId )
	{
		$this->db->reset_write(); // bucket --
		$this->db->set("CustomerNumber", $this->CustomerNumberRef);
		$this->db->set("Recsource", $this->RecsourceRef);
		$this->db->set("STP", $this->STPref);
		$this->db->set("CampaignId", $CampaignId);
		$this->db->set("CustomerFirstName", $CustomerFirstName);
		$this->db->set("CustomerHomePhoneNum", $CustomerHomePhoneNum);
		$this->db->set("CustomerMobilePhoneNum", $CustomerMobilePhoneNum);
		$this->db->set("CustomerWorkPhoneNum", $CustomerWorkPhoneNum);
		$this->db->set("UploadedById", $UploadedById);
		$this->db->set("CustomerUploadedTs", $CustomerUploadedTs);
		$this->db->set("Agent", $Username);
		
		$this->db->insert("t_gn_customer");
		
		if( $this->db->affected_rows() > 0 )  {
			$this->CustomerId = $this->db->insert_id();
			$this->db->reset_write();
			$this->db->set("RecSourceName",$this->RecsourceRef);
			$this->db->set("RecSourceDesc",$this->RecsourceRef);
			$this->db->set("RecSourceCreateTs", date('Y-m-d H:i:s'));
			$this->db->set("RecSourceFlags",1);
			$this->db->duplicate("RecSourceUpdateTs", date('Y-m-d H:i:s'));
			$this->db->insert_on_duplicate("t_lk_recsource");
		}
	}
	
// --- t_gn_assignment 	--------------------------
	if( !$this->CustomerId ){
		printf("Failed insert to %s \n err: %s \n", "t_gn_customer", mysql_error() );	
		return false;
	}
	
	if( $this->CustomerId )
	{
		$this->db->reset_write(); // bucket --
		$this->db->set("CustomerId", $this->CustomerId );
		$this->db->set("AssignAdmin",$UserAdminId);
		$this->db->set("AssignAmgr",$UserActMgrId);
		$this->db->set("AssignLeader",$UserLeaderId);
		$this->db->set("AssignSelerId",$UserId);
		$this->db->set("AssignDate",$CustomerUploadedTs);
		$this->db->set("AssignMgr",0);
		$this->db->set("AssignSpv",0);
		$this->db->insert("t_gn_assignment");
		
		// -- to assign_log -- 
		
		if( $this->db->affected_rows() > 0 )  
		{
			$this->AssignId = $this->db->insert_id();	
			
			$this->db->reset_write(); // assign log--
			$this->db->set("AssignId",$this->AssignId);
			$this->db->set("CustomerId",$this->CustomerId);
			$this->db->set("AssignAdmin",$UserAdminId);
			$this->db->set("AssignAmgr",$UserActMgrId);
			$this->db->set("AssignLeader",$UserLeaderId);
			$this->db->set("AssignSelerId",$UserId);
			$this->db->set("AssignDate",$CustomerUploadedTs);
			$this->db->set("AssignById",$UserId);
			$this->db->set("AssignLocation",$UserLocation);
			$this->db->set("CallReasonId", DEFAULT_CALL_ID );
			$this->db->set("AssignMode",DEFAULT_DIS_ID);
			$this->db->insert("t_gn_assignment_log");
			
			if( $this->db->affected_rows() > 0 ){
				$this->AssignLogId = $this->db->insert_id();
			}
		}
	}
 }
 
 
 if( ! $this->AssignId ) { 
	printf("Failed insert to %s \n err: %s \n", "t_gn_assignment_log", mysql_error());	
	return false;
}

// --- update --- tgn referal 
 
 $this->db->reset_write();
 $this->db->set("RecsourceRef", $this->RecsourceRef);
 $this->db->set("CustomerNumberRef", $this->CustomerNumberRef);
 $this->db->set("CustomerNumber", $this->CustomerNumber);
 $this->db->set("CustomerIdRef", $this->CustomerId);
 $this->db->set("ReferalName", $CustomerFirstName);
 $this->db->set("Recsource", $Recsource);
 $this->db->set("CampaignId", $CampaignId);
 $this->db->set("ReferalUploadTs", $CustomerUploadedTs);
 $this->db->set("ReferalUpload", 1);
 $this->db->where("ReferalId", $this->ReferalId);
 $this->db->update("t_gn_referal");
 
 // -- return its -- 
 return $this;
 
 
} // stop ---



// =================== END CLASS ====================
}

// =================== END FILE ====================
?>