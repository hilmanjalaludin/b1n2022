<?php

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_SrcAppoinment extends EUI_Model
{

var $set_limit_page = 10;
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function __construct() {
	$this->load->model(array('M_SetCallResult','M_UserRole'));
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _get_default()
{
 //  get post parameter --------------------------	
 $out  = UR();  $cok = CK(); $cnf = CF();
 
 
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
 $this->EUI_Page->_setCount(true);
 $this->EUI_Page->_setSelect("count(a.AppoinmentId) as tot", false);
 $this->EUI_Page->_setFrom("t_gn_appoinment a");
 $this->EUI_Page->_setJoin("t_gn_customer_master b ","a.CustomerId=b.DM_Id","LEFT");
 $this->EUI_Page->_setJoin("t_gn_assignment c ","a.CustomerId=c.AssignCustId","LEFT" );
 $this->EUI_Page->_setJoin("t_gn_campaign d ","b.DM_CampaignId=d.CampaignId","LEFT", true);
 
  
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	if( $cok->find_value('UserId') ){
		$this->EUI_Page->_setWhereNotIn("b.DM_CallCategoryId", array(APRV,CLOS ));	
		// $this->EUI_Page->_setWhereNotIn("b.DM_CallCategoryId", array(APRV,CLOS,YCOM,NCOM ));	
	}
//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		$this->EUI_Page->_setWhereIn("c.AssignAdmin", $cnf->field('default_admin'));	
	}
	
// MANAGER 
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setAnd("c.AssignMgr", $cok->field('UserId'));
	}
// ACC MANAGER  -- 
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){ 
		$this->EUI_Page->_setAnd("c.AssignAmgr",$cok->field('UserId'));
	}
	
// SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setAnd("c.AssignSpv", $cok->field('UserId'));
	}
	
// -- LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setAnd("c.AssignLeader", $cok->field('UserId'));
	}
	
// -- AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setAnd("c.AssignSelerId", $cok->field('UserId'));	
	}
	
// ambil data appointment yang hanya mulai hari in dan kedepan saja 
 if( ! $out->field('CLBK_update_start_date') 
	&& !$cok->field('CLBK_update_end_date') )  {
	$this->EUI_Page->_setAnd(sprintf("a.ApoinmentDate>='%s'", StartDate(date('Y-m-d'))));
	$this->EUI_Page->_setAnd(sprintf("a.ApoinmentDate<='%s'", EndDate(date('Y-m-d'))));
 }
 
//  filter post data user -----------------

 $this->EUI_Page->_setAndCache("b.DM_SellerId", 'CLBK_user_agent', TRUE);
 $this->EUI_Page->_setAndCache("b.DM_CallCategoryId", 'CLBK_call_status', TRUE);
 $this->EUI_Page->_setAndCache("b.DM_QualityCategoryId", 'CLBK_quality_status', TRUE);
 
 $this->EUI_Page->_setBeginCache("a.ApoinmentDate", 'CLBK_update_start_date', 	TRUE);
 $this->EUI_Page->_setStopCache("a.ApoinmentDate", 'CLBK_update_end_date', 	TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'CLBK1_filter_field', 		"CLBK1_filter_value", TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'CLBK2_filter_field', 		"CLBK2_filter_value", TRUE);
 
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
  $out  = UR();  $cok = CK(); $cnf = CF();
  
  // get default of page query appointment .
  
 $this->EUI_Page->_postPage($out->field('v_page') );
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
 $this->EUI_Page->_setArraySelect(array(
		"a.AppoinmentId as AppoinmentId"			=> array("AppoinmentId",	"AppoinmentId", "PRIMARY"),
		"b.DM_CampaignId as DM_CampaignId"			=> array("DM_CampaignId", 		 "DM_CampaignId"),
		"b.DM_Custno as DM_Custno"					=> array("DM_Custno", 	 	 	 "DM_Custno"),
		"b.DM_FirstName as DM_FirstName"			=> array("DM_FirstName",		 "DM_FirstName"),
		// "b.DM_AddressLine1 as DM_AddressLine1"		=> array("DM_AddressLine1",		 "DM_AddressLine1"), 
		// "b.DM_AddressLine2 as DM_AddressLine2"		=> array("DM_AddressLine2",		 "DM_AddressLine2"), 
		// "b.DM_AddressLine3 as DM_AddressLine3"		=> array("DM_AddressLine3", 	 "DM_AddressLine3"), 
		// "b.DM_GenderId as DM_GenderId"				=> array("DM_GenderId", 		 "DM_GenderId"),
		"b.DM_SellerId as DM_SellerId"				=> array("DM_SellerId", 		 "DM_SellerId"),
		"b.DM_CallCategoryId as DM_CallCategoryId"	=> array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		"b.DM_CallReasonId as DM_CallReasonId"		=> array("DM_CallReasonId", 	 "DM_CallReasonKode"),
		// "a.ApoinmentFlag as DM_ApoinmentFlag"		=> array("DM_ApoinmentFlag", 	 "AP_CallBackFlags"),
		"a.ApoinmentDate as DM_ApoinmentDate"		=> array("DM_ApoinmentDate", 	 "AP_CallBackDateTime") 
	));
	
  $this->EUI_Page->_setFrom("t_gn_appoinment a");
  $this->EUI_Page->_setJoin("t_gn_customer_master b ","a.CustomerId=b.DM_Id","LEFT");
  $this->EUI_Page->_setJoin("t_gn_assignment c ","a.CustomerId=c.AssignCustId","LEFT" );
  $this->EUI_Page->_setJoin("t_gn_campaign d ","b.DM_CampaignId=d.CampaignId","LEFT", true);
 
 
 
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve
	if( $cok->find_value('UserId') ){
		$this->EUI_Page->_setWhereNotIn("b.DM_CallCategoryId", array(APRV,CLOS));	
		// $this->EUI_Page->_setWhereNotIn("b.DM_CallCategoryId", array(APRV,CLOS,YCOM,NCOM ));	
	}
