<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_SrcCustomerList extends EUI_Model
{

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private static $Instance = null;
private static $arr_usr_level = null;

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
  
 function __construct()  {
	$this->load->model(array( 'M_SysUser', 			'M_SetResultCategory',
							  'M_SetCallResult', 	'M_SetProduct',
							  'M_SetCampaign',  	'M_MaskingNumber',
							  'M_Request', 			'M_Combo', 'M_UserRole'
	));
	// cetak error untuk development data process 
	display(0);
}

  



 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
// function _get_default() {
	
// get data object 	
	// $out = UR();  $cok = CK();  $cnf = CF();
// get all data not contacted 
	// $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	// $this->EUI_Page->_setCount(TRUE);
	// $this->EUI_Page->_setSelect("COUNT(a.DM_Id) as tot");
	// $this->EUI_Page->_setFrom("t_gn_customer_master a");
	// $this->EUI_Page->_setJoin("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
	// $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
 
// master filter tambahan untuk level User Tertentu 
	// $this->resultDataPeruser = DataCapPerUser();
	// if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
		// $this->EUI_Page->_setWhereIn('a.DM_CampaignId', $this->resultDataPeruser);
	// }
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	// if( $cok->find_value('UserId') ){
			
	// }
//  ADMIN / ROOT 		
	
	// if( $cok->cookie(array(USER_ROOT)) ){
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));
	// }	
	
//  ADMIN / ROOT 		
	// if( $cok->cookie(array(USER_ADMIN)) ){
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
	// }

/// USER_GENERAL_MANAGER 
	// if( $cok->cookie(USER_GENERAL_MANAGER) ){
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));	
		// $this->EUI_Page->_setAnd("b.AssignAmgr",$cok->field('UserId'));
	// }
	
	
// MANAGER --
// filter data pager :  MANAGER  
	// if( $cok->cookie( USER_MANAGER ) ){  
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	// }	
	
	
// ACC MANAGER  -- 
	// if( $cok->cookie(USER_ACCOUNT_MANAGER) ){
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	// }
	
	
	
// SPV -- 
	// if( $cok->cookie(USER_SUPERVISOR) ){ 
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// add date expired
		// $this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		// $this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
	// }
	
// -- LEADER ( TL )	-- 
	// if( $cok->cookie(USER_LEADER) ){ 
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
	// }
	
// -- AGENT ( TSR )	-- 
	// if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		// $this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(NOCT, DECL, APRV,CLOS,YCOM,NCOM,BLCK ));
		//update zay pengambilan customerlist ke callcategoryID 23-01-2018
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastReasonId", array(22, 44));
		//add date expired
		// $this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		// $this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
		// $this->EUI_Page->_setAnd("a.DM_AdmId", 0);	
	// }
	
	
//  post filter  --------------------------------------------------------------	
	// $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	// $this->EUI_Page->_setAndCache("a.DM_LastCategoryId", 'MSD_last_category', 	TRUE);
    // $this->EUI_Page->_setAndCache("a.DM_SellerId",		 'MSD_user_agent', 		TRUE);
    // $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",	 'MSD_call_start_date', TRUE);
    // $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 	 'MSD_call_end_date', 	TRUE);
	// $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD1_filter_field', 	'MSD1_filter_value', TRUE);
    // $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD2_filter_field', 	'MSD2_filter_value', TRUE);
	
// return page data -------------------------------------
// echo $this->EUI_Page->_getCompiler();
   // return $this->EUI_Page;
// }

function _get_default() {
	
// get data object 	
	$out = UR();  $cok = CK();  $cnf = CF();
// get all data not contacted 
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	$this->EUI_Page->_setCount(TRUE);
	$this->EUI_Page->_setSelect("COUNT(a.DM_Id) as tot");
	$this->EUI_Page->_setFrom("t_gn_customer_master a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
 
// master filter tambahan untuk level User Tertentu 
	$this->resultDataPeruser = DataCapPerUser();
	if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
		$this->EUI_Page->_setWhereIn('a.DM_CampaignId', $this->resultDataPeruser);
	}
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	if( $cok->find_value('UserId') ){
			
	}
//  ADMIN / ROOT 		
	
	if( $cok->cookie(array(USER_ROOT)) ){
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));
	}	
	
//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ADMIN)) ){
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
	}

/// USER_GENERAL_MANAGER 
	if( $cok->cookie(USER_GENERAL_MANAGER) ){
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));	
		$this->EUI_Page->_setAnd("b.AssignAmgr",$cok->field('UserId'));
	}
	
	
// MANAGER --
// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	}	
	
	
// ACC MANAGER  -- 
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	}
	
	
	
// SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		//add date expired
		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
	}
	
// -- LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
	}
	
