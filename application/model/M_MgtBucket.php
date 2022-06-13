<?php
/*
 * E.U.I 
 *
 
 * subject	: get M_MgtBucket modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 

class M_MgtBucket extends EUI_Model
{
	
var $arr_clean = array('CustomerId');

// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
 
 private static $Instance = null;
 public static function &Instance()
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  
  return self::$Instance; 
}	
	
// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
	
 public function  __construct()
{
  $this->load->model(array (
	 'M_ModDistribusi',
	 'M_ModViewUpload',
	 'M_SetCampaign',
	 'M_Template',
	 'M_WorkArea', 
	 'M_Upload',
	 'M_SysUser',
	 'M_User'
   ));
}
	
// -----------------------------------------------------------

/*
 * @ package  	 _get_default() 
 * -----------------------------------------------------------
 * @ notes 		constructor 
 */	
 
 public function _get_default()
{
	$this->EUI_Page->_setPage(20);
	$this->EUI_Page->_setSelect("a.CustomerId");
	$this->EUI_Page->_setFrom("t_gn_bucket_customers a", TRUE);
	
// --------- filter default  ----------------------------	
	$this->EUI_Page->_setAnd("a.CustomerDeleted", 0);	

// --------- filter default  ----------------------------	
	$this->EUI_Page->_setAndCache("a.AssignCampaign", "bucket_assign_status", TRUE);
	$this->EUI_Page->_setAndCache("a.FTP_UploadId", "bucket_file_id", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCity", "city", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCardType", "card_type", TRUE);
	$this->EUI_Page->_setWhereinCache("a.CustomerZipCode", "work_branch", TRUE);
	
	return $this->EUI_Page;
}

/*
 * EUI :: _get_content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */		
 
 public function _get_content()
{
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(20);
	$this->EUI_Page->_setArraySelect(array(
		"a.CustomerId As CustomerId" => array("CustomerId","CustomerId","primary"),
		//"a.CustomerNumber as CustomerNumber" => array("CustomerNumber","CIF"), 
		"a.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName","Customer Name"), 
		"a.CustomerCity as CustomerCity" => array("CustomerCity","City"), 
		"b.Gender as Gender" => array("Gender","Gender"),
		"YEAR(CURRENT_TIMESTAMP)-YEAR(a.CustomerDOB)-(RIGHT(CURRENT_TIMESTAMP, 5)<RIGHT(a.CustomerDOB, 5)) as Ages" => array("Ages","Age"), 
		//"a.CustomerDOB as CustomerAge" => array("CustomerAge", "Age"),
		
		//"a.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"), 
		//"a.CustomerAddressLine1 as CustomerAddressLine1" => array("CustomerAddressLine1","Address"), 
		//"a.CustomerHomePhoneNum as CustomerHomePhoneNum" => array("CustomerHomePhoneNum","Phone 1"), 
		//"a.CustomerMobilePhoneNum as CustomerMobilePhoneNum" => array("CustomerMobilePhoneNum","Phone 2"), 
		//"a.CustomerWorkPhoneNum as CustomerWorkPhoneNum" => array("CustomerWorkPhoneNum","Phone 3"), 
		//"a.CustomerZipCode as CustomerZipCode" => array("CustomerZipCode","Zip Code"), 
		//"a.CustomerUploadedTs as CustomerUploadedTs" => array("CustomerUploadedTs","Upload Date"), 
		
		"IF(a.AssignCampaign=1, 'YES','NO') as AssignCampaign" => array("AssignCampaign","Assign Status"),
		"(  select group_concat(b.CampaignDesc separator '<br>' ) as cmp 
			from t_gn_bucket_assigment a INNER JOIN t_gn_campaign b on a.CustomerCampaignId=b.CampaignId 
			where a.CustomerBucketId = a.CustomerId) as OnCampaignId" => array("OnCampaignId", "Campaign Name")
			
		/* "( select tc.CallReasonDesc 
			from t_gn_customer ts inner join t_lk_callreason tc on ts.CallReasonId=tc.CallReasonId 
			where ts.CustomerNumber =a.CustomerNumber ) As CallResult" => array("CallResult", "Call Result")	*/
				
	));
	
	$this->EUI_Page->_setFrom("t_gn_bucket_customers a");
	$this->EUI_Page->_setJoin("t_lk_gender b "," a.GenderId=b.GenderId", "LEFT", true);
	