//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		$this->EUI_Page->_setWhereIn("c.AssignAdmin", $cnf->field('default_admin'));	
	}
	
// MANAGER 
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setAnd("c.AssignMgr", $cok->field('UserId'));
	}
// ACC MANAGER  -- 
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){ 
		$this->EUI_Page->_setAnd("c.AssignAmgr",$cok->field('UserId'));
	}
	
// SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setAnd("c.AssignSpv", $cok->field('UserId'));
	}
	
// -- LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setAnd("c.AssignLeader", $cok->field('UserId'));
	}
	
// -- AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setAnd("c.AssignSelerId", $cok->field('UserId'));	
		$this->EUI_Page->_setAnd("d.CampaignStatusFlag",1);	
	}
	
// ambil data appointment yang hanya mulai hari in dan kedepan saja 
 if( ! $out->field('CLBK_update_start_date') 
	&& !$cok->field('CLBK_update_end_date') )  {
	$this->EUI_Page->_setAnd(sprintf("a.ApoinmentDate>='%s'", StartDate(date('Y-m-d'))));
	$this->EUI_Page->_setAnd(sprintf("a.ApoinmentDate<='%s'", EndDate(date('Y-m-d'))));
 }
 
 

// filter data option OK   

 $this->EUI_Page->_setAndCache("b.DM_SellerId", 'CLBK_user_agent', TRUE);
 $this->EUI_Page->_setAndCache("b.DM_CallCategoryId", 'CLBK_call_status', TRUE);
 $this->EUI_Page->_setAndCache("b.DM_QualityCategoryId", 'CLBK_quality_status', TRUE);
 
 $this->EUI_Page->_setBeginCache("a.ApoinmentDate", 'CLBK_update_start_date', 	TRUE);
 $this->EUI_Page->_setStopCache("a.ApoinmentDate", 'CLBK_update_end_date', 	TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'CLBK1_filter_field', 		"CLBK1_filter_value", TRUE);
 $this->EUI_Page->_setFieldCache('LIKE', 'CLBK2_filter_field', 		"CLBK2_filter_value", TRUE);
 
// set order filter pager default .
  if( $out->field('order_by')) {
	$this->EUI_Page->_setOrderBy($out->field('order_by'),$out->field('type'));
  } else{
	  $this->EUI_Page->_setOrderBy("a.AppoinmentId","DESC");
  }
  
 //echo $this->EUI_Page->_getCompiler();
 $this->EUI_Page->_setLimit();
   
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
 
 function _set_like_group( $field="", $operator = "", $arr_val = null )
{
  $this->arr_ptr = array('LIKE' => 'LIKE','NOT_LIKE' => 'NOT LIKE');
  $this->arr_sec = array();
 if( is_array($arr_val) ) 
	 foreach($arr_val as $k => $value )
 {
	if( in_array($operator, array_keys($this->arr_ptr) )){
		$this->arr_sec[] = $field ." ". $this->arr_ptr[$operator] . " '%". mysql_real_escape_string(trim($value))."%' "; 
	}		
 }
	
 if( count($this->arr_sec) == 0  ){
	return FALSE;
 }	
	
 $this->arr_sec = " ( ". join(" OR ", $this->arr_sec) ." ) ";
 return (string)$this->arr_sec;
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _update_row_callback( $out = null )
{
	
$this->row = array('CustomerId' => 0 );

// then will get data row 
 if( is_null($out ) ){
	return Objective( $this->row );	
 } 
 
 // update 
 $sql = sprintf("select * from t_gn_appoinment a where a.AppoinmentId=%d", 
				  $out->field('AppoinmentId') );
 $qry = $this->db->query( $sql );				  
 if( $qry && $qry->num_rows() > 0 ){
	$this->row = $qry->result_first_assoc();
 }
 
 $this->row = Objective( $this->row ); 
 if( $this->row->field('AppoinmentId') ){
	 $sql = sprintf("UPDATE t_gn_appoinment a 
					SET a.ApoinmentFlag=1,
						a.ApoinmentCreate = NOW()
					 WHERE AppoinmentId ='%s'", $this->row->field('AppoinmentId'));
	 $this->db->query( $sql );				 
 }
 
 // return to user on client data browser
 return $this->row;
 
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _select_row_callback()
{
	$_conds = array(); $_a = array(); 
	if(class_exists('M_SetCallResult') )
	{
		$_data = $this -> M_SetCallResult -> _getCallback();
		foreach( $_data as $_k => $_v )
		{
			$_conds[$_k] = $_k;  
		}
	}
	return $_conds;
}
}

?>