// -- AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setWhereNotIn("COALESCE(a.DM_LastCategoryId,0)", array(NOCT, DECL, APRV,CLOS,YCOM,NCOM,BLCK ));
		//update zay pengambilan customerlist ke callcategoryID 23-01-2018
		$this->EUI_Page->_setWhereNotIn("a.DM_LastReasonId", array(22, 44));
		//add date expired
		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
		$this->EUI_Page->_setAnd("a.DM_AdmId", 0);
		$this->EUI_Page->_setOrderBy("a.DM_LastCategoryKode", "DESC");	
	}
	
	
//  post filter  --------------------------------------------------------------	
	$this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	$this->EUI_Page->_setAndCache("a.DM_LastCategoryId", 'MSD_last_category', 	TRUE);
    $this->EUI_Page->_setAndCache("a.DM_SellerId",		 'MSD_user_agent', 		TRUE);
    $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",	 'MSD_call_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 	 'MSD_call_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 			 'MSD1_filter_field', 	'MSD1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD2_filter_field', 	'MSD2_filter_value', TRUE);
	
// return page data -------------------------------------
// echo $this->EUI_Page->_getCompiler();
   return $this->EUI_Page;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
// function _get_content()
// {
	
// get data object 	
	// $out = UR();  $cok = CK();  $cnf = CF(); 
	
// get all define not interested on here 
	
// call object page ---------------------------
	
	// $this->EUI_Page->_postPage( $out->field('v_page') );
	// $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	// $this->EUI_Page->_setArraySelect(array(
		// "a.DM_Id as CustomerId"							=> array("CustomerId",			 "CustomerId","primary"),
		// "a.DM_CampaignId as DM_CampaignId"				=> array("DM_CampaignId", 		 "DM_CampaignId"),
		// "a.DM_Custno as DM_Custno"						=> array("DM_Custno", 	 	 	 "DM_Custno"),
		// "a.DM_FirstName as DM_FirstName"				=> array("DM_FirstName",		 "DM_FirstName"),
		// "a.DM_AddressLine1 as DM_AddressLine1"			=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
		// "a.DM_AddressLine2 as DM_AddressLine2"			=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
		// "a.DM_AddressLine3 as DM_AddressLine3"			=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
	  // "a.DM_Id as DM_City"							=> array("DM_City", 		 	 "DM_City"), 
		// "a.DM_GenderId as DM_GenderId"					=> array("DM_GenderId", 		 "DM_GenderId"),
		// "a.DM_SellerId as DM_SellerId"					=> array("DM_SellerId", 		 "DM_SellerId"),
	  // "b.AssignSpv as DM_SpvId"						=> array("DM_SpvId", 			 "LB_Global_Supervisor"),
		// "a.DM_CallCategoryId as DM_CallCategoryId"		=> array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		// "a.DM_LastCategoryKode as DM_LastCategoryKode"  => array("DM_LastCategoryKode",  "DM_LastCategoryKode"),
		// "a.DM_LastReasonKode as DM_LastReasonKode"		=> array("DM_LastReasonKode", 	 "DM_LastReasonKode"),
		// "a.DM_UpdatedTs as DM_UpdatedTs" 		    	=> array("DM_UpdatedTs", 		 "DM_UpdatedTs") 
	// ));
	
	// $this->EUI_Page->_setFrom("t_gn_customer_master a");
	// $this->EUI_Page->_setJoin("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
	// $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
	
// master filter tambahan untuk level User Tertentu 
	// $this->resultDataPeruser = DataCapPerUser();
	// if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
		// $this->EUI_Page->_setWhereIn('a.DM_CampaignId', $this->resultDataPeruser);
	// }
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	// if( $cok->find_value('UserId') ){
			
	// }
	// if( $cok->cookie(array(USER_ROOT)) ){
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));
	// }		
	
 // filter data pager : ADMIN / ROOT 		
	// if( $cok->cookie(array(USER_ADMIN)) ){
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
	// }
	

// / USER_GENERAL_MANAGER 
	// if( $cok->cookie(USER_GENERAL_MANAGER) ){
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));	
		// $this->EUI_Page->_setAnd("b.AssignAmgr",$cok->field('UserId'));
	// }
	
	
// MANAGER --
// filter data pager :  MANAGER  
	// if( $cok->cookie( USER_MANAGER ) ){  
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	// }	
	
	
// ACC MANAGER  -- 
	// if( $cok->cookie(USER_ACCOUNT_MANAGER) ){
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	// }
	
// filter data pager :  SPV -- 
	// if( $cok->cookie(USER_SUPERVISOR) ){ 
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// add date expired
		// $this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		// $this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
	// }
	
// filter data pager :  LEADER ( TL )	-- 
	// if( $cok->cookie(USER_LEADER) ){ 
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
	// }
	
// filter data pager :  AGENT ( TSR )	-- 
	// if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(NOCT, DECL, APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(NSTS, FOLW, RDPC));
		// $this->EUI_Page->_setWhereNotIn("a.DM_LastReasonId", array(22, 44));
		// add date expired
		// $this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		// $this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
		// $this->EUI_Page->_setAnd("a.DM_AdmId", 0);	
	// }
	
	