// --------------- set data filtering -------------------------------------------
	$this->EUI_Page->_setAnd("a.CustomerDeleted", 0);	
	$this->EUI_Page->_setAndCache("a.AssignCampaign", "bucket_assign_status", TRUE);
	$this->EUI_Page->_setAndCache("a.FTP_UploadId", "bucket_file_id", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCity", "city", TRUE);
	$this->EUI_Page->_setLikeCache("a.CustomerCardType", "card_type", TRUE);
	$this->EUI_Page->_setWhereinCache("a.CustomerZipCode", "work_branch", TRUE);

	
// set order 
	
	if( _get_have_post('order_by')){ 
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
	} else {
		$this->EUI_Page->_setOrderBy('a.CustomerId','ASC');	
	}	
	//echo $this->EUI_Page->_getCompiler();
	
	$this->EUI_Page->_setLimit();
}	

 // ----------------------------------------------------------------------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='')
	{
		//echo $this -> EUI_Page -> _get_query();
		return $this -> EUI_Page -> _result();
	}	
 }
 
// ----------------------------------------------------------------------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 
function _get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
 // ----------------------------------------------------------------------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function _get_template()
 {
	$_conds= array();
	$this -> load -> model(array('M_SetUpload'));
	if(class_exists('M_SetUpload') )
	{
		$_conds = $this -> M_SetUpload -> _get_ready_template();
	}
	
	return $_conds;
 }
 
 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 protected function _select_row_field_bucket(){
	return $this->db->list_fields('t_gn_bucket_customers');
 }
 
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 protected function _select_row_field_customer(){
	 return $this->db->list_fields('t_gn_customer');
 }
 
 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 protected function _select_row_field_map()
{
  $this->arr_field = array();
  $this->arr_bucket = $this->_select_row_field_bucket();
  $this->arr_customer = $this->_select_row_field_customer();
  
  if( is_array($this->arr_bucket) ) 
	foreach( $this->arr_bucket as $k => $field ) 
  {
	if( in_array($field, $this->arr_customer) )
	{
		$this->arr_field[$field] = $field;
	}		
  }
  
  return (array)$this->arr_field;
  
} 

 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 protected function _select_row_user_admin_level()
{
	$out =& get_class_instance('M_SysUser');
	$arr_row_admin = $out->_get_administrator();
	
	if( is_array($arr_row_admin) and 
		count( $arr_row_admin ) > 0 ) {
		return 	reset(array_keys($arr_row_admin));
	}
	return FALSE;
} 
 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function _set_row_buket_quantity( $out = null )
{
	
// --- get object class User -- 

	$AssignAdmin = $this->_select_row_user_admin_level();
	$SysUser 	 = get_class_instance('M_SysUser');
	$ObjUser 	 = Objective( $SysUser->_getUserDetail( _get_session('UserId') ));
	
// --- get default array User -- 

	$arr_assign_data = array();
	$arr_call_back = array('tot_asign' => 0, 'tot_duplicate' => 0 );
	
	
	$ar_num = 0;
	$num_dup = 0;
	
	if( $out->get_value('frm_bucket_user_quantity','intval') > $out->get_value('frm_bucket_user_total','intval') )
	{
		return ( int )$ar_num;	
	} 
	
   // ------------------ select page --------------------------------------------------
   
	$ar_row = $this->_select_row_bucket_page($out, $this->_select_row_field_map());
	if( is_array($ar_row) ){
		$ar_row = array_slice($ar_row, 0, $out->get_value('frm_bucket_user_quantity','intval'));
	}
	
	if( is_array($ar_row) ) 
		foreach( $ar_row as $key => $arr_val )
	{
		$Obj =& Objective( $arr_val );
		unset($arr_val['CustomerId'] ); // clean 
		
	// -------------- mmerge data --------------------------------------
	
		$arr_val = array_merge( $arr_val, array(
			'CampaignId' => $out->get_value('frm_bucket_user_campaign'),
			'Agent' => _get_session('Username','strtoupper')
		));
		
		
	// -------- insert into db customer then assignment --------------------
		$this->db->reset_write();
		$this->db->insert("t_gn_customer", $arr_val );
		
		if( $this->db->affected_rows() > 0 
			AND ($CustomerId = $this->db->insert_id()) )
		{
			// ---------------" t_gn_bucket_customers "---------------------------
			
			$this->db->reset_write();
			$this->db->where("CustomerId", $Obj->get_value('CustomerId'));
			$this->db->set("AssignCampaign", 1);
			$this->db->update("t_gn_bucket_customers");
			
			// ------- trans "t_gn_bucket_assigment" --------
			
			$this->db->reset_write();
			$this->db->set("CustomerBucketId", $Obj->get_value('CustomerId'));
			$this->db->set("CustomerCampaignId", $Obj->get_value('CampaignId'));
			$this->db->set("CreateUserId", _get_session('UserId'));
			$this->db->set("CreatedDateTs", date('Y-m-d H:i:s'));
			$this->db->insert("t_gn_bucket_assigment");
			
			// ------- trans "t_gn_assigment" --------------
			
			$this->db->reset_write();
			$this->db->set("CustomerId", $CustomerId);
			
			// -- root / admin   
			if( @in_array(_get_session('HandlingType'), 
				array(USER_ROOT, USER_ADMIN )) )
			{
				$this->db->set("AssignAdmin", _get_session('UserId'));
			}
			
			// Act Manger 
			if( @in_array( _get_session('HandlingType'), 
				array(USER_ACCOUNT_MANAGER)))
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", _get_session('UserId'));
			}
			
			// Manager 
			if( @in_array(_get_session('HandlingType'), 
				array(USER_MANAGER)) )
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", $ObjUser->get_value('act_mgr'));
				$this->db->set("AssignMgr", $ObjUser->get_value('UserId'));
			}
			
		// -- atm / spv -- 	
			if( @in_array(_get_session('HandlingType'), 
				array(USER_SUPERVISOR)) )
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", $ObjUser->get_value('act_mgr'));
				$this->db->set("AssignMgr", $ObjUser->get_value('mgr_id'));
				$this->db->set("AssignSpv", $ObjUser->get_value('UserId'));
			}
			
		// -- atm / leader -- 		
		
			if( @in_array(_get_session('HandlingType'), 
				array(USER_LEADER)) )
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", $ObjUser->get_value('act_mgr'));
				$this->db->set("AssignMgr", $ObjUser->get_value('mgr_id'));
				$this->db->set("AssignSpv", $ObjUser->get_value('spv_id'));
				$this->db->set("AssignLeader", $ObjUser->get_value('UserId'));
			}
			
			// ---------- then set it  ----------------------
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->insert("t_gn_assignment");
			
			if( $this->db->affected_rows() > 0 ) {
				$ar_num++;
			}
		} else{
			$num_dup++;
		}	
	}	
	
	
