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
 
class M_QualityFollowup extends EUI_Model
{
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

var $arr_call_status = array();
var $arr_call_back 	 = array();

 
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
 
 public static function &Instance()  {
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
 $this->load->model(array ( 
	'M_SetCallResult',  'M_SetProduct',  'M_SetCampaign',  
	'M_SrcCustomerList', 'M_UserRole'	
 ));
 //display();
}


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 public static function &UserLevelId()  {
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
 
 function _get_default()
{
	
  // get all process request data from client
  $out = UR();  $cok = CK(); $cnf = CF();
  //debug($out);
  
// user level data on by process 
  
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  $this->EUI_Page->_setCount(true);
  $this->EUI_Page->_setSelect("count(a.DM_Id) as total", FALSE);
  $this->EUI_Page->_setFrom("t_gn_customer_master a");
  $this->EUI_Page->_setJoin("t_gn_assignment b "," a.DM_Id=b.AssignCustId", "INNER" );
  $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT" );
  $this->EUI_Page->_setJoin("tms_agent d "," b.AssignSelerId =d.UserId", "INNER", true );
// find cookies data 

  if( $cok->find_value('UserId') ){
	// $this->EUI_Page->_setWhereIn("a.DM_QualityCategoryId", array(APRV,NSTS,RDPC));	
	$this->EUI_Page->_setWhereIn("a.DM_QualityCategoryId", array(NSTS));
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
 }
	 
// default data filter data process pager.
 $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 		'QTY_call_status', 			TRUE);
 $this->EUI_Page->_setAndCache("a.DM_QualityCategoryId", 	'QTY_quality_status',		TRUE);
 $this->EUI_Page->_setAndCache("a.DM_SellerId",				'QTY_user_agent', 			TRUE);
 $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs", 			'QTY_update_start_date', 	TRUE);
 $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 			'QTY_update_end_date', 		TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 					'QTY1_filter_field', 		"QTY1_filter_value", TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 					'QTY2_filter_field', 		"QTY2_filter_value", TRUE);
	 
// group by 

  // echo $this->EUI_Page->_getCompiler();
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
		
		//"a.DM_Id as DM_CustomerAddress"					 => array("DM_CustomerAddress",   "DM_CustomerAddress"),
		
		"a.DM_AddressLine1 as DM_AddressLine1"		=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
		"a.DM_AddressLine2 as DM_AddressLine2"		=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
		"a.DM_AddressLine3 as DM_AddressLine3"		=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
		
		"a.DM_GenderId as DM_GenderId"					 => array("DM_GenderId", 		 "DM_GenderId"),
		"a.DM_DataType as DM_DataType"					 => array("DM_DataType", 		 "DM_DataType"),
		
		// "a.DM_SellerId as DM_SellerId"					 => array("DM_SellerId", 		 "DM_SellerId"),
		"a.DM_CallCategoryId as DM_CallCategoryId"		 => array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		"a.DM_QualityUserId as DM_QualityUserId"		 => array("DM_QualityUserId", 	 "DM_QualityUserId"),
		// "d.id as AgentCode" 		    	 => array("AgentCode", 		 "Agent Code"),
		"a.DM_QualityCategoryId as DM_QualityCategoryId" => array("DM_QualityCategoryId","DM_QualityCategoryId"),
		"a.DM_QualityUpdateTs as DM_QualityUpdateTs"	 => array("DM_QualityUpdateTs",  "DM_QualityUpdateTs"), 
		"a.DM_UpdatedTs as DM_UpdatedTs" 		    	 => array("DM_UpdatedTs", 		 "DM_UpdatedTs")
		
	));
	
  $this->EUI_Page->_setFrom("t_gn_customer_master a");
  $this->EUI_Page->_setJoin("t_gn_assignment b "," a.DM_Id=b.AssignCustId", "INNER" );
  $this->EUI_Page->_setJoin("t_gn_campaign c "," a.DM_CampaignId =c.CampaignId", "LEFT" );
  $this->EUI_Page->_setJoin("tms_agent d "," b.AssignSelerId =d.UserId", "INNER", true );
  
  
 
// find cookies data 

  if( $cok->find_value('UserId') ){
	// $this->EUI_Page->_setWhereIn("a.DM_QualityCategoryId", array(APRV,NSTS,RDPC));
	$this->EUI_Page->_setWhereIn("a.DM_QualityCategoryId", array(NSTS));
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
 }
	
 	//debug($out);
	
// default data filter data process pager.
 
  $this->EUI_Page->_setAndCache("a.DM_CallCategoryId", 		'QTY_call_status', 			TRUE);
  $this->EUI_Page->_setAndCache("a.DM_QualityCategoryId", 	'QTY_quality_status', 			TRUE);
  $this->EUI_Page->_setAndCache("a.DM_SellerId",			'QTY_user_agent', 			TRUE);
  $this->EUI_Page->_setBeginCache("a.DM_UpdatedTs",			'QTY_update_start_date', 	TRUE);
  $this->EUI_Page->_setStopCache("a.DM_UpdatedTs", 			'QTY_update_end_date', 		TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 					'QTY1_filter_field', 		"QTY1_filter_value", TRUE);
  $this->EUI_Page->_setFieldCache('LIKE', 					'QTY2_filter_field', 		"QTY2_filter_value", TRUE);
	 
  // $this->EUI_Page->_setAndCache("e.ProductId", 'wpc_product_id', true);	
  // $this->EUI_Page->_setAndCache("f.ProductType", 'wpc_product_type', true);
  
		