// customize filter data by post user 
	
	// $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	// $this->EUI_Page->_setAndCache("a.DM_LastCategoryId", 'MSD_last_category', 	TRUE);
    // $this->EUI_Page->_setAndCache("a.DM_SellerId",		 'MSD_user_agent', 		TRUE);
    // $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",	 'MSD_call_start_date', TRUE);
    // $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 	 'MSD_call_end_date', 	TRUE);
	// $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD1_filter_field', 	'MSD1_filter_value', TRUE);
    // $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD2_filter_field', 	'MSD2_filter_value', TRUE);
	 
// customize filter data order by user  
  // $this->EUI_Page->_setOrderCache($out, true); // this will keep order by
 
 // then limit on here  
  // $this->EUI_Page->_setLimit();
  // echo $this->EUI_Page->_getCompiler();
	
//}

function _get_content()
{
	
// get data object 	
	$out = UR();  $cok = CK();  $cnf = CF(); 
	
// get all define not interested on here 
	
// call object page ---------------------------
	
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	$this->EUI_Page->_setArraySelect(array(
		"a.DM_Id as CustomerId"							=> array("CustomerId",			 "CustomerId","primary"),
		"a.DM_CampaignId as DM_CampaignId"				=> array("DM_CampaignId", 		 "DM_CampaignId"),
		"a.DM_Custno as DM_Custno"						=> array("DM_Custno", 	 	 	 "DM_Custno"),
		"a.DM_FirstName as DM_FirstName"				=> array("DM_FirstName",		 "DM_FirstName"),
		"a.DM_AddressLine1 as DM_AddressLine1"			=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
		"a.DM_AddressLine2 as DM_AddressLine2"			=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
		"a.DM_AddressLine3 as DM_AddressLine3"			=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
	  //"a.DM_Id as DM_City"							=> array("DM_City", 		 	 "DM_City"), 
		"a.DM_GenderId as DM_GenderId"					=> array("DM_GenderId", 		 "DM_GenderId"),
		"a.DM_SellerId as DM_SellerId"					=> array("DM_SellerId", 		 "DM_SellerId"),
	  //"b.AssignSpv as DM_SpvId"						=> array("DM_SpvId", 			 "LB_Global_Supervisor"),
		"a.DM_CallCategoryId as DM_CallCategoryId"		=> array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		"a.DM_LastCategoryKode as DM_LastCategoryKode"  => array("DM_LastCategoryKode",  "DM_LastCategoryKode"),
		"a.DM_LastReasonKode as DM_LastReasonKode"		=> array("DM_LastReasonKode", 	 "DM_LastReasonKode"),
		"a.DM_UpdatedTs as DM_UpdatedTs" 		    	=> array("DM_UpdatedTs", 		 "DM_UpdatedTs") 
	));
	
	$this->EUI_Page->_setFrom("t_gn_customer_master a");
	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
	
// master filter tambahan untuk level User Tertentu 
	$this->resultDataPeruser = DataCapPerUser();
	if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
		$this->EUI_Page->_setWhereIn('a.DM_CampaignId', $this->resultDataPeruser);
	}
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	if( $cok->find_value('UserId') ){
			
	}
	if( $cok->cookie(array(USER_ROOT)) ){
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));
	}		
	
//  filter data pager : ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ADMIN)) ){
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
	}
	

/// USER_GENERAL_MANAGER 
	if( $cok->cookie(USER_GENERAL_MANAGER) ){
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));	
		$this->EUI_Page->_setAnd("b.AssignAmgr",$cok->field('UserId'));
	}
	
	
// MANAGER --
// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	}	
	
	
// ACC MANAGER  -- 
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
	}
	
// filter data pager :  SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		//add date expired
		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
	}
	
// filter data pager :  LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
		$this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
	}
	
// filter data pager :  AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(NOCT, DECL, APRV,CLOS,YCOM,NCOM,BLCK ));
		// $this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(NSTS, FOLW, RDPC));
		$this->EUI_Page->_setWhereNotIn("a.DM_LastReasonId", array(22, 44));
		//add date expired
		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
		$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
		$this->EUI_Page->_setAnd("a.DM_AdmId", 0);	
		//$this->EUI_Page->_setOrderBy("a.DM_LastCategoryKode", "DESC");
	}
	
	
// customize filter data by post user 
	
	$this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	$this->EUI_Page->_setAndCache("a.DM_LastCategoryId", 'MSD_last_category', 	TRUE);
    $this->EUI_Page->_setAndCache("a.DM_SellerId",		 'MSD_user_agent', 		TRUE);
    $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",	 'MSD_call_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 	 'MSD_call_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 			 'MSD1_filter_field', 	'MSD1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD2_filter_field', 	'MSD2_filter_value', TRUE);
	 
// customize filter data order by user  
  $this->EUI_Page->_setOrderCache($out, true); // this will keep order by
 