// -- return data success -- 	
	$arr_call_back = array(
		'tot_asign' => $ar_num, 
		'tot_duplicate' => $num_dup 
	);
	
	return $arr_call_back;
	
} 

 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 function _set_row_buket_checked( $out = null  )
{
	// --- get object class User -- 

	$AssignAdmin = $this->_select_row_user_admin_level();
	//var_dump($AssignAdmin);
	
	$SysUser 	 = get_class_instance('M_SysUser');
	$ObjUser 	 = Objective( $SysUser->_getUserDetail( _get_session('UserId') ));
	
	// --- then is num --- 
	$arr_call_back = array('tot_asign' => 0, 'tot_duplicate' => 0 );
	$ar_num = 0;
	$num_dup = 0;
	
	if( $out->get_value('frm_bucket_user_quantity','intval') > $out->get_value('frm_bucket_user_total','intval') )
	{
		return ( int )$ar_num;	
	} 
	
   // ------------------ select page --------------------------------------------------
   
	$ar_row = $this->_select_row_bucket_page($out, $this->_select_row_field_map());
	//print_r($ar_row);
	
	if( is_array($ar_row) ){
		$ar_row = array_slice($ar_row, 0, $out->get_value('frm_bucket_user_quantity','intval'));
	}
	
	if( is_array($ar_row) ) 
		foreach( $ar_row as $key => $arr_val )
	{
		$Obj =& Objective( $arr_val );
		unset($arr_val['CustomerId'] ); // clean 
		
	// -------------- mmerge data --------------------------------------
	
		$arr_val = array_merge( $arr_val, array(
			'CampaignId' => $out->get_value('frm_bucket_user_campaign'),
			'Agent' => _get_session('Username','strtoupper')
		));
		
		
	// -------- insert into db customer then assignment --------------------
		$this->db->reset_write();
		$this->db->insert("t_gn_customer", $arr_val );
		
		if( $this->db->affected_rows() > 0 
			AND ($CustomerId = $this->db->insert_id()) )
		{
			// ---------------" t_gn_bucket_customers "---------------------------
			
			$this->db->reset_write();
			$this->db->where("CustomerId", $Obj->get_value('CustomerId'));
			$this->db->set("AssignCampaign", 1);
			$this->db->update("t_gn_bucket_customers");
			
			// ------- trans "t_gn_bucket_assigment" --------
			
			$this->db->reset_write();
			$this->db->set("CustomerBucketId", $Obj->get_value('CustomerId'));
			$this->db->set("CustomerCampaignId", $Obj->get_value('CampaignId'));
			$this->db->set("CreateUserId", _get_session('UserId'));
			$this->db->set("CreatedDateTs", date('Y-m-d H:i:s'));
			$this->db->insert("t_gn_bucket_assigment");
			
			// ------- trans "t_gn_assigment" --------------
			
			// ------- trans "t_gn_assigment" --------------
			
			$this->db->reset_write();
			$this->db->set("CustomerId", $CustomerId);
			
			// -- root / admin   
			if( @in_array(_get_session('HandlingType'), 
				array(USER_ROOT, USER_ADMIN )) )
			{
				$this->db->set("AssignAdmin", _get_session('UserId'));
			}
			
			// Act Manger 
			if( @in_array( _get_session('HandlingType'), 
				array(USER_ACCOUNT_MANAGER)))
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", _get_session('UserId'));
			}
			
			// Manager 
			if( @in_array(_get_session('HandlingType'), 
				array(USER_MANAGER)) )
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", $ObjUser->get_value('act_mgr'));
				$this->db->set("AssignMgr", $ObjUser->get_value('UserId'));
			}
			
			
		// -- atm / leader -- 		
		
			if( @in_array(_get_session('HandlingType'), 
				array(USER_LEADER)) )
			{
				$this->db->set("AssignAdmin", $AssignAdmin);
				$this->db->set("AssignAmgr", $ObjUser->get_value('act_mgr'));
				$this->db->set("AssignMgr", $ObjUser->get_value('mgr_id'));
				$this->db->set("AssignSpv", $ObjUser->get_value('spv_id'));
				$this->db->set("AssignLeader", $ObjUser->get_value('UserId'));
			}
			
			// ---------- then set it  ----------------------
			$this->db->set("AssignDate", date('Y-m-d H:i:s'));
			$this->db->insert("t_gn_assignment");
			if( $this->db->affected_rows() > 0 ) {
				$ar_num++;
			}
		} 
		else {
			$num_dup++;
		}	
		
	}	
	
	// -- return data success -- 	
	$arr_call_back = array(
		'tot_asign' => $ar_num, 
		'tot_duplicate' => $num_dup 
	);
	
	return $arr_call_back;
} 