// set order ---------------------------
 if( $out->find_value('order_by') ){
	$this->EUI_Page->_setOrderBy( $out->field('order_by'), $out->field('type') ); 
 } else {
	$this->EUI_Page->_setOrderBy("a.DM_UpdatedTs","ASC");
 }
 
 $this->EUI_Page->_setLimit();
// echo $this->EUI_Page->_getCompiler();  
	
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _get_resource() {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='')  {
		return $this -> EUI_Page -> _result();
	}	
 }
 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 
 function _get_page_number()  {
	if( $this->EUI_Page->_get_query()!='' ) {
		return $this->EUI_Page->_getNo();
	}	
 }
 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
 function _get_form_action(){
	$result_array = $this->M_UserRole->_select_role_form_action("QualityFollowup");
	return Objective( $result_array );
 }
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _set_quality_followup_assigment( $out = null ){
	 
// insert quality Assignment data row procsss 
// then will get.

	$sql = sprintf("INSERT INTO t_gn_quality_assignment (  SPV_Id, Assign_Data_Id, Assign_Create_By, Assign_Create_Ts )
					SELECT 
						a.DM_QualityUserId as SPV_Id,  
						a.DM_Id as Assign_Data_Id,
						a.DM_QualityUserId as Assign_Create_By,
						a.DM_QualityUpdateTs as Assign_Create_Ts
					FROM t_gn_customer_master a
					WHERE a.DM_Id ='%d' 
					ON DUPLICATE KEY UPDATE 
					Assign_Create_Ts = NOW() ", $out->field('CustomerId') );
					
			
// insert into log assignment quality Process .				
	$this->db->query( $sql );				
	return true;
	
}
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _get_quality_followup_precess( $out  = null ){
	 
// data recsource row of query process 
	$sql = sprintf("SELECT a.DM_QualityUserId 
					FROM t_gn_customer_master a  WHERE a.DM_Id ='%s'
					AND a.DM_QualityProcess = 1 ", $out->field('CustomerId'));
					
	$qry = $this->db->query( $sql);				
	if( $qry && $qry->num_rows() >  0 ) {
		
	 $row = $qry->result_first_record();
	 if( $row->find_value( 'DM_QualityUserId' )  ){
		return $row->field('DM_QualityUserId' );	
	 }
  }
	return false;
 }
 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _get_quality_followup_callback(){
	// kembalian untuk setiap repsone ke model 
	// ini.
	return Objective( $this->arr_call_back);
 }
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _set_quality_followup_master( $out = null )  {
 
 // ceck dulu object yang di kirim apakah object atau 
 // bukan 
 $cok = CK(); 
 if( !is_object($out) OR !$out->field('CustomerId') ){
	return false;
 }
 
// jika data object push data disini .
 
 $out->add('DM_Id', $out->field('CustomerId'));
 $out->add('DM_QualityUserId', $cok->field('UserId'));
 $out->add('DM_QualityUpdateTs', date('Y-m-d H:i:s'));
 $out->add('DM_QualityProcess', 1);
 
	
// update data menjadi followup QA dan data akan di masukan ke Assignment Quality Data 
// process pemilihan data di asumsikan perebutan 
// untuk memenuhi quality Assignment.

 $sql = sprintf("UPDATE t_gn_customer_master a 
				SET
					a.DM_QualityUserId 	 = '%s',
					a.DM_UpdatedById 	 = '%s', 
					a.DM_QualityUpdateTs = '%s',
					a.DM_QualityProcess  = '%s' 
				WHERE DM_QualityProcess  = 0 AND a.DM_Id = '%s'",
				
				$out->field('DM_QualityUserId'),
				$out->field('DM_QualityUserId'),
				$out->field('DM_QualityUpdateTs'),
				$out->field('DM_QualityProcess'),
				$out->field('DM_Id') );
					
	// update data customer master 					
	$this->db->query($sql);
	if( $this->db->affected_rows() > 0 ){
		// insert into t_gn_quality_assignment 
		$this->_set_quality_followup_assigment( $out );
		
		// kembalikan nila object data .
		$this->arr_call_back['UserId'] = $out->field('DM_QualityUserId', array('UserKode','strtoupper'));	
		return true;
	}
	
	// on process data on sip OK 
	$out->add('DM_UserProccess', $this->_get_quality_followup_precess( $out ));	
	
	// jika ternyata data yang update masih User Yang sama Maka Buka saja 
	if( !strcmp($out->field('DM_UserProccess'), $cok->field('UserId'))) {
	  $this->arr_call_back['UserId'] = $out->field('DM_UserProccess', array('UserKode','strtoupper'));	
	  return true;
	}
	
	if( $out->field('DM_UserProccess') ){
		$this->arr_call_back['UserId'] = $out->field('DM_UserProccess', array('UserKode','strtoupper'));	
	}
	
	// kembalikan nila hasil dari process ini. 
	return false;
 }
 
 
// =============================================================================
// =============================== END CLASS ===================================
// =============================================================================

}

?>