//  then limit on here  
  $this->EUI_Page->_setLimit();
  // echo $this->EUI_Page->_getCompiler();
	
}

// function _get_data_dial()
// {
	
// // get data object 	
// 	$out = UR();  $cok = CK();  $cnf = CF(); 
	
// // get all define not interested on here 
	
// // call object page ---------------------------
	
// 	$this->EUI_Page->_postPage( $out->field('v_page') );
// 	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
// 	$this->EUI_Page->_setArraySelect(array(
// 		"a.DM_Id as CustomerId"							=> array("CustomerId",			 "CustomerId","primary"),
// 		"a.DM_CampaignId as DM_CampaignId"				=> array("DM_CampaignId", 		 "DM_CampaignId"),
// 		"a.DM_Custno as DM_Custno"						=> array("DM_Custno", 	 	 	 "DM_Custno"),
// 		"a.DM_FirstName as DM_FirstName"				=> array("DM_FirstName",		 "DM_FirstName"),
// 		"a.DM_AddressLine1 as DM_AddressLine1"			=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
// 		"a.DM_AddressLine2 as DM_AddressLine2"			=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
// 		"a.DM_AddressLine3 as DM_AddressLine3"			=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
// 	  //"a.DM_Id as DM_City"							=> array("DM_City", 		 	 "DM_City"), 
// 		"a.DM_GenderId as DM_GenderId"					=> array("DM_GenderId", 		 "DM_GenderId"),
// 		"a.DM_SellerId as DM_SellerId"					=> array("DM_SellerId", 		 "DM_SellerId"),
// 	  //"b.AssignSpv as DM_SpvId"						=> array("DM_SpvId", 			 "LB_Global_Supervisor"),
// 		"a.DM_CallCategoryId as DM_CallCategoryId"		=> array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
// 		"a.DM_LastCategoryKode as DM_LastCategoryKode"  => array("DM_LastCategoryKode",  "DM_LastCategoryKode"),
// 		"a.DM_LastReasonKode as DM_LastReasonKode"		=> array("DM_LastReasonKode", 	 "DM_LastReasonKode"),
// 		"a.DM_UpdatedTs as DM_UpdatedTs" 		    	=> array("DM_UpdatedTs", 		 "DM_UpdatedTs") 
// 	));
	
// 	$this->EUI_Page->_setFrom("t_gn_customer_master a");
// 	$this->EUI_Page->_setJoin("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
// 	$this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT", true );
	
// // master filter tambahan untuk level User Tertentu 
// 	$this->resultDataPeruser = DataCapPerUser();
// 	if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
// 		$this->EUI_Page->_setWhereIn('a.DM_CampaignId', $this->resultDataPeruser);
// 	}
// // default query for all user data yang di munculkan adalah data2 non close 
// // atau approve
// 	if( $cok->find_value('UserId') ){
			
// 	}
// 	if( $cok->cookie(array(USER_ROOT)) ){
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));
// 	}		
	
// //  filter data pager : ADMIN / ROOT 		
// 	if( $cok->cookie(array(USER_ADMIN)) ){
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		$this->EUI_Page->_setWhereIn("b.AssignAdmin", $cnf->field('default_admin'));	
// 	}
	

// /// USER_GENERAL_MANAGER 
// 	if( $cok->cookie(USER_GENERAL_MANAGER) ){
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));	
// 		$this->EUI_Page->_setAnd("b.AssignAmgr",$cok->field('UserId'));
// 	}
	
	
// // MANAGER --
// // filter data pager :  MANAGER  
// 	if( $cok->cookie( USER_MANAGER ) ){  
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
// 	}	
	
	
// // ACC MANAGER  -- 
// 	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		$this->EUI_Page->_setAnd( sprintf( " ( b.AssignAmgr='%s' OR b.AssignMgr='%s' )",  $cok->field('AccountManager'), $cok->field('UserId')), false );
// 	}
	
// // filter data pager :  SPV -- 
// 	if( $cok->cookie(USER_SUPERVISOR) ){ 
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		//add date expired
// 		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
// 		$this->EUI_Page->_setAnd("b.AssignSpv", $cok->field('UserId'));
// 	}
	
// // filter data pager :  LEADER ( TL )	-- 
// 	if( $cok->cookie(USER_LEADER) ){ 
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(APRV,CLOS,YCOM,NCOM,BLCK ));
// 		$this->EUI_Page->_setAnd("b.AssignLeader", $cok->field('UserId'));
// 	}
	