// -----------------------------------------------------------
/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 
 function _select_row_bucket_page( $out = null, $arr = null, $std = null  )
{
  $result_array = array();
  $this->db->reset_select();
  
  if( is_null($arr) )
  {	
		$this->db->select(" 
			a.BM_Id as BucketId,
			a.BM_Recsource as BM_Recsource, 
			a.BM_Custno as BM_Custno, 
			a.BM_FirstName as BM_FirstName,
			a.BM_MotherName as BM_MotherName,
			a.BM_Dob as BM_Dob,
			a.BM_AddressLine1 as BM_AddressLine1,
			a.BM_AddressLine1 as BM_AddressLine2,
			a.BM_AddressLine1 as BM_AddressLine3,
			a.BM_CcTypeName as BM_CcTypeName,
			a.BM_CrLimit as BM_CrLimit,
			a.BM_HomePhoneNum as BM_HomePhoneNum, 
			a.BM_MobilePhoneNum as BM_MobilePhoneNum, 
			a.BM_OfficePhoneNum as BM_OfficePhoneNum,
			a.BM_OtherPhoneNum as BM_OtherPhoneNum,
			a.BM_CcLimit as BM_CcLimit,
			a.BM_Process as BM_Process,
			a.BM_UploadedTs as BM_UploadedTs", 
		FALSE);
  }	else {
	$this->db->select($arr, false);  
  }
  
  $this->db->from("t_gn_bucket_customers a");
  
 //   filter data  
 
   if( $out->find_value('frm_bucket_fileupload') ){
		$this->db->where_in("a.BM_FTP_UploadId", $out->get_array_value('frm_bucket_fileupload'));
   }
// filter data by user process
   if( $out->find_value('frm_bucket_recsource') ){
		$this->db->where_in("a.BM_Recsource", $out->get_array_value('frm_bucket_recsource')); 
   }  
   // filter data by user process
   if( $out->find_value('frm_bucket_status') ){
		$this->db->where("a.BM_Process", $out->get_value('frm_bucket_status')); 
   }
   // filter data by user process
   if( $out->find_value('frm_bucket_start_date') ){
		$this->db->where(sprintf("a.BM_UploadedTs>='%s'", $out->get_value('frm_bucket_start_date','StartDate')), "", FALSE); 
   }
   // filter data by user process
   if( $out->find_value('frm_bucket_end_date') ){
		$this->db->where(sprintf("a.BM_UploadedTs<='%s'", $out->get_value('frm_bucket_end_date','EndDate')), "", FALSE); 
   }
   
   // filter data by user process
   if( $out->find_value('frm_bucket_id') ){
		$this->db->where_in("a.BM_Id", $out->get_array_value('frm_bucket_id') ); 
   }
  // filter data by user process
   if( $out->find_value('orderby') ) {
	 $this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
   } else {
	 $this->db->order_by( "a.BM_Id", "DESC"); 
   }
  
  
 // query limit untuk page langsung di tuju ke query 
 // selector saja , untuk performance data ketika 
 // user melakukan select data .
 
	if( is_object( $std ) ) {
		if( $std->post_page ) {
			$std->start_page = (($std->post_page-1)*$std->per_page);
		} 
		else {	
			$std->start_page = 0;
		}
	 // set on limite data 
		$this->db->limit( $std->per_page, $std->start_page);
	}
  
 // source fetch  
 // echo $this->db->print_out();
 
  $qry = $this->db->get();
  if( $qry && $qry->num_rows() > 0 ) {
	$result_array = (array)$qry->result_assoc();
  }
 
   return (array)$result_array;
 } 
 
 