// // filter data pager :  AGENT ( TSR )	-- 
// 	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastCategoryId", array(NOCT, DECL, APRV,CLOS,YCOM,NCOM,BLCK ));
// 		// $this->EUI_Page->_setWhereIn("a.DM_CallCategoryId", array(NSTS, FOLW, RDPC));
// 		$this->EUI_Page->_setWhereNotIn("a.DM_LastReasonId", array(22, 44));
// 		//add date expired
// 		$this->EUI_Page->_setAnd("date(a.DM_DateExpired) >= curdate()");
// 		$this->EUI_Page->_setAnd("b.AssignSelerId", $cok->field('UserId'));	
// 		$this->EUI_Page->_setAnd("a.DM_AdmId", 0);	
// 		//$this->EUI_Page->_setOrderBy("a.DM_LastCategoryKode", "DESC");
// 	}
	
	
// // customize filter data by post user 
	
// 	$this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
// 	$this->EUI_Page->_setAndCache("a.DM_LastCategoryId", 'MSD_last_category', 	TRUE);
//     $this->EUI_Page->_setAndCache("a.DM_SellerId",		 'MSD_user_agent', 		TRUE);
//     $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",	 'MSD_call_start_date', TRUE);
//     $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 	 'MSD_call_end_date', 	TRUE);
// 	$this->EUI_Page->_setFieldCache('LIKE', 			 'MSD1_filter_field', 	'MSD1_filter_value', TRUE);
//     $this->EUI_Page->_setFieldCache('LIKE', 			 'MSD2_filter_field', 	'MSD2_filter_value', TRUE);
	 
// // customize filter data order by user  
//   $this->EUI_Page->_setOrderCache($out, true); // this will keep order by
 
// //  then limit on here  
//   $this->EUI_Page->_setLimit();
//   //echo $this->EUI_Page->_getCompiler();
	
// }

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

function _select_row_limit_data () {

	$this->dataURI = UR(); 
  	$this->dataCOK = CK(); 
  	$this->dataCNF = CF();
	$data = array();
	$this->resultDataPeruser = DataCapPerUser();
	$LastCategory = array(2,4,5,7,9,10,11);

	// $this ->db ->select('a.DM_Id as MasterDataId');
	// $this ->db ->from('t_gn_customer_master a');
	// $this->db->join('t_gn_assignment b', 'a.DM_Id = b.AssignCustId', 'inner');
	// $this->db->join('t_gn_campaign c', 'a.DM_CampaignId = c.CampaignId', 'left');
	// $this ->db ->where_in('a.DM_CampaignId',$this->resultDataPeruser);
	// $this ->db ->where_not_in('a.DM_LastCategoryId',$LastCategory);
	// $this->db->where("date(a.DM_DateExpired) >= curdate()");
	// $this ->db ->where('b.AssignSelerId',_get_session('UserId'));
	// //$this->db->order_by('a.DM_LastCategoryKode DESC');
	// $this->db->limit(1);
	
  	$this->db->reset_select();
	$this->db->select('a.DM_Id as MasterDataId', false);
	$this->db->from("t_gn_customer_master a");
	$this->db->join("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
	$this->db->join("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT");
	$this->db->where("date(a.DM_DateExpired) >= curdate()");
	$this->db->limit(1);

	  
	// get master filter data per user campaign available data 
	// process 
	 
	$this->resultDataPeruser = DataCapPerUser();
	if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
		$this->db->where_in('a.DM_CampaignId', $this->resultDataPeruser);
	}

	// default query for all user data yang di munculkan adalah data2 non close 
	// atau approve
	if( $this->dataCOK->find_value('UserId') ){
		$this->db->where_not_in( 'a.DM_LastCategoryId', array(NOCT,DECL,APRV,CLOS,YCOM,NCOM ));	
	}
	  
	// filter data pager : ADMIN / ROOT 		
	if( $this->dataCOK->cookie(array(USER_ROOT, USER_ADMIN)) ){
		$this->db->where_in("b.AssignAdmin", $this->dataCNF->field('default_admin'));	
	}

	// filter data pager :  MANAGER  
	if( $this->dataCOK->cookie( USER_MANAGER ) ){  
		$this->db->where("b.AssignMgr", $this->dataCOK->field('UserId'));
	}	
	  
	// filter data pager :  ACC MANAGER   
	if( $this->dataCOK->cookie(USER_ACCOUNT_MANAGER) ){ 
		$this->db->where("b.AssignAmgr", $this->dataCOK->field('UserId'));
	}	

	// filter data pager :  SPV -- 
	if( $this->dataCOK->cookie(USER_SUPERVISOR) ){ 
		$this->db->where("b.AssignSpv", $this->dataCOK->field('UserId'));
	}

	// filter data pager :  LEADER ( TL )	-- 
	if( $this->dataCOK->cookie(USER_LEADER) ){ 
		$this->db->where("b.AssignLeader", $this->dataCOK->field('UserId'));
	}
	  
	// filter data pager :  AGENT ( TSR )	-- 
	if( $this->dataCOK->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->db->where("b.AssignSelerId", $this->dataCOK->field('UserId'));	
	}


	//echo $this -> db -> _get_var_dump();
		if( $CustomerData = $this -> db->get()-> result_first_assoc() ) {
			$data = $CustomerData;
		}
		
	return $data;
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
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
 * [Recovery data failed upload HSBC TAMAN SARI]
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
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _getGenderId()
{
  $_conds = array();
  $sql = " SELECT a.GenderId, a.Gender FROM  t_lk_gender a";
  $qry = $this -> db -> query($sql);
  if( !$qry -> EOF() )
  {
	foreach( $qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['GenderId']] = $rows['Gender'];
	}
  }	
  
  return $_conds;
} 



/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _select_row_master_detail( $MasterDataId=null)
{
	 
  $result_array = array();
  
 // select query data from master  
 // data lai akan di ambil pake fungsi aja .
 
  $sql = sprintf("
  	select a.* , b.CampaignDesc as DM_CampaignName 
  	from t_gn_customer_master a 
  	left join t_gn_campaign b on a.DM_CampaignId=b.CampaignId
  	where a.DM_Id='%d'", $MasterDataId);
	
  $qry = $this->db->query( $sql );
  // echo $sql;
  if( $qry && $qry->num_rows() > 0 ){
	  $result_array =(array)$qry->result_first_assoc();
  } 
  return (array)$result_array;
  
 }
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	  
 
// function _select_row_master_next()  {
	 
// // get all attribute Proces 	 
//   $this->dataURI = UR(); 
//   $this->dataCOK = CK(); 
//   $this->dataCNF = CF();
	
// // set data an array methodelogist.
//   $this->result_array = array();
	
// // reset_select on cache CI fuck .	will get one record ID 
//   $this->db->reset_select();
//   $this->db->select('a.DM_Id as MasterDataId', false);
//   $this->db->from("t_gn_customer_master a");
//   $this->db->join("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
//   $this->db->join("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT");

  
// // get master filter data per user campaign available data 
// // process 
 
//   $this->resultDataPeruser = DataCapPerUser();
//   if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
// 	$this->db->where_in('a.DM_CampaignId', $this->resultDataPeruser);
//   }
  
// // default query for all user data yang di munculkan adalah data2 non close 
// // atau approve
//   if( $this->dataCOK->find_value('UserId') ){
// 	$this->db->where_not_in( 'a.DM_LastCategoryId', array(NOCT,DECL,APRV,CLOS,YCOM,NCOM ));	
//   }
  
// // filter data pager : ADMIN / ROOT 		
//   if( $this->dataCOK->cookie(array(USER_ROOT, USER_ADMIN)) ){
// 	$this->db->where_in("b.AssignAdmin", $this->dataCNF->field('default_admin'));	
//   }
  
// // filter data pager :  MANAGER  
//   if( $this->dataCOK->cookie( USER_MANAGER ) ){  
// 	$this->db->where("b.AssignMgr", $this->dataCOK->field('UserId'));
//   }	
  
// // filter data pager :  ACC MANAGER   
//  if( $this->dataCOK->cookie(USER_ACCOUNT_MANAGER) ){ 
// 	$this->db->where("b.AssignAmgr", $this->dataCOK->field('UserId'));
//  }	
 
// // filter data pager :  SPV -- 
//   if( $this->dataCOK->cookie(USER_SUPERVISOR) ){ 
// 	$this->db->where("b.AssignSpv", $this->dataCOK->field('UserId'));
//   }
  
// // filter data pager :  LEADER ( TL )	-- 
//  if( $this->dataCOK->cookie(USER_LEADER) ){ 
// 	$this->db->where("b.AssignLeader", $this->dataCOK->field('UserId'));
//   }
  
// // filter data pager :  AGENT ( TSR )	-- 
//  if( $this->dataCOK->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
// 	$this->db->where("b.AssignSelerId", $this->dataCOK->field('UserId'));	
//  }
	
// // ambil order cache yang ada di library EUI Pager 
// // yang sudah di set sebelumbya . pedfine 

//   $this->ord = null;
//   $this->ord = $this->EUI_Page->_select_cache_field_order();
//   if( $this->ord->find_value('order_field') ){
// 	// set an order style by CI QUery data source .
// 	$this->db->order_by( $this->ord->field('order_field'), 
// 						 $this->ord->field('order_type'));
//   } 
	
//  // $this->db->print_out();
//  // get source data process on here like this will insect.
//   $this->nextDataRow = $this->db->get();
//   if( !$this->nextDataRow ){
// 	exit( debug(mysql_error())); 
//   }
 
//  // then will get here 
//   if( $this->nextDataRow and  $this->nextDataRow->num_rows() > 0 ) 
//   foreach( $this->nextDataRow->result_record() as $row ) {
// 	$this->result_array[] = $row->field('MasterDataId');
//   }
//  // return client data process .
//   return (array)$this->result_array; 

//  }

function _select_row_master_next()  {
	 
// get all attribute Proces 	 
  $this->dataURI = UR(); 
  $this->dataCOK = CK(); 
  $this->dataCNF = CF();
	
// set data an array methodelogist.
  $this->result_array = array();
	
// reset_select on cache CI fuck .	will get one record ID 
  $this->db->reset_select();
  $this->db->select('a.DM_Id as MasterDataId', false);
  $this->db->from("t_gn_customer_master a");
  $this->db->join("t_gn_assignment b ","a.DM_Id=b.AssignCustId", "INNER");
  $this->db->join("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT");
  $this->db->where("date(a.DM_DateExpired) >= curdate()");
  //$this->db->limit(1);

  
// get master filter data per user campaign available data 
// process 
 
  $this->resultDataPeruser = DataCapPerUser();
  if( is_array($this->resultDataPeruser ) && count($this->resultDataPeruser)){
	$this->db->where_in('a.DM_CampaignId', $this->resultDataPeruser);
  }
  
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
  if( $this->dataCOK->find_value('UserId') ){
	$this->db->where_not_in( 'a.DM_LastCategoryId', array(NOCT,DECL,APRV,CLOS,YCOM,NCOM ));	
  }
  
// filter data pager : ADMIN / ROOT 		
  if( $this->dataCOK->cookie(array(USER_ROOT, USER_ADMIN)) ){
	$this->db->where_in("b.AssignAdmin", $this->dataCNF->field('default_admin'));	
  }
  
// filter data pager :  MANAGER  
  if( $this->dataCOK->cookie( USER_MANAGER ) ){  
	$this->db->where("b.AssignMgr", $this->dataCOK->field('UserId'));
  }	
  
// filter data pager :  ACC MANAGER   
 if( $this->dataCOK->cookie(USER_ACCOUNT_MANAGER) ){ 
	$this->db->where("b.AssignAmgr", $this->dataCOK->field('UserId'));
 }	
 
// filter data pager :  SPV -- 
  if( $this->dataCOK->cookie(USER_SUPERVISOR) ){ 
	$this->db->where("b.AssignSpv", $this->dataCOK->field('UserId'));
  }
  
// filter data pager :  LEADER ( TL )	-- 
 if( $this->dataCOK->cookie(USER_LEADER) ){ 
	$this->db->where("b.AssignLeader", $this->dataCOK->field('UserId'));
  }
  
// filter data pager :  AGENT ( TSR )	-- 
 if( $this->dataCOK->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
	$this->db->where("b.AssignSelerId", $this->dataCOK->field('UserId'));	
 }
	
// ambil order cache yang ada di library EUI Pager 
// yang sudah di set sebelumbya . pedfine 

  $this->ord = null;
  $this->ord = $this->EUI_Page->_select_cache_field_order();
  if( $this->ord->find_value('order_field') ){
	// set an order style by CI QUery data source .
	$this->db->order_by( $this->ord->field('order_field'), 
						 $this->ord->field('order_type'));
  } 
	
 //echo $this->db->print_out();
 // get source data process on here like this will insect.
  $this->nextDataRow = $this->db->get();
  if( !$this->nextDataRow ){
	exit( debug(mysql_error())); 
  }
 
 // then will get here 
  if( $this->nextDataRow and  $this->nextDataRow->num_rows() > 0 ) 
  foreach( $this->nextDataRow->result_record() as $row ) {
	$this->result_array[] = $row->field('MasterDataId');
  }
 // return client data process .
  return (array)$this->result_array; 

 }
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
  function _getOriginalData( $CustomerId = 0 )
{
	$data = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer');
	$this ->db ->where('CustomerId',$CustomerId);
	
	if( $CustomerData = $this -> db->get()-> result_first_assoc() ) {
		$data = $CustomerData;
	}
	
	return $data;
} 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
  function _getPhoneCustomer( $CustomerId = 0, $flags = 0  )
{
	
// fungsi argumen 
 $this->CustomerId = $CustomerId;
 $this->Conditions = false;

// set data array row contact data 
  $result_array  = array();
 
// maping kan data field 2 yang akan di 
// jadikan dropdown di customer Phpone Number 
  $result_maping = array(	'DM_HomePhoneNum' 	=> array('name' => 'HOM', 'event' => 'SetMasking' ),
							'DM_MobilePhoneNum' => array('name' => 'MOB', 'event' => 'SetMasking' ),
							'DM_OfficePhoneNum' => array('name' => 'OFC', 'event' => 'SetMasking' ),
							'DM_OtherPhoneNum' 	=> array('name' => 'OTH', 'event' => 'SetMasking' ) );

					
// jika sudah dimaping , query dat ke customer berdasarkan value - yang di minta
// pada fungsi 
  $sql = sprintf("SELECT DM_HomePhoneNum,
						 DM_MobilePhoneNum,
						 DM_OtherPhoneNum, DM_OfficePhoneNum
						 FROM t_gn_customer_master 
						 WHERE DM_Id='%s'", $this->CustomerId);
   
  $qry = $this->db->query( $sql );
  if( $qry && $qry->num_rows() > 0 ) {
	 $row = $qry->result_first_assoc();
	
	// pastikan data yang keluar adalah @array
	if( is_array($row)) foreach( $row as $key => $value ){
		if( in_array($key, array_keys($result_maping))   and strlen($value) > 3 ){
			$result_array[base64_encode($value)] = sprintf("%s - %s", $result_maping[$key]['name'], 
													  call_user_func_array( $result_maping[$key]['event'], array($value) ));
		}
	 }
 }
 
 
 // kembalikan nilainya ke bentuk process view html < dropdown >
 // dengan data array.
 return (array)$result_array;
 
 }
 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _get_data_template()
{
	$data_template = $this -> _cc_extension_agent -> _get_meta_colums();
 	if( $data_template )
	{
		return $data_template;
	}
}  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _getApprovalPhoneItems($CustomerId = 0 )
 {
	$_conds = array();
	
	$this ->db ->select('a.ApprovalNewValue, b.ApprovalItem');
	$this ->db ->from('t_gn_approvalhistory a');
	$this ->db ->join('t_lk_approvalitem b','a.ApprovalItemId=b.ApprovalItemId','LEFT');
	$this ->db ->where('a.CustomerId',$CustomerId);
	
	foreach($this ->db -> get()->result_assoc() as $rows )
	{
		$_avail = explode(' ', $rows['ApprovalItem']);
		if( count($_avail) > 0 ){
			$_conds[$rows['ApprovalNewValue']] = $_avail[0] .' '. $this->M_MaskingNumber->MaskingBelakang($rows['ApprovalNewValue']); 	
		}
	}
	
	return $_conds;
 }
 

 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 
 function _select_save_cust_product( $CustomerId = 0 )
{
	$ProductId = 0;
	$sql = sprintf( "select a.ProductId from t_gn_customer a where a.CustomerId = '%s'", $CustomerId);
	$res = $this->db->query($sql);
	if( $res->num_rows() > 0 
		AND $row = $res->result_first_assoc() )
	{
	   $ProductId = $row['ProductId'];	
	}
	return $ProductId;
}
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _getAvailProduct( $CustomerId = 0 )
 {
	$arr_product = array();
	$ProductId = $this->_select_save_cust_product($CustomerId);
	
// -- reset cache -- 
	
	$this->db->reset_select();
	$this->db->select('d.ProductId, d.ProductName');
	$this->db->from('t_gn_customer a ');
	$this->db->join('t_gn_campaign b ',' a.CampaignId=b.CampaignId');
	$this->db->join('t_gn_campaignproduct c ',' b.CampaignId=c.CampaignId');
	$this->db->join('t_gn_product d ',' c.ProductId=d.ProductId');
	
// -- if proeuct exist --- 
	
	if( $ProductId ){
		$this ->db->where('d.ProductId',$ProductId);
	}
// -- if proeuct exist --- 
	
	if($CustomerId > 0) {
		$this ->db->where('a.CustomerId',$CustomerId);
	}
	
	foreach( $this ->db-> get() -> result_assoc() as $rows ) {
		$arr_product[$rows['ProductId']] = $rows['ProductName'];
	}
	
	return $arr_product;
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _set_row_update_followup( $out  = null )
{

 $this->callBackID = 0;

 // get ceck of session User Data 
 $cok  = CK();
 
 
 // then will reset .
 
 $this->db->reset_write();
 $this->db->set("DM_UpdatedTs", "NOW()", false);
 $this->db->set("DM_UpdatedById", $cok->field('UserId'),false);
 $this->db->set("DM_Followup",1);
 
 // set where data 
 $this->db->where("DM_Id", $out->get_value('MasterDataId'), false);
 $this->db->update("t_gn_customer_master");
 if( $this->db->affected_rows() > 0 ){
	$this->callBackID++;
 }
 
 return $this->callBackID;
 
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 public function _unset_row_update_followup( $out  = null )
{
	if( !$out->fetch_ready() )
 {
	return FALSE;
 }
 
// --------- clear cache ----------------------------------------
 $this->db->reset_write();
 
 $this->db->where("DM_Id", $out->get_value('MasterDataId'), false);
 $this->db->where("DM_Followup",1,true);
 
 $this->db->set("DM_UpdatedById",_get_session('UserId'),false);
 $this->db->set("DM_Followup",0,true);
 $this->db->update("t_gn_customer_master");
 
// --------------- ok -------------------------------- 

 if( $this->db->affected_rows() > 0 ){
	return TRUE;	
 }	else {
	 return FALSE;
 } 
 
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _getCardType() { 
	return array(); 
}
 function _getCekPolicyForm( $CustomerId = 0 )  { 
	return true; 
 }
 function _cti_extension_upload( $data = null ) { 
	return null; 
}
 
 function NotInterest() { 
	return array(); 
	}
	
 function Sale() { 
	return array(); 
}

 function set_like_group( $field="", $operator = "", $arr_val = null ) {
	return false;
} 


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
// ======================================= END CLASS ======================================== 

}

?>