// for optimize perfomance query data on page spiner 
// includes this methode . 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_row_bucket_counter( $out = null, $arr = null  )
{
  $this->counter = 0;
  
  // reset select 
  
  $this->db->reset_select();
  $this->db->select("count(a.BM_Id) as total",false); 
  $this->db->from("t_gn_bucket_customers a");
  
 // filter data  
   if( $out->find_value('frm_bucket_fileupload') ){
		$this->db->where_in("a.BM_FTP_UploadId", $out->get_array_value('frm_bucket_fileupload'));
   }
// filter data by user process
   if( $out->find_value('frm_bucket_recsource') ){
		$this->db->where_in("a.BM_Recsource", $out->get_array_value('frm_bucket_recsource')); 
   }  
   // filter data by user process
   if( $out->find_value('frm_bucket_status') ){
		$this->db->where("a.BM_Process", $out->get_value('frm_bucket_status')); 
   }
   // filter data by user process
   if( $out->find_value('frm_bucket_start_date') ){
		$this->db->where(sprintf("a.BM_UploadedTs>='%s'", $out->get_value('frm_bucket_start_date','StartDate')), "", FALSE); 
   }
   // filter data by user process
   if( $out->find_value('frm_bucket_end_date') ){
		$this->db->where(sprintf("a.BM_UploadedTs<='%s'", $out->get_value('frm_bucket_end_date','EndDate')), "", FALSE); 
   }
   
   // filter data by user process
   if( $out->find_value('frm_bucket_id') ){
		$this->db->where_in("a.BM_Id", $out->get_array_value('frm_bucket_id') ); 
   }
  
  // debug data 
  //$this->db->print_out();
  
  $qry = $this->db->get();
  if( $qry && $qry->num_rows() > 0 ) {
	$this->counter = $qry->result_singgle_value();
  }
 
   return (int)$this->counter;
 } 
 
 
 // ====================== END CLASS =============================
 
}